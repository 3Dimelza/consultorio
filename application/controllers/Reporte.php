<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Reporte_model');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }

    public function index() {
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Reporte_view');
        $this->load->view('inc/footer');
    }

    public function citasPorMedico() {
        $data['reporte'] = $this->Reporte_model->getCitasPorMedico();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('reporteCitasPorMedico_view', $data);
        $this->load->view('inc/footer');
    }

    public function ingresosPorMes() {
        $data['reporte'] = $this->Reporte_model->getIngresosPorMes();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('reporteIngresosPorMes_view', $data);
        $this->load->view('inc/footer');
    }

    public function pacientesFrecuentes() {
        $data['reporte'] = $this->Reporte_model->getPacientesFrecuentes();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('reportePacientesFrecuentes_view', $data);
        $this->load->view('inc/footer');
    }

    public function generarPDF($tipoReporte) {
        $this->load->library('pdf');
        
        switch($tipoReporte) {
            case 'citasPorMedico':
                $data['reporte'] = $this->Reporte_model->getCitasPorMedico();
                $vista = 'pdf/reporteCitasPorMedico';
                $titulo = 'Reporte de Citas por Médico';
                break;
            case 'ingresosPorMes':
                $data['reporte'] = $this->Reporte_model->getIngresosPorMes();
                $vista = 'pdf/reporteIngresosPorMes';
                $titulo = 'Reporte de Ingresos por Mes';
                break;
            case 'pacientesFrecuentes':
                $data['reporte'] = $this->Reporte_model->getPacientesFrecuentes();
                $vista = 'pdf/reportePacientesFrecuentes';
                $titulo = 'Reporte de Pacientes Frecuentes';
                break;
            default:
                show_error('Tipo de reporte no válido');
                return;
        }
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle($titulo);
        $pdf->SetSubject($titulo);
        
        $pdf->AddPage();
        
        $html = $this->load->view($vista, $data, true);
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->Output($tipoReporte.'.pdf', 'I');
    }
}