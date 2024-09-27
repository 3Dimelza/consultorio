<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico_model extends CI_Model {

    public function listaMedicos($estado = 1) {
        $this->db->select('usuarios.*, medicos.especialidad');
        $this->db->from('usuarios');
        $this->db->join('medicos', 'usuarios.idUsuario = medicos.idMedico');
        $this->db->where('usuarios.rol', 'Medico');
        $this->db->where('usuarios.estado', $estado);
        return $this->db->get();
    }

    public function agregarUsuario($data)
    {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function agregarMedico($data)
    {
        $this->db->insert('medicos', $data);
    }

    public function eliminarMedico($idMedico) {
        $this->db->trans_start();

        $this->db->where('idMedico', $idMedico);
        $this->db->delete('medicos');

        $this->db->where('idUsuario', $idMedico);
        $this->db->delete('usuarios');

        $this->db->trans_complete();

        return $this->db->trans_status() !== FALSE;
    }

    public function recuperarMedico($idMedico)
    {
        $this->db->select('usuarios.*, medicos.especialidad');
        $this->db->from('usuarios');
        $this->db->join('medicos', 'usuarios.idUsuario = medicos.idMedico');
        $this->db->where('usuarios.idUsuario', $idMedico);
        return $this->db->get();
    }

    public function modificarUsuario($idUsuario, $data)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuarios', $data);
    }

    public function modificarMedico($idMedico, $data)
    {
        $this->db->where('idMedico', $idMedico);
        $this->db->update('medicos', $data);
    }

    public function cambiarEstadoMedico($idMedico, $estado) {
        $this->db->trans_start();

        $data = array(
            'estado' => $estado,
            'ultimaActualizacion' => date('Y-m-d H:i:s')
        );

        $this->db->where('idUsuario', $idMedico);
        $this->db->update('usuarios', $data);

        $this->db->where('idMedico', $idMedico);
        $this->db->update('medicos', $data);

        $this->db->trans_complete();

        return $this->db->trans_status() !== FALSE;
    }

}