<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {
    public function obtenerCitasParaCalendario() {
        $this->db->select('citas.idCita, citas.fecha, citas.motivoConsulta, 
                           CONCAT(pacientes.nombre, " ", pacientes.apellido) as paciente,
                           CONCAT(medicos.nombre, " ", medicos.apellido) as medico,
                           tipodeatencion.nombreTipoAtencion,
                           cobros.numeroComprobante');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('usuarios as medicos', 'citas.idMedico = medicos.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->join('cobros', 'citas.idCita = cobros.idCita');
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
                    'motivo' => $row->motivoConsulta,
                    'numeroComprobante' => $row->numeroComprobante
                ],
                'color' => strtotime($row->fecha) < time() ? '#28a745' : '#007bff' // Verde para citas pasadas, azul para futuras
            ];
        }
        
        return $result;
    }
}