<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Cita_model');
    }

    public function index() {
        $data['citas'] = $this->Cita_model->listaCitas();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Cita_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar() {
        $data['pacientes'] = $this->Cita_model->listaPacientes();
        $data['medicos'] = $this->Cita_model->listaMedicos();
        $data['tiposAtencion'] = $this->Cita_model->listaTiposAtencion();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarCita_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregarbd() {
        $data = array(
            'fecha' => $this->input->post('fecha'),
            'motivoConsulta' => $this->input->post('motivoConsulta'),
            'idPaciente' => $this->input->post('idPaciente'),
            'idMedico' => $this->input->post('idMedico'),
            'idTipoDeAtencion' => $this->input->post('idTipoDeAtencion')
        );

        $this->Cita_model->agregarCita($data);
        redirect('Cita/index', 'refresh');
    }

    public function eliminar($idCita) {
        $this->Cita_model->eliminarCita($idCita);
        redirect('Cita/index', 'refresh');
    }

    public function modificar($idCita) {
        $data['cita'] = $this->Cita_model->recuperarCita($idCita);
        $data['pacientes'] = $this->Cita_model->listaPacientes();
        $data['medicos'] = $this->Cita_model->listaMedicos();
        $data['tiposAtencion'] = $this->Cita_model->listaTiposAtencion();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarCita_view', $data);
        $this->load->view('inc/footer');
    }

    public function modificarbd() {
        $idCita = $this->input->post('idCita');
        $data = array(
            'fecha' => $this->input->post('fecha'),
            'motivoConsulta' => $this->input->post('motivoConsulta'),
            'idPaciente' => $this->input->post('idPaciente'),
            'idMedico' => $this->input->post('idMedico'),
            'idTipoDeAtencion' => $this->input->post('idTipoDeAtencion')
        );

        $this->Cita_model->modificarCita($idCita, $data);
        redirect('Cita/index', 'refresh');
    }
}