<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model {

    public function listarCitas($estado = null) {
        $this->db->select('citas.*, 
                           pacientes.nombre as nombre_paciente, 
                           pacientes.apellido as apellido_paciente, 
                           medicos.nombre as nombre_medico, 
                           medicos.apellido as apellido_medico, 
                           medicos_info.especialidad,
                           tipodeatencion.nombreTipoAtencion, 
                           tipodeatencion.costoAtencion,
                           cobros.idCobro,
                           cobros.fechaCobro');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('usuarios as medicos', 'citas.idMedico = medicos.idUsuario');
        $this->db->join('medicos as medicos_info', 'medicos_info.idMedico = citas.idMedico', 'left');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->join('cobros', 'citas.idCita = cobros.idCita', 'left');
        if ($estado !== null) {
            $this->db->where('citas.estado', $estado);
        }
        return $this->db->get()->result();
    }

    public function listarCitasPendientesPago() {
        $this->db->select('citas.*, 
                           pacientes.nombre as nombre_paciente, 
                           pacientes.apellido as apellido_paciente, 
                           tipodeatencion.nombreTipoAtencion, 
                           tipodeatencion.costoAtencion');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.estado', 'pendiente');
        $this->db->where('citas.fecha <=', date('Y-m-d H:i:s'));
        $this->db->order_by('citas.fecha', 'ASC');
        return $this->db->get()->result();
    }


    public function obtenerHorariosDisponibles($fecha = null, $idMedico = null) {
        $horarios = array();
        for ($hora = 8; $hora < 20; $hora++) {
            $horarios[] = sprintf("%02d:00", $hora);
            $horarios[] = sprintf("%02d:30", $hora);
        }
    
        if ($fecha && $idMedico) {
            // Obtener las citas existentes para el médico en la fecha dada
            $this->db->select('DATE_FORMAT(fecha, "%H:%i") as hora_ocupada');
            $this->db->from('citas');
            $this->db->where('idMedico', $idMedico);
            $this->db->where('DATE(fecha)', $fecha);
            $citas_existentes = $this->db->get()->result_array();
    
            // Filtrar los horarios ocupados
            $horarios_ocupados = array_column($citas_existentes, 'hora_ocupada');
            $horarios_disponibles = array_diff($horarios, $horarios_ocupados);
    
            return array_values($horarios_disponibles);
        }
    
        return $horarios;
    }

    public function obtenerTiposDeAtencion() {
        $this->db->where('estado', 1);
        return $this->db->get('tipodeatencion')->result();
    }

    public function agendarCita($datos) {
        $fechaHoraCita = strtotime($datos['fecha']);
        $ahora = time();
    
        if ($fechaHoraCita <= $ahora) {
            return ['success' => false, 'message' => 'No se pueden agendar citas para fechas y horas pasadas.'];
        }
    
        if ($this->existeConflictoMedico($datos['idMedico'], $datos['fecha'])) {
            return ['success' => false, 'message' => 'El médico ya tiene una cita programada para ese horario.'];
        }
    
        if ($this->existeConflictoPaciente($datos['idPaciente'], $datos['fecha'])) {
            return ['success' => false, 'message' => 'El paciente ya tiene una cita programada para ese horario.'];
        }
    
        $this->db->trans_start();
    
        $this->db->insert('citas', $datos);
        $idCita = $this->db->insert_id();
    
        $datos_cabeza = array(
            'idCita' => $idCita,
            'fecha' => $datos['fecha'],
            'idPaciente' => $datos['idPaciente'],
            'idMedico' => $datos['idMedico'],
            'estado' => 1
        );
        $this->db->insert('cita_cabeza', $datos_cabeza);
        $idCitaCabeza = $this->db->insert_id();
    
        $tipo_atencion = $this->db->select('nombreTipoAtencion, costoAtencion')
                                  ->from('tipodeatencion')
                                  ->where('idTipoDeAtencion', $datos['idTipoDeAtencion'])
                                  ->get()
                                  ->row();
    
        $datos_detalle = array(
            'idCitaCabeza' => $idCitaCabeza,
            'nombrePaciente' => $this->obtenerNombreCompleto($datos['idPaciente']),
            'nombreMedico' => $this->obtenerNombreCompleto($datos['idMedico']),
            'nombreAtencion' => $tipo_atencion->nombreTipoAtencion,
            'costoAtencion' => $tipo_atencion->costoAtencion
        );
        $this->db->insert('cita_detalle', $datos_detalle);
    
        $this->db->trans_complete();
    
        if ($this->db->trans_status() === FALSE) {
            return ['success' => false, 'message' => 'Error al agendar la cita.'];
        }
    
        return ['success' => true, 'message' => 'Cita agendada con éxito.', 'idCita' => $idCita];
    }
   

    private function obtenerNombreCompleto($idUsuario) {
        $this->db->select('CONCAT(nombre, " ", apellido) as nombre_completo');
        $this->db->from('usuarios');
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get()->row()->nombre_completo;
    }

    private function obtenerNombreTipoAtencion($idTipoDeAtencion) {
        $this->db->select('nombreTipoAtencion');
        $this->db->from('tipodeatencion');
        $this->db->where('idTipoDeAtencion', $idTipoDeAtencion);
        return $this->db->get()->row()->nombreTipoAtencion;
    }

   
    public function cancelarCita($idCita) {
        $this->db->where('idCita', $idCita);
        return $this->db->update('citas', array('estado' => 0));
    }

    public function recuperarCitaDetallada($idCita) {
        $this->db->select('citas.*, 
                           pacientes.nombre as nombre_paciente, 
                           pacientes.apellido as apellido_paciente, 
                           medicos.nombre as nombre_medico, 
                           medicos.apellido as apellido_medico, 
                           medicos_info.especialidad, 
                           tipodeatencion.nombreTipoAtencion, 
                           tipodeatencion.costoAtencion');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('usuarios as medicos', 'citas.idMedico = medicos.idUsuario');
        $this->db->join('medicos as medicos_info', 'medicos_info.idMedico = citas.idMedico', 'left');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.idCita', $idCita);
        return $this->db->get()->row();
    }


    public function modificarCita($idCita, $datos_cita) {
        $this->db->where('idCita', $idCita);
        $resultado = $this->db->update('citas', $datos_cita);
    
        if ($resultado) {
            // Actualizar cita_cabeza
            $datos_cabeza = array(
                'fecha' => $datos_cita['fecha'],
                'idPaciente' => $datos_cita['idPaciente'],
                'idMedico' => $datos_cita['idMedico']
            );
            $this->db->where('idCita', $idCita);
            $this->db->update('cita_cabeza', $datos_cabeza);
    
            // Actualizar cita_detalle
            $idCitaCabeza = $this->db->select('idCitaCabeza')
                                     ->from('cita_cabeza')
                                     ->where('idCita', $idCita)
                                     ->get()->row()->idCitaCabeza;
    
            $tipo_atencion = $this->db->select('nombreTipoAtencion, costoAtencion')
                                      ->from('tipodeatencion')
                                      ->where('idTipoDeAtencion', $datos_cita['idTipoDeAtencion'])
                                      ->get()->row();
    
            $datos_detalle = array(
                'nombrePaciente' => $this->obtenerNombreCompleto($datos_cita['idPaciente']),
                'nombreMedico' => $this->obtenerNombreCompleto($datos_cita['idMedico']),
                'nombreAtencion' => $tipo_atencion->nombreTipoAtencion,
                'costoAtencion' => $tipo_atencion->costoAtencion
            );
            $this->db->where('idCitaCabeza', $idCitaCabeza);
            $this->db->update('cita_detalle', $datos_detalle);
        }
    
        return $resultado;
    }

    public function obtenerNumeroCorrelativo($idCita) {
        $this->db->from('citas');
        $this->db->where('idCita <=', $idCita);
        $this->db->where('estado', 1);
        return $this->db->count_all_results();
    }

    public function obtenerCitasParaCalendario() {
        $this->db->select('citas.idCita, citas.fecha, citas.motivoConsulta, 
                           CONCAT(pacientes.nombre, " ", pacientes.apellido) as paciente,
                           CONCAT(medicos.nombre, " ", medicos.apellido) as medico,
                           tipodeatencion.nombreTipoAtencion');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('usuarios as medicos', 'citas.idMedico = medicos.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.estado', 1);
        
        $query = $this->db->get();
        
        $result = [];
        foreach ($query->result() as $row) {
            $result[] = [
                'id' => $row->idCita,
                'title' => $row->paciente . ' - ' . $row->nombreTipoAtencion,
                'start' => $row->fecha,
                'extendedProps' => [
                    'medico' => $row->medico,
                    'motivo' => $row->motivoConsulta
                ],
                'color' => strtotime($row->fecha) < time() ? '#28a745' : '#007bff' // Verde para citas pasadas, azul para futuras
            ];
        }
        
        return $result;
    }
    
    public function actualizarEstadoCita($idCita, $estado) {
        $this->db->where('idCita', $idCita);
        return $this->db->update('citas', ['estado' => $estado]);
    }

    private function existeConflictoMedico($idMedico, $fecha) {
        $this->db->where('idMedico', $idMedico);
        $this->db->where('fecha', $fecha);
        $this->db->where('estado', 1);
        return $this->db->get('citas')->num_rows() > 0;
    }
    
    private function existeConflictoPaciente($idPaciente, $fecha) {
        $this->db->where('idPaciente', $idPaciente);
        $this->db->where('fecha', $fecha);
        $this->db->where('estado', 1);
        return $this->db->get('citas')->num_rows() > 0;
    }
    
}