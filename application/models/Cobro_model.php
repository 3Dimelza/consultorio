<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro_model extends CI_Model {

    public function listarCobros() {
        $this->db->select('cobros.*, citas.fecha as fechaCita, CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombrePaciente, tipodeatencion.nombreTipoAtencion, tipodeatencion.costoAtencion');
        $this->db->from('cobros');
        $this->db->join('citas', 'cobros.idCita = citas.idCita');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->order_by('cobros.fechaCobro', 'DESC');
        return $this->db->get()->result();
    }

    public function listarCitasPendientesPago() {
        $this->db->select('citas.*, 
                           CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombre_paciente,
                           pacientes.nombre as nombre_paciente, 
                           pacientes.apellido as apellido_paciente, 
                           tipodeatencion.nombreTipoAtencion, 
                           tipodeatencion.costoAtencion');
        $this->db->from('citas');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.estado', 1); // Citas pendientes
        $this->db->where('NOT EXISTS (SELECT 1 FROM cobros WHERE cobros.idCita = citas.idCita)', NULL, FALSE);
        $this->db->order_by('citas.fecha', 'ASC');
        return $this->db->get()->result();
    }

    
    public function registrarCobro($datos) {
        $this->db->trans_start();
        $this->db->insert('cobros', $datos);
        $idCobro = $this->db->insert_id();
        $this->db->trans_complete();
        return $this->db->trans_status() ? $idCobro : false;
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


    public function obtenerCobroPorIdCita($idCita) {
        $this->db->select('cobros.*, citas.fecha as fechaCita, citas.motivoConsulta, 
                           CONCAT(pacientes.nombre, " ", pacientes.apellido) as nombrePaciente, 
                           CONCAT(medicos.nombre, " ", medicos.apellido) as nombreMedico, 
                           tipodeatencion.nombreTipoAtencion, tipodeatencion.costoAtencion');
        $this->db->from('citas');
        $this->db->join('cobros', 'citas.idCita = cobros.idCita', 'left');
        $this->db->join('usuarios as pacientes', 'citas.idPaciente = pacientes.idUsuario');
        $this->db->join('usuarios as medicos', 'citas.idMedico = medicos.idUsuario');
        $this->db->join('tipodeatencion', 'citas.idTipoDeAtencion = tipodeatencion.idTipoDeAtencion');
        $this->db->where('citas.idCita', $idCita);
        return $this->db->get()->row();
    }

    public function obtenerIngresosPorPeriodo($fechaInicio = null, $fechaFin = null) {
        $this->db->select('DATE(cobros.fechaCobro) as fecha, SUM(cobros.monto) as totalIngresos, COUNT(*) as cantidadCitas');
        $this->db->from('cobros');
        if ($fechaInicio && $fechaFin) {
            $this->db->where('cobros.fechaCobro >=', $fechaInicio);
            $this->db->where('cobros.fechaCobro <=', $fechaFin);
        }
        $this->db->group_by('DATE(cobros.fechaCobro)');
        $this->db->order_by('fecha', 'ASC');
        return $this->db->get()->result();
    }

    

}