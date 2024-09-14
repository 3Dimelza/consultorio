<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model {

    public function listaCitas() {
        $this->db->select('c.*, p.nombre as nombrePaciente, m.nombre as nombreMedico, t.nombreTipoAtencion');
        $this->db->from('citas c');
        $this->db->join('usuarios p', 'c.idPaciente = p.idUsuario');
        $this->db->join('usuarios m', 'c.idMedico = m.idUsuario');
        $this->db->join('tipodeatencion t', 'c.idTipoDeAtencion = t.idTipoDeAtencion');
        $query = $this->db->get();
        return $query->result();
    }

    public function agregarCita($data) {
        $this->db->insert('citas', $data);
    }

    public function eliminarCita($idCita) {
        $this->db->where('idCita', $idCita);
        $this->db->delete('citas');
    }

    public function recuperarCita($idCita) {
        $this->db->where('idCita', $idCita);
        $query = $this->db->get('citas');
        return $query->row();
    }

    public function modificarCita($idCita, $data) {
        $this->db->where('idCita', $idCita);
        $this->db->update('citas', $data);
    }

    public function listaPacientes() {
        $this->db->where('rol', 'paciente');
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function listaMedicos() {
        $this->db->where('rol', 'medico');
        $query = $this->db->get('usuarios');
        return $query->result();
    }

    public function listaTiposAtencion() {
        $query = $this->db->get('tipodeatencion');
        return $query->result();
    }
}