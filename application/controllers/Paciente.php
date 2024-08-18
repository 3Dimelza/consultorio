<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paciente extends CI_Controller {
	
	public function index()
	{
        $lista=$this->Paciente_model->listaPacientes();
		$data['pacientes']=$lista;
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('Paciente_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');

	}

    public function agregar()
    {

        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('formAgregarPaciente_view');
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');
    }


    public function agregarbd()
    {
        $data['nombre'] = $_POST['nombre'];
        $data['apellido'] = $_POST['apellido'];
        $data['fechaNacimiento'] = $_POST['fechaNacimiento'];
        $data['telefono'] = $_POST['telefono'];
        $data['direccion'] = $_POST['direccion'];
        $data['email'] = $_POST['email'];
        $data['contrasenia'] = $_POST['contrasenia'];
        $data['rol'] = $_POST['rol'];

        $this->Paciente_model->agregarPaciente($data);

        redirect('Paciente/index','refresh');//REDIRECCIONAR A LA LISTA
    }

    public function eliminarbd()
    {
        $idPaciente=$_POST['idPaciente'];
        $this->Paciente_model->eliminarPaciente($idPaciente);
        
        redirect('Paciente/index','refresh');//REDIRECCIONAR A LA LISTA

    }

    public function modificar()
    {
        $idPaciente=$_POST['idPaciente'];
        //echo $idPaciente;
        $idPaciente=$_POST['idPaciente'];
        $data['infoPaciente']=$this->Paciente_model->recuperarPaciente($idPaciente);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        
        //$this->load->view('inc/menu');
        $this->load->view('formModificarPaciente_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');
    
    }

    public function modificarbd()
    {
        $idPaciente=$_POST['idPaciente'];
        $data['nombre']=$_POST['idPaciente'];
        

        $data['nombre'] = $_POST['nombre'];
        $data['apellido'] = $_POST['apellido'];
        $data['fechaNacimiento'] = $_POST['fechaNacimiento'];
        $data['telefono'] = $_POST['telefono'];
        $data['direccion'] = $_POST['direccion'];
        $data['email'] = $_POST['email'];
        $data['contrasenia'] = $_POST['contrasenia'];
        $data['rol'] = $_POST['rol'];

        $this->Paciente_model->modificarPaciente($idPaciente,$data);
        redirect('Paciente/index','refresh');//REDIRECCIONAR A LA LISTA
        
    }

    // public function pruebabd(){
    //     $query=$this->db->get('usuarios');
    //     $execonsulta=$query->result();
    //     print_r($execonsulta);
    // }

    // public function personas()
    // {

    // $lista=$this->Administrador_model->listaUsuarios();
    // $data['usuarios']=$lista;
    // $this->load->view('Administrador_view',$data);
    // }
}
