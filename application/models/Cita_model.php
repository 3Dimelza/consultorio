<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model {

    public function listarCitas($estado = 1) {
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
        $this->db->where('citas.estado', $estado);
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
        $this->db->trans_start();
    
        // Insertar en tabla citas
        $this->db->insert('citas', $datos);
        $idCita = $this->db->insert_id();
    
        // Insertar en tabla cita_cabeza
        $datos_cabeza = array(
            'idCita' => $idCita,
            'fecha' => $datos['fecha'],
            'idPaciente' => $datos['idPaciente'],
            'idMedico' => $datos['idMedico'],
            'estado' => 1
        );
        $this->db->insert('cita_cabeza', $datos_cabeza);
        $idCitaCabeza = $this->db->insert_id();  // Obtener el ID de cita_cabeza
    
        // Obtener costo de atención
        $tipo_atencion = $this->db->select('nombreTipoAtencion, costoAtencion')
                                  ->from('tipodeatencion')
                                  ->where('idTipoDeAtencion', $datos['idTipoDeAtencion'])
                                  ->get()
                                  ->row();
    
        // Insertar en tabla cita_detalle
        $datos_detalle = array(
            'idCitaCabeza' => $idCitaCabeza,  // Usar el ID obtenido de cita_cabeza
            'nombrePaciente' => $this->obtenerNombreCompleto($datos['idPaciente']),
            'nombreMedico' => $this->obtenerNombreCompleto($datos['idMedico']),
            'nombreAtencion' => $tipo_atencion->nombreTipoAtencion,
            'costoAtencion' => $tipo_atencion->costoAtencion
        );
        $this->db->insert('cita_detalle', $datos_detalle);
    
        $this->db->trans_complete();
    
        return $this->db->trans_status();
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
        $this->db->select('COUNT(*) as numero');
        $this->db->from('citas');
        $this->db->where('idCita <=', $idCita);
        $this->db->where('estado', 1);
        return $this->db->get()->row()->numero;
    }
}