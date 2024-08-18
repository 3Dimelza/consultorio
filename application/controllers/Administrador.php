<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {
	
	public function index()
	{
        $lista=$this->Administrador_model->listaUsuarios();
		$data['usuarios']=$lista;
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('Administrador_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');

	}

    public function agregar()
    {

        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('formAgregarUsuario_view');
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

        $this->Administrador_model->agregarUsuario($data);

        redirect('administrador/index','refresh');//REDIRECCIONAR A LA LISTA
    }

    public function eliminarbd()
    {
        $idUsuario=$_POST['idUsuario'];
        $this->Administrador_model->eliminarUsuario($idUsuario);
        
        redirect('administrador/index','refresh');//REDIRECCIONAR A LA LISTA

    }

    public function modificar()
    {
        $idUsuario=$_POST['idUsuario'];
        //echo $idUsuario;
        $idUsuario=$_POST['idUsuario'];
        $data['infoUsuario']=$this->Administrador_model->recuperarUsuario($idUsuario);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        
        //$this->load->view('inc/menu');
        $this->load->view('formModificarUsuario_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');
    
    }

    public function modificarbd()
    {
        $idUsuario=$_POST['idUsuario'];
        $data['nombre']=$_POST['idUsuario'];
        

        $data['nombre'] = $_POST['nombre'];
        $data['apellido'] = $_POST['apellido'];
        $data['fechaNacimiento'] = $_POST['fechaNacimiento'];
        $data['telefono'] = $_POST['telefono'];
        $data['direccion'] = $_POST['direccion'];
        $data['email'] = $_POST['email'];
        $data['contrasenia'] = $_POST['contrasenia'];
        $data['rol'] = $_POST['rol'];

        $this->Administrador_model->modificarUsuario($idUsuario,$data);
        redirect('administrador/index','refresh');//REDIRECCIONAR A LA LISTA
        
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
