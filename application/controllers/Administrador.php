<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Administrador_model');
    }

    public function index() {
        $data['usuarios'] = $this->Administrador_model->listaUsuarios();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Administrador_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar() {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarUsuario_view');
        $this->load->view('inc/footer');
    }

    public function agregarbd() {
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'fechaNacimiento' => $this->input->post('fechaNacimiento'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'email' => $this->input->post('email'),
            'contrasenia' => password_hash($this->input->post('contrasenia'), PASSWORD_DEFAULT),
            'rol' => $this->input->post('rol')
        );

        $idUsuario = $this->Administrador_model->agregarUsuario($data);

        if ($idUsuario) {
            if ($data['rol'] == 'Paciente') {
                $dataPaciente = array(
                    'idPaciente' => $idUsuario,
                    'alergias' => $this->input->post('alergias'),
                    'tipoSangre' => $this->input->post('tipoSangre'),
                    'historial_medico' => $this->input->post('historial_medico')
                );
                $this->Administrador_model->agregarPaciente($dataPaciente);
            } elseif ($data['rol'] == 'Medico') {
                $dataMedico = array(
                    'idMedico' => $idUsuario,
                    'especialidad' => $this->input->post('especialidad')
                );
                $this->Administrador_model->agregarMedico($dataMedico);
            }
            $this->session->set_flashdata('mensaje', 'Usuario agregado con éxito');
        } else {
            $this->session->set_flashdata('error', 'Error al agregar el usuario');
        }

        redirect('administrador/index', 'refresh');
    }

    public function modificar($idUsuario) {
        $data['usuario'] = $this->Administrador_model->recuperarUsuario($idUsuario);
        if ($data['usuario']->rol == 'Paciente') {
            $data['paciente'] = $this->Administrador_model->recuperarPaciente($idUsuario);
        } elseif ($data['usuario']->rol == 'Medico') {
            $data['medico'] = $this->Administrador_model->recuperarMedico($idUsuario);
        }
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarUsuario_view', $data);
        $this->load->view('inc/footer');
    }

    public function modificarbd() {
        $idUsuario = $this->input->post('idUsuario');
        $data = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'fechaNacimiento' => $this->input->post('fechaNacimiento'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'email' => $this->input->post('email'),
            'rol' => $this->input->post('rol')
        );

        if ($this->input->post('contrasenia')) {
            $data['contrasenia'] = password_hash($this->input->post('contrasenia'), PASSWORD_DEFAULT);
        }

        $this->Administrador_model->modificarUsuario($idUsuario, $data);

        if ($data['rol'] == 'Paciente') {
            $dataPaciente = array(
                'alergias' => $this->input->post('alergias'),
                'tipoSangre' => $this->input->post('tipoSangre'),
                'historial_medico' => $this->input->post('historial_medico')
            );
            $this->Administrador_model->modificarPaciente($idUsuario, $dataPaciente);
        } elseif ($data['rol'] == 'Medico') {
            $dataMedico = array(
                'especialidad' => $this->input->post('especialidad')
            );
            $this->Administrador_model->modificarMedico($idUsuario, $dataMedico);
        }

        $this->session->set_flashdata('mensaje', 'Usuario modificado con éxito');
        redirect('administrador/index', 'refresh');
    }

    public function eliminarbd() {
        $idUsuario = $this->input->post('idUsuario');
        $usuario = $this->Administrador_model->recuperarUsuario($idUsuario);
        
        if ($usuario) {
            if ($usuario->rol == 'Paciente') {
                $this->Administrador_model->eliminarPaciente($idUsuario);
            } elseif ($usuario->rol == 'Medico') {
                $this->Administrador_model->eliminarMedico($idUsuario);
            }
            $this->Administrador_model->eliminarUsuario($idUsuario);
            $this->session->set_flashdata('mensaje', 'Usuario eliminado con éxito');
        } else {
            $this->session->set_flashdata('error', 'Usuario no encontrado');
        }
        
        redirect('administrador/index', 'refresh');
    }
}