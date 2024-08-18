<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('User_model');
    }

    public function index() {
        $this->load->view('login');
    }

    public function authenticate() {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->User_model->validate_user($email, $password);

        if ($user) {
            $session_data = array(
                'idUsuario' => $user->idUsuario,
                'nombre' => $user->nombre,
                'apellido' => $user->apellido,
                'email' => $user->email,
                'rol' => $user->rol,
                'logged_in' => TRUE
            );

            $this->session->set_userdata($session_data);

            // Redirigir según el rol del usuario
            if ($user->rol === 'administrador') {
                redirect('Administrador');
            } elseif ($user->rol === 'medico') {
                redirect('medico');
            } elseif ($user->rol === 'paciente') {
                redirect('paciente');
            } else {
                $this->session->set_flashdata('error', 'Rol no reconocido');
                redirect('login');
            }
        } else {
            $this->session->set_flashdata('error', 'Email o contraseña incorrectos');
            redirect('login');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
