<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends CI_Model {

    public function getCitasPorMedico() {
        $this->db->select('CONCAT(usuarios.nombre, " ", usuarios.apellido) as nombreMedico, medicos.especialidad, COUNT(citas.idCita) as totalCitas');
        $this->db->from('citas');
        $this->db->join('usuarios', 'citas.idMedico = usuarios.idUsuario');
        $this->db->join('medicos', 'usuarios.idUsuario = medicos.idMedico');
        $this->db->where('citas.estado', 1);
        $this->db->group_by('citas.idMedico');
        $this->db->order_by('totalCitas', 'DESC');
        return $this->db->get()->result();
    }

    public function getIngresosPorMes() {
        $this->db->select('DATE_FORMAT(cobros.fechaCobro, "%Y-%m") as mes, SUM(cobros.monto) as totalIngresos');
        $this->db->from('cobros');
        $this->db->group_by('mes');
        $this->db->order_by('mes', 'DESC');
        return $this->db->get()->result();
    }

    public function getPacientesFrecuentes() {
        $this->db->select('CONCAT(usuarios.nombre, " ", usuarios.apellido) as nombrePaciente, COUNT(citas.idCita) as totalCitas');
        $this->db->from('citas');
        $this->db->join('usuarios', 'citas.idPaciente = usuarios.idUsuario');
        $this->db->where('citas.estado', 1);
        $this->db->group_by('citas.idPaciente');
        $this->db->order_by('totalCitas', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }
}