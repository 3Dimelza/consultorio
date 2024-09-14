<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_model extends CI_Model {

    public function listaUsuarios() {
        return $this->db->get('usuarios');
    }

    public function agregarUsuario($data) {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function agregarPaciente($data) {
        $this->db->insert('pacientes', $data);
    }

    public function agregarMedico($data) {
        $this->db->insert('medicos', $data);
    }

    public function recuperarUsuario($idUsuario) {
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->get('usuarios')->row();
    }

    public function recuperarPaciente($idPaciente) {
        $this->db->where('idPaciente', $idPaciente);
        return $this->db->get('pacientes')->row();
    }

    public function recuperarMedico($idMedico) {
        $this->db->where('idMedico', $idMedico);
        return $this->db->get('medicos')->row();
    }

    public function modificarUsuario($idUsuario, $data) {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuarios', $data);
    }

    public function modificarPaciente($idPaciente, $data) {
        $this->db->where('idPaciente', $idPaciente);
        $this->db->update('pacientes', $data);
    }

    public function modificarMedico($idMedico, $data) {
        $this->db->where('idMedico', $idMedico);
        $this->db->update('medicos', $data);
    }

    public function eliminarUsuario($idUsuario) {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->delete('usuarios');
    }

    public function eliminarPaciente($idPaciente) {
        $this->db->where('idPaciente', $idPaciente);
        $this->db->delete('pacientes');
    }

    public function eliminarMedico($idMedico) {
        $this->db->where('idMedico', $idMedico);
        $this->db->delete('medicos');
    }
}