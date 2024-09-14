<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {

    public function listaPacientes()
    {
        $this->db->select('usuarios.*, pacientes.*');
        $this->db->from('usuarios');
        $this->db->join('pacientes', 'usuarios.idUsuario = pacientes.idPaciente');
        $this->db->where('usuarios.rol', 'Paciente');
        return $this->db->get();
    }

    public function agregarUsuario($data)
    {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function agregarPaciente($data)
    {
        $this->db->insert('pacientes', $data);
    }

    public function eliminarPaciente($idPaciente)
    {
        $this->db->where('idPaciente', $idPaciente);
        $this->db->delete('pacientes');
        $this->db->where('idUsuario', $idPaciente);
        $this->db->delete('usuarios');
    }

    public function recuperarPaciente($idPaciente)
    {
        $this->db->select('usuarios.*, pacientes.*');
        $this->db->from('usuarios');
        $this->db->join('pacientes', 'usuarios.idUsuario = pacientes.idPaciente');
        $this->db->where('usuarios.idUsuario', $idPaciente);
        return $this->db->get();
    }

    public function modificarUsuario($idUsuario, $data)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuarios', $data);
    }

    public function modificarPaciente($idPaciente, $data)
    {
        $this->db->where('idPaciente', $idPaciente);
        $this->db->update('pacientes', $data);
    }
}