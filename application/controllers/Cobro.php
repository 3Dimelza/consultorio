<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cobro_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }

    public function index() {
        $data['cobros'] = $this->Cobro_model->listarCobros();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Cobro_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregar() {
        $data['citas'] = $this->Cobro_model->getCitasPendientesCobro();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarCobro_view', $data);
        $this->load->view('inc/footer');
    }

    public function agregarbd() {
        $this->form_validation->set_rules('idCita', 'Cita', 'required');
        $this->form_validation->set_rules('monto', 'Monto', 'required|numeric');
        $this->form_validation->set_rules('metodoPago', 'Método de Pago', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->agregar();
        } else {
            $datos_cobro = array(
                'idCita' => $this->input->post('idCita'),
                'monto' => $this->input->post('monto'),
                'metodoPago' => $this->input->post('metodoPago'),
                'fechaCobro' => date('Y-m-d H:i:s')
            );

            $resultado = $this->Cobro_model->registrarCobro($datos_cobro);

            if ($resultado) {
                $this->session->set_flashdata('mensaje', 'Cobro registrado con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al registrar el cobro');
            }

            redirect('cobro');
        }
    }

    public function ver($idCobro) {
        $data['cobro'] = $this->Cobro_model->obtenerCobro($idCobro);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('verCobro_view', $data);
        $this->load->view('inc/footer');
    }

    public function generarRecibo($idCobro) {
        $this->load->library('pdf');
        $cobro = $this->Cobro_model->obtenerCobro($idCobro);
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Recibo de Cobro');
        $pdf->SetSubject('Recibo de Cobro');
        
        $pdf->AddPage();
        
        $html = $this->load->view('pdf/recibo_cobro', ['cobro' => $cobro], true);
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->Output('recibo_'.$idCobro.'.pdf', 'I');
    }
}