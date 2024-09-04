<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita_model extends CI_Model {

    public function listaUsuarios()
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        return $this->db->get(); //devuelve el resultado
    }
    
    public function agregarUsuario($data)
    {
        $this->db->insert('usuarios',$data);
    }
    
    public function eliminarUsuario($idUsuario)
    {
        $this->db->where('idUsuario',$idUsuario);
        $this->db->delete('usuarios');
    }
    
    public function recuperarUsuario($idUsuario)
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('idUsuario',$idUsuario);
        return $this->db->get(); //devuelve el resultado

    }

    public function modificarUsuario($idUsuario,$data)
    {
        $this->db->where('idUsuario',$idUsuario);
        $this->db->update('usuarios',$data);

    }


    }
?>