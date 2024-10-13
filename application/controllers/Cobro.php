<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cobro_model');
        $this->load->model('Cita_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }


    public function index() {
        $data['cobros'] = $this->Cobro_model->listarCobros();
        $data['citas_pendientes'] = $this->Cita_model->listarCitasPendientesPago();
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Cobro_view', $data);
        $this->load->view('inc/footer');
    }


    public function ver($idCita) {
        $data['cobro'] = $this->Cobro_model->obtenerCobroPorIdCita($idCita);
        $data['cita'] = $this->Cita_model->recuperarCitaDetallada($idCita);
        
        if (!$data['cita']) {
            show_404('Cita no encontrada');
        }
        
        if (!$data['cobro']) {
            $this->session->set_flashdata('error', 'No se ha registrado un cobro para esta cita.');
            redirect('cobro');
        }
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('verCobro_view', $data);
        $this->load->view('inc/footer');
    }


    public function registrar($idCita) {
        $cita = $this->Cita_model->recuperarCitaDetallada($idCita);
        if (!$cita) {
            $this->session->set_flashdata('error', 'La cita especificada no existe');
            redirect('cita');
        }
    
        if ($this->input->post()) {
            $this->form_validation->set_rules('metodoPago', 'Método de Pago', 'required');
    
            if ($this->form_validation->run() == FALSE) {
                $this->cargarVistaRegistrarCobro($cita);
            } else {
                $datos_cobro = array(
                    'idCita' => $idCita,
                    'monto' => $cita->costoAtencion,
                    'metodoPago' => $this->input->post('metodoPago'),
                    'fechaCobro' => date('Y-m-d H:i:s'),
                    'numeroComprobante' => $this->generarNumeroComprobante()
                );
    
                $resultado = $this->Cobro_model->registrarCobro($datos_cobro);
    
                if ($resultado) {
                    $this->Cita_model->actualizarEstadoCita($idCita, 'confirmada');
                    $this->session->set_flashdata('mensaje', 'Pago registrado con éxito. La cita ha sido confirmada.');
                    redirect('cobro');
                } else {
                    $this->session->set_flashdata('error', 'Error al registrar el pago');
                    redirect('cobro/registrar/' . $idCita);
                }
            }
        } else {
            $this->cargarVistaRegistrarCobro($cita);
        }
    }
    
    private function cargarVistaRegistrarCobro($cita) {
        $data['cita'] = $cita;
        $data['numero_correlativo'] = $this->Cita_model->obtenerNumeroCorrelativo($cita->idCita);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formRegistrarCobro_view', $data);
        $this->load->view('inc/footer');
    }
    
    public function cancelar() {
        $this->session->set_flashdata('mensaje', 'Operación de pago cancelada');
        redirect('cita');
    }
    
    
    private function generarNumeroComprobante() {
        return 'COMP-' . date('YmdHis') . '-' . rand(1000, 9999);
    }


    public function generarComprobante($idCobro) {
        $cobro = $this->Cobro_model->obtenerCobro($idCobro);
        
        if (!$cobro) {
            show_404();
        }
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Comprobante de Pago');
        $pdf->SetSubject('Comprobante de Pago');
        
        $pdf->AddPage();
        
        $html = $this->load->view('pdf/comprobante_cobro', ['cobro' => $cobro], true);
        $pdf->writeHTML($html, true, false, true, false, '');
        
        $pdf->Output('comprobante_'.$idCobro.'.pdf', 'I');
    }
    
    /*
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
    */
    
    public function reporteIngresos() {
        $data['ingresos'] = $this->Cobro_model->obtenerIngresosPorPeriodo();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('reporteIngresos_view', $data);
        $this->load->view('inc/footer');
    }
}