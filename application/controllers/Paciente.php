<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->lang->load('form_validation', 'spanish');
        $this->lang->load('db', 'spanish');
        $this->load->model('Paciente_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }


    public function index() {
        $data['pacientes'] = $this->Paciente_model->listaPacientes(1);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Paciente_view', $data);
        $this->load->view('inc/footer');
    }


    public function pacientesDeshabilitados() {
        $data['pacientes'] = $this->Paciente_model->listaPacientes(0);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('PacientesDeshabilitados_view', $data);
        $this->load->view('inc/footer');
    }


    public function cambiarEstado($idPaciente, $nuevoEstado) {
        $resultado = $this->Paciente_model->cambiarEstadoPaciente($idPaciente, $nuevoEstado);
        if ($resultado) {
            $mensaje = $nuevoEstado == 1 ? 'Paciente habilitado con éxito' : 'Paciente deshabilitado con éxito';
            $this->session->set_flashdata('mensaje', $mensaje);
        } else {
            $this->session->set_flashdata('error', 'Error al cambiar el estado del paciente');
        }
        redirect($nuevoEstado == 1 ? 'paciente/pacientesDeshabilitados' : 'paciente/index');
    }



    public function agregar() {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarPaciente_view');
        $this->load->view('inc/footer');
    }

    public function agregarbd() {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'required|callback_check_date');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|regex_match[/^[67]\d{7}$/]|is_unique[usuarios.telefono]');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('contrasenia', 'Contraseña', 'required|min_length[8]');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inc/head');
            $this->load->view('inc/header');
            $this->load->view('formAgregarPaciente_view');
            $this->load->view('inc/footer');
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'fechaNacimiento' => $this->input->post('fechaNacimiento'),
                'telefono' => $this->input->post('telefono'),
                'direccion' => $this->input->post('direccion'),
                'email' => $this->input->post('email'),
                'contrasenia' => $this->input->post('contrasenia'),
                'rol' => 'Paciente',
                'estado' => 1
            );

            $idUsuario = $this->Paciente_model->agregarUsuario($data);

            if ($idUsuario) {
                $dataPaciente = array(
                    'idPaciente' => $idUsuario,
                    'alergias' => $this->input->post('alergias'),
                    'tipoSangre' => $this->input->post('tipoSangre'),
                    'historial_medico' => $this->input->post('historial_medico')
                );

                $this->Paciente_model->agregarPaciente($dataPaciente);
                $this->session->set_flashdata('mensaje', 'Paciente agregado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar el paciente');
            }

            redirect('paciente/index', 'refresh');
        }
    }
    
    public function modificar($idPaciente) {
        $data['paciente'] = $this->Paciente_model->recuperarPaciente($idPaciente);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarPaciente_view', $data);
        $this->load->view('inc/footer');
    }

    public function modificarbd() {
        $idPaciente = $this->input->post('idPaciente');

        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'required|callback_check_date');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|regex_match[/^[67]\d{7}$/]|callback_check_unique_telefono['.$idPaciente.']');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$idPaciente.']');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name['.$idPaciente.']');

        if ($this->input->post('contrasenia')) {
            $this->form_validation->set_rules('contrasenia', 'Contraseña', 'min_length[8]');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['paciente'] = $this->Paciente_model->recuperarPaciente($idPaciente);
            $this->load->view('inc/head');
            $this->load->view('inc/header');
            $this->load->view('formModificarPaciente_view', $data);
            $this->load->view('inc/footer');
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'fechaNacimiento' => $this->input->post('fechaNacimiento'),
                'telefono' => $this->input->post('telefono'),
                'direccion' => $this->input->post('direccion'),
                'email' => $this->input->post('email')
            );

            if ($this->input->post('contrasenia')) {
                $data['contrasenia'] = $this->input->post('contrasenia');
            }

            $resultado = $this->Paciente_model->modificarUsuario($idPaciente, $data);

            $dataPaciente = array(
                'alergias' => $this->input->post('alergias'),
                'tipoSangre' => $this->input->post('tipoSangre'),
                'historial_medico' => $this->input->post('historial_medico')
            );

            $resultadoPaciente = $this->Paciente_model->modificarPaciente($idPaciente, $dataPaciente);

            if ($resultado && $resultadoPaciente) {
                $this->session->set_flashdata('mensaje', 'Paciente modificado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al modificar el paciente');
            }

            redirect('paciente/index');
        }
    }
    
    public function eliminarbd()
    {
        $idPaciente = $this->input->post('idPaciente');
        $paciente = $this->Paciente_model->recuperarPaciente($idPaciente);
        
        if ($paciente) {
            $this->db->trans_start();
            
            $this->Paciente_model->eliminarPaciente($idPaciente);
            $this->Paciente_model->eliminarUsuario($idPaciente);
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Error al eliminar el paciente. Por favor, inténtelo de nuevo.');
            } else {
                $this->session->set_flashdata('mensaje', 'Paciente eliminado con éxito');
            }
        } else {
            $this->session->set_flashdata('error', 'Paciente no encontrado');
        }
        
        redirect('paciente/index', 'refresh');
    }

    public function check_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!$d || $d->format('Y-m-d') !== $date) {
            $this->form_validation->set_message('check_date', 'La fecha {field} no es válida.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_unique_email($email, $idPaciente) {
        $this->db->where('email', $email);
        $this->db->where('idUsuario !=', $idPaciente);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_email', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_unique_full_name($full_name, $idPaciente = null) {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $full_name = $nombre . ' ' . $apellido;

        $this->db->where("CONCAT(nombre, ' ', apellido) =", $full_name);
        if ($idPaciente) {
            $this->db->where('idUsuario !=', $idPaciente);
        }
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_full_name', 'Ya existe un usuario con el nombre completo {field}.');
            return FALSE;
        }
        return TRUE;
    }
    
    public function check_unique_telefono($telefono, $idPaciente) {
        $this->db->where('telefono', $telefono);
        $this->db->where('idUsuario !=', $idPaciente);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_telefono', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }
    
    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id_usuario');
        $this->session->sess_destroy();
        redirect('login');
    }
}