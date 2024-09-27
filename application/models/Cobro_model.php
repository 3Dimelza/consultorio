<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro_model extends CI_Model {

    public function listarCobros() {
        $this->db->select('cobros.*, citas.fecha as fechaCita, CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombrePaciente');
        $this->db->from('cobros');
        $this->db->join('citas', 'cobros.idCita = citas.idCita');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->order_by('cobros.fechaCobro', 'DESC');
        return $this->db->get()->result();
    }

    public function getCitasPendientesCobro() {
        $this->db->select('citas.idCita, citas.fecha, CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombrePaciente, tipodeatencion.costoAtencion');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.estado', 1);
        $this->db->where('citas.idCita NOT IN (SELECT idCita FROM cobros)', NULL, FALSE);
        return $this->db->get()->result();
    }

    public function registrarCobro($datos) {
        return $this->db->insert('cobros', $datos);
    }

    public function obtenerCobro($idCobro) {
        $this->db->select('cobros.*, citas.fecha as fechaCita, CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombrePaciente, tipodeatencion.nombreTipoAtencion, tipodeatencion.costoAtencion');
        $this->db->from('cobros');
        $this->db->join('citas', 'cobros.idCita = citas.idCita');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('cobros.idCobro', $idCobro);
        return $this->db->get()->row();
    }
}