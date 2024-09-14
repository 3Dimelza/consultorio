<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {
    
    public function index()
    {
        $lista = $this->Paciente_model->listaPacientes();
        $data['pacientes'] = $lista;
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Paciente_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar()
    {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarPaciente_view');
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
        $data['rol'] = 'Paciente';

        $idUsuario = $this->Paciente_model->agregarUsuario($data);

        $dataPaciente['idPaciente'] = $idUsuario;
        $dataPaciente['alergias'] = $this->input->post('alergias');
        $dataPaciente['tipoSangre'] = $this->input->post('tipoSangre');
        $dataPaciente['historial_medico'] = $this->input->post('historial_medico');

        $this->Paciente_model->agregarPaciente($dataPaciente);

        redirect('paciente/index', 'refresh');
    }

    public function eliminarbd()
    {
        $idPaciente = $this->input->post('idPaciente');
        $this->Paciente_model->eliminarPaciente($idPaciente);
        redirect('paciente/index', 'refresh');
    }

    public function modificar()
    {
        $idPaciente = $this->input->post('idPaciente');
        $data['infoPaciente'] = $this->Paciente_model->recuperarPaciente($idPaciente);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarPaciente_view', $data);
        $this->load->view('inc/footer');
    }

    public function modificarbd()
    {
        $idPaciente = $this->input->post('idPaciente');
        $data['nombre'] = $this->input->post('nombre');
        $data['apellido'] = $this->input->post('apellido');
        $data['fechaNacimiento'] = $this->input->post('fechaNacimiento');
        $data['telefono'] = $this->input->post('telefono');
        $data['direccion'] = $this->input->post('direccion');
        $data['email'] = $this->input->post('email');
        $data['contrasenia'] = $this->input->post('contrasenia');

        $dataPaciente['alergias'] = $this->input->post('alergias');
        $dataPaciente['tipoSangre'] = $this->input->post('tipoSangre');
        $dataPaciente['historial_medico'] = $this->input->post('historial_medico');

        $this->Paciente_model->modificarUsuario($idPaciente, $data);
        $this->Paciente_model->modificarPaciente($idPaciente, $dataPaciente);

        redirect('paciente/index', 'refresh');
    }
}