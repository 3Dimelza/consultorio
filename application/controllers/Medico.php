<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {
    
    public function index()
    {
        $lista = $this->Medico_model->listaMedicos();
        $data['medicos'] = $lista;
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Medico_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar()
    {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarMedico_view');
        $this->load->view('inc/footer');
    }

    public function agregarbd()
    {
        $data['nombre'] = $this->input->post('nombre');
        $data['apellido'] = $this->input->post('apellido');
        $data['fechaNacimiento'] = $this->input->post('fechaNacimiento');
        $data['telefono'] = $this->input->post('telefono');
        $data['direccion'] = $this->input->post('direccion');
        $data['email'] = $this->input->post('email');
        $data['contrasenia'] = $this->input->post('contrasenia');
        $data['rol'] = 'Medico';

        $idUsuario = $this->Medico_model->agregarUsuario($data);

        $dataMedico['idMedico'] = $idUsuario;
        $dataMedico['especialidad'] = $this->input->post('especialidad');

        $this->Medico_model->agregarMedico($dataMedico);

        redirect('medico/index', 'refresh');
    }

    public function eliminarbd()
    {
        $idMedico = $this->input->post('idMedico');
        $this->Medico_model->eliminarMedico($idMedico);
        redirect('medico/index', 'refresh');
    }

    public function modificar()
    {
        $idMedico = $this->input->post('idMedico');
        $data['infoMedico'] = $this->Medico_model->recuperarMedico($idMedico);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarMedico_view', $data);
        $this->load->view('inc/footer');
    }

    public function modificarbd()
    {
        $idMedico = $this->input->post('idMedico');
        $data['nombre'] = $this->input->post('nombre');
        $data['apellido'] = $this->input->post('apellido');
        $data['fechaNacimiento'] = $this->input->post('fechaNacimiento');
        $data['telefono'] = $this->input->post('telefono');
        $data['direccion'] = $this->input->post('direccion');
        $data['email'] = $this->input->post('email');
        $data['contrasenia'] = $this->input->post('contrasenia');

        $dataMedico['especialidad'] = $this->input->post('especialidad');

        $this->Medico_model->modificarUsuario($idMedico, $data);
        $this->Medico_model->modificarMedico($idMedico, $dataMedico);

        redirect('medico/index', 'refresh');
    }
}