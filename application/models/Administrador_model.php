<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_model extends CI_Model {

    public function listaUsuarios($estado = 1) {
        $this->db->select('usuarios.*, pacientes.alergias, pacientes.tipoSangre, medicos.especialidad');
        $this->db->from('usuarios');
        $this->db->where('usuarios.estado', $estado);
        $this->db->join('pacientes', 'usuarios.idUsuario = pacientes.idPaciente', 'left');
        $this->db->join('medicos', 'usuarios.idUsuario = medicos.idMedico', 'left');
        return $this->db->get();
    }

    public function cambiarEstadoUsuario($idUsuario, $estado, $idUsuario_auditoria) {
        $this->db->trans_start();
        
        $data = array(
            'estado' => $estado,
            'idUsuario_auditoria' => $idUsuario_auditoria,
            'ultimaActualizacion' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuarios', $data);

        $usuario = $this->recuperarUsuario($idUsuario);
        if ($usuario->rol == 'Paciente') {
            $this->db->where('idPaciente', $idUsuario);
            $this->db->update('pacientes', $data);
        } elseif ($usuario->rol == 'Medico') {
            $this->db->where('idMedico', $idUsuario);
            $this->db->update('medicos', $data);
        }

        $this->db->trans_complete();
        return $this->db->trans_status() !== FALSE;
    }

    public function agregarUsuario($data) {
        $this->db->insert('usuarios', $data);
        return $this->db->insert_id();
    }

    public function agregarPaciente($data) {
        return $this->db->insert('pacientes', $data);
    }

    public function agregarMedico($data) {
        return $this->db->insert('medicos', $data);
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
        $this->db->trans_start();
    
        $usuario_antiguo = $this->recuperarUsuario($idUsuario);
        
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update('usuarios', $data);
    
        if ($usuario_antiguo->rol != $data['rol']) {
            // El rol ha cambiado, eliminamos los registros antiguos
            if ($usuario_antiguo->rol == 'Paciente') {
                $this->eliminarPaciente($idUsuario);
            } elseif ($usuario_antiguo->rol == 'Medico') {
                $this->eliminarMedico($idUsuario);
            }
        }
    
        $this->db->trans_complete();
        return $this->db->trans_status() !== FALSE;
    }
    
    public function modificarPaciente($idPaciente, $data) {
        $this->db->where('idPaciente', $idPaciente);
        return $this->db->update('pacientes', $data);
    }
    
    public function modificarMedico($idMedico, $data) {
        $this->db->where('idMedico', $idMedico);
        return $this->db->update('medicos', $data);
    }
    
    public function eliminarPaciente($idPaciente) {
        $this->db->where('idPaciente', $idPaciente);
        return $this->db->delete('pacientes');
    }
    
    public function eliminarMedico($idMedico) {
        $this->db->where('idMedico', $idMedico);
        return $this->db->delete('medicos');
    }
    
    public function eliminarUsuario($idUsuario) {
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->delete('usuarios');
    }
    
    
}