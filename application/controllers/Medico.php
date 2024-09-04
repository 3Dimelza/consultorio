<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medico extends CI_Controller {
	
	public function index()
	{
        $lista=$this->Medico_model->listaMedicos();
		$data['medicos']=$lista;
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('Medico_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');

	}

    public function agregar()
    {

        $this->load->view('inc/head');
        $this->load->view('inc/header');
        //$this->load->view('inc/menu');
        $this->load->view('formAgregarMedico_view');
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

        $this->Medico_model->agregarMedico($data);

        redirect('medico/index','refresh');//REDIRECCIONAR A LA LISTA
    }

    public function eliminarbd()
    {
        $idMedico=$_POST['idMedico'];
        $this->Medico_model->eliminarMedico($idMedico);
        
        redirect('medico/index','refresh');//REDIRECCIONAR A LA LISTA

    }

    public function modificar()
    {
        $idMedico=$_POST['idMedico'];
        //echo $idMedico;
        $idMedico=$_POST['idMedico'];
        $data['infoMedico']=$this->Medico_model->recuperarMedico($idMedico);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        
        //$this->load->view('inc/menu');
        $this->load->view('formModificarMedico_view',$data);
        $this->load->view('inc/footer');
        //$this->load->view('inc/pie');
    
    }

    public function modificarbd()
    {
        $idMedico=$_POST['idMedico'];
        $data['nombre']=$_POST['idMedico'];
        

        $data['nombre'] = $_POST['nombre'];
        $data['apellido'] = $_POST['apellido'];
        $data['fechaNacimiento'] = $_POST['fechaNacimiento'];
        $data['telefono'] = $_POST['telefono'];
        $data['direccion'] = $_POST['direccion'];
        $data['email'] = $_POST['email'];
        $data['contrasenia'] = $_POST['contrasenia'];
        $data['rol'] = $_POST['rol'];

        $this->Medico_model->modificarMedico($idMedico,$data);
        redirect('medico/index','refresh');//REDIRECCIONAR A LA LISTA
        
    }

    // public function pruebabd(){
    //     $query=$this->db->get('medicos');
    //     $execonsulta=$query->result();
    //     print_r($execonsulta);
    // }

    // public function personas()
    // {

    // $lista=$this->Medico_model->listaMedicos();
    // $data['medicos']=$lista;
    // $this->load->view('Medico_view',$data);
    // }
}
