<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cita_model');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }

    public function index() {
        $data['citas'] = $this->Cita_model->obtenerCitasParaCalendario();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('home_view', $data);
        $this->load->view('inc/footer');
    }

    public function obtenerCitas() {
        $this->load->model('Cita_model');
        $citas = $this->Cita_model->obtenerCitasParaCalendario();
        echo json_encode($citas);
    }
}