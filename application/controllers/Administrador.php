<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

        $this->lang->load('form_validation', 'spanish');
        $this->lang->load('db', 'spanish');
        
        $this->load->model('Administrador_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }

    public function index() {
        $data['usuarios'] = $this->Administrador_model->listaUsuarios(1);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Administrador_view', $data);
        $this->load->view('inc/footer');
    }

    public function usuariosDeshabilitados() {
        $data['usuarios'] = $this->Administrador_model->listaUsuarios(0);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('UsuariosDeshabilitados_view', $data);
        $this->load->view('inc/footer');
    }

    public function cambiarEstado($idUsuario, $nuevoEstado) {
        $resultado = $this->Administrador_model->cambiarEstadoUsuario($idUsuario, $nuevoEstado);
        if ($resultado) {
            $mensaje = $nuevoEstado == 1 ? 'Usuario habilitado con éxito' : 'Usuario deshabilitado con éxito';
            $this->session->set_flashdata('mensaje', $mensaje);
        } else {
            $this->session->set_flashdata('error', 'Error al cambiar el estado del usuario');
        }
        redirect($nuevoEstado == 1 ? 'administrador/usuariosDeshabilitados' : 'administrador/index');
    }

    public function agregar() {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarUsuario_view');
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
        $this->form_validation->set_rules('rol', 'Rol', 'required|in_list[Administrador,Paciente,Medico]');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('inc/head');
            $this->load->view('inc/header');
            $this->load->view('formAgregarUsuario_view');
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
                'rol' => $this->input->post('rol'),
                'estado' => 1
            );
    
            $this->db->trans_start();
    
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
            }
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Error al agregar el usuario: ' . $this->db->error()['message']);
            } else {
                $this->session->set_flashdata('mensaje', 'Usuario agregado con éxito');
            }
    
            redirect('administrador/index', 'refresh');
        }
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
    
        $this->form_validation->set_rules('nombre', 'Nombre', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required|regex_match[/^[A-Z][a-z]+(?:\s[A-Z][a-z]+)*$/]');
        $this->form_validation->set_rules('fechaNacimiento', 'Fecha de Nacimiento', 'required|callback_check_date');
        $this->form_validation->set_rules('telefono', 'Teléfono', 'required|regex_match[/^[67]\d{7}$/]|callback_check_unique_telefono['.$idUsuario.']');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required|min_length[10]|max_length[255]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_unique_email['.$idUsuario.']');
        $this->form_validation->set_rules('rol', 'Rol', 'required|in_list[Administrador,Paciente,Medico]');
        $this->form_validation->set_rules('nombre_completo', 'Nombre completo', 'callback_check_unique_full_name['.$idUsuario.']');

        if ($this->input->post('contrasenia')) {
            $this->form_validation->set_rules('contrasenia', 'Contraseña', 'min_length[8]');
        }


        if ($this->form_validation->run() == FALSE) {
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
        } else {
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
    
            $this->db->trans_start();
    
            $resultado = $this->Administrador_model->modificarUsuario($idUsuario, $data);
    
            if ($resultado) {
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
            }
    
            $this->db->trans_complete();
    
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Error al modificar el usuario: ' . $this->db->error()['message']);
            } else {
                $this->session->set_flashdata('mensaje', 'Usuario modificado con éxito');
            }
    
            redirect('administrador/index');
        }
    }
    
    public function eliminarbd() {
        $idUsuario = $this->input->post('idUsuario');
        $usuario = $this->Administrador_model->recuperarUsuario($idUsuario);
        
        if ($usuario) {
            $this->db->trans_start();
            
            if ($usuario->rol == 'Paciente') {
                $this->Administrador_model->eliminarPaciente($idUsuario);
            } elseif ($usuario->rol == 'Medico') {
                $this->Administrador_model->eliminarMedico($idUsuario);
            }
            
            $this->Administrador_model->eliminarUsuario($idUsuario);
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $this->session->set_flashdata('error', 'Error al eliminar el usuario. Por favor, inténtelo de nuevo.');
            } else {
                $this->session->set_flashdata('mensaje', 'Usuario eliminado con éxito');
            }
        } else {
            $this->session->set_flashdata('error', 'Usuario no encontrado');
        }
        
        redirect('administrador/index', 'refresh');
    }

    public function check_date($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        if (!$d || $d->format('Y-m-d') !== $date) {
            $this->form_validation->set_message('check_date', 'La fecha {field} no es válida.');
            return FALSE;
        }
        return TRUE;
    }

    public function check_unique_email($email, $idUsuario) {
        $this->db->where('email', $email);
        $this->db->where('idUsuario !=', $idUsuario);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_email', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }


   public function check_unique_full_name($full_name, $idUsuario = null) {
    $nombre = $this->input->post('nombre');
    $apellido = $this->input->post('apellido');
    $full_name = $nombre . ' ' . $apellido;

    $this->db->where("CONCAT(nombre, ' ', apellido) =", $full_name);
    if ($idUsuario) {
        $this->db->where('idUsuario !=', $idUsuario);
    }
    $query = $this->db->get('usuarios');

    if ($query->num_rows() > 0) {
        $this->form_validation->set_message('check_unique_full_name', 'Ya existe un usuario con el nombre completo {field}.');
        return FALSE;
    }
    return TRUE;
}
    
    public function check_unique_telefono($telefono, $idUsuario) {
        $this->db->where('telefono', $telefono);
        $this->db->where('idUsuario !=', $idUsuario);
        $query = $this->db->get('usuarios');
        
        if ($query->num_rows() > 0) {
            $this->form_validation->set_message('check_unique_telefono', 'El {field} ya está en uso por otro usuario.');
            return FALSE;
        }
        return TRUE;
    }


    public function listapdf()
	{
		if($this->session->userdata('tipo')=='admin')
		{ 
			$lista=$this->estudiante_model->listaestudiantes();
			$lista=$lista->result();

			$this->pdf=new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Lista de estudiantes");
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE ESTUDIANTES',0,0,'C',1);
			$this->pdf->Ln(10);

			$this->pdf->Cell(9,5,'No.','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'PRIMER APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'SEGUNDO APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'NOTA','TBLR',0,'L',0);
			$this->pdf->Ln(5);

			$this->pdf->SetFont('Arial','',9);
			$num=1;
			foreach ($lista as $row) {
				$nombre=$row->nombre;
				$primerapellido=$row->primerApellido;
				$segundoapellido=$row->segundoApellido;
				$nota=$row->nota;
				$this->pdf->Cell(9,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$primerapellido,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$segundoapellido,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$nota,'TBLR',0,'L',0);
				$this->pdf->Ln(5);
				$num++;
			}

			$this->pdf->Output("listaestudiantes.pdf","I");

		}
		else
		{
			redirect('usuarios/panel','refresh');
		}
	}

    public function logout() {
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('id_usuario');
        $this->session->sess_destroy();
        redirect('login');
    }
}