<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->lang->load('form_validation', 'spanish');
        $this->lang->load('db', 'spanish');
        
        $this->load->model('Medico_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }
    
    public function index() {
        $data['medicos'] = $this->Medico_model->listaMedicos(1); // 1 para médicos habilitados
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Medico_view', $data);
        $this->load->view('inc/footer');
    }

    public function medicosDeshabilitados() {
        $data['medicos'] = $this->Medico_model->listaMedicos(0); // 0 para médicos deshabilitados
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('MedicosDeshabilitados_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar() {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarMedico_view');
        $this->load->view('inc/footer');
    }

    public function agregarbd()
    {
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'required|callback_check_date');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|regex_match[/^[67]\d{7}$/]|is_unique[usuarios.telefono]');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[usuarios.email]');
        $this->form_validation->set_rules('contrasenia', 'Contraseña', 'required|min_length[8]');
        $this->form_validation->set_rules('especialidad', 'Especialidad', 'required');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inc/head');
            $this->load->view('inc/header');
            $this->load->view('formAgregarMedico_view');
            $this->load->view('inc/footer');
        } else {
            $data = array(
                'nombre' => $this->input->post('nombre'),
                'apellido' => $this->input->post('apellido'),
                'fechaNacimiento' => $this->input->post('fechaNacimiento'),
                'telefono' => $this->input->post('telefono'),
                'direccion' => $this->input->post('direccion'),
                'email' => $this->input->post('email'),
                'contrasenia' => password_hash($this->input->post('contrasenia'), PASSWORD_DEFAULT),
                'rol' => 'Medico',
                'estado' => 1
            );
    
            $idUsuario = $this->Medico_model->agregarUsuario($data);
    
            if ($idUsuario) {
                $dataMedico = array(
                    'idMedico' => $idUsuario,
                    'especialidad' => $this->input->post('especialidad')
                );
                $this->Medico_model->agregarMedico($dataMedico);
                $this->session->set_flashdata('mensaje', 'Médico agregado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al agregar el médico');
            }
    
            redirect('medico/index', 'refresh');
        }
    }


    public function modificar() {
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
    
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'required|callback_check_date');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|regex_match[/^[67]\d{7}$/]|callback_check_unique_telefono['.$idMedico.']');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$idMedico.']');
        $this->form_validation->set_rules('especialidad', 'Especialidad', 'required');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name['.$idMedico.']');

        if ($this->input->post('contrasenia')) {
            $this->form_validation->set_rules('contrasenia', 'Contraseña', 'min_length[8]');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['infoMedico'] = $this->Medico_model->recuperarMedico($idMedico);
            $this->load->view('inc/head');
            $this->load->view('inc/header');
            $this->load->view('formModificarMedico_view', $data);
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
                $data['contrasenia'] = password_hash($this->input->post('contrasenia'), PASSWORD_DEFAULT);
            }
    
            $dataMedico = array(
                'especialidad' => $this->input->post('especialidad')
            );
    
            $resultado = $this->Medico_model->modificarUsuario($idMedico, $data);
            $resultadoMedico = $this->Medico_model->modificarMedico($idMedico, $dataMedico);
    
            if ($resultado && $resultadoMedico) {
                $this->session->set_flashdata('mensaje', 'Médico modificado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al modificar el médico');
            }
    
            redirect('medico/index');
        }
    }


    public function cambiarEstado($idMedico, $nuevoEstado) {
        $resultado = $this->Medico_model->cambiarEstadoMedico($idMedico, $nuevoEstado);
        if ($resultado) {
            $mensaje = $nuevoEstado == 1 ? 'Médico habilitado con éxito' : 'Médico deshabilitado con éxito';
            $this->session->set_flashdata('mensaje', $mensaje);
        } else {
            $this->session->set_flashdata('error', 'Error al cambiar el estado del médico');
        }
        redirect($nuevoEstado == 1 ? 'medico/medicosDeshabilitados' : 'medico/index');
    }

    public function eliminarbd() {
        $idMedico = $this->input->post('idMedico');
        $resultado = $this->Medico_model->eliminarMedico($idMedico);
        if ($resultado) {
            $this->session->set_flashdata('mensaje', 'Médico eliminado con éxito');
        } else {
            $this->session->set_flashdata('error', 'Error al eliminar el médico');
        }
        redirect('medico/medicosDeshabilitados');
    }

    // Funciones de validación personalizadas
    public function check_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!$d || $d->format('Y-m-d') !== $date) {
            $this->form_validation->set_message('check_date', 'La fecha {field} no es válida.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_unique_email($email, $idMedico) {
        $this->db->where('email', $email);
        $this->db->where('idUsuario !=', $idMedico);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_email', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_unique_full_name($full_name, $idMedico = null) {
        $nombre = $this->input->post('nombre');
        $apellido = $this->input->post('apellido');
        $full_name = $nombre . ' ' . $apellido;

        $this->db->where("CONCAT(nombre, ' ', apellido) =", $full_name);
        if ($idMedico) {
            $this->db->where('idUsuario !=', $idMedico);
        }
        $query = $this->db->get('usuarios');

        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_full_name', 'Ya existe un usuario con el nombre completo {field}.');
            return FALSE;
        }
        return TRUE;
    }
    
    public function check_unique_telefono($telefono, $idMedico) {
        $this->db->where('telefono', $telefono);
        $this->db->where('idUsuario !=', $idMedico);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_telefono', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }

}