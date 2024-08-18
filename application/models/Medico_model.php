<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador_model extends CI_Model {

    public function listaMedicos()
    {
        $this->db->select('*');
        $this->db->from('medicos');
        return $this->db->get(); //devuelve el resultado
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