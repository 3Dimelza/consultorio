<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente_model extends CI_Model {
    public function listaPacientes($estado = 1) {
        $this->db->select('usuarios.*, pacientes.*');
        $this->db->from('usuarios');
        $this->db->join('pacientes', 'usuarios.idUsuario = pacientes.idPaciente');
        $this->db->where('usuarios.rol', 'Paciente');
        $this->db->where('usuarios.estado', $estado);
        return $this->db->get();
    }


    public function agregarUsuario($data) {
        $data['contrasenia'] = password_hash($data['contrasenia'], PASSWORD_DEFAULT);
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function agregarPaciente($data) {
        return $this->db->insert('pacientes', $data);
    }

    public function cambiarEstadoPaciente($idPaciente, $estado) {
        $this->db->trans_start();
        
        $data = array(
            'estado' => $estado,
            'ultimaActualizacion' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('idUsuario', $idPaciente);
        $this->db->update('usuarios', $data);

        $this->db->where('idPaciente', $idPaciente);
        $this->db->update('pacientes', $data);

        $this->db->trans_complete();
        return $this->db->trans_status() !== FALSE;
    }

    public function recuperarPaciente($idPaciente) {
        $this->db->select('usuarios.*, pacientes.*');
        $this->db->from('usuarios');
        $this->db->join('pacientes', 'usuarios.idUsuario = pacientes.idPaciente');
        $this->db->where('usuarios.idUsuario', $idPaciente);
        return $this->db->get()->row();
    }

    public function modificarUsuario($idUsuario, $data) {
        if (isset($data['contrasenia'])) {
            $data['contrasenia'] = password_hash($data['contrasenia'], PASSWORD_DEFAULT);
        }
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->update('usuarios', $data);
    }

    public function modificarPaciente($idPaciente, $data) {
        $this->db->where('idPaciente', $idPaciente);
        return $this->db->update('pacientes', $data);
    }

    public function eliminarPaciente($idPaciente) {
        $this->db->trans_start();

        $this->db->where('idPaciente', $idPaciente);
        $this->db->delete('pacientes');

        $this->db->where('idUsuario', $idPaciente);
        $this->db->delete('usuarios');

        $this->db->trans_complete();

        return $this->db->trans_status() !== FALSE;
    }
}
