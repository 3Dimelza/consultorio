<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico_model extends CI_Model {

    /*
    public function listaMedicos()
    {
        $this->db->select('*');
        $this->db->from('medicos');
        return $this->db->get(); //devuelve el resultado
    }
    */
    
    public function listaMedicos()
    {
    $this->db->select('usuarios.*'); // Selecciona todas las columnas de la tabla usuarios
    $this->db->from('usuarios');
    $this->db->join('medicos', 'medicos.idMedico = usuarios.idUsuario'); // Une las tablas donde los IDs coinciden
    return $this->db->get(); // Devuelve el resultado
    }

    
    public function agregarMedico($data)
    {
        $this->db->insert('medicos',$data);
    }
    
    public function eliminarMedico($idMedico)
    {
        $this->db->where('idMedico',$idMedico);
        $this->db->delete('medicos');
    }
    
    public function recuperarMedico($idMedico)
    {
        $this->db->select('*');
        $this->db->from('medicos');
        $this->db->where('idMedico',$idMedico);
        return $this->db->get(); //devuelve el resultado

    }

    public function modificarMedico($idMedico,$data)
    {
        $this->db->where('idMedico',$idMedico);
        $this->db->update('medicos',$data);

    }


    }
?>