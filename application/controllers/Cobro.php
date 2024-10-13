<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobro extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cobro_model');
        $this->load->model('Cita_model');
        $this->load->library('form_validation');
        $this->load->library('pdf');
        $this->load->library('ci_qrcode');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }


    public function index() {
        $this->load->model('Cita_model'); // Asegúrate de cargar el modelo Cita si no lo has hecho en el constructor
        $data['citas_pendientes'] = $this->Cobro_model->listarCitasPendientesPago();
        $data['cobros'] = $this->Cobro_model->listarCobros();
        
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Cobro_view', $data);
        $this->load->view('inc/footer');
    }

    

    public function registrar($idCita) {
        $cita = $this->Cita_model->recuperarCitaDetallada($idCita);
        if (!$cita) {
            $this->session->set_flashdata('error', 'La cita especificada no existe');
            redirect('cobro');
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
    
    public function ver($idCobro) {
        $data['cobro'] = $this->Cobro_model->obtenerCobro($idCobro);
        if (!$data['cobro']) {
            $this->session->set_flashdata('error', 'El cobro especificado no existe');
            redirect('cobro');
        }
        $data['cita'] = $this->Cita_model->recuperarCitaDetallada($data['cobro']->idCita);
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('verCobro_view', $data);
        $this->load->view('inc/footer');
    }

    
    private function generarNumeroComprobante() {
        return 'COMP-' . date('YmdHis') . '-' . rand(1000, 9999);
    }


 
    
    public function reporteIngresos() {
        $data['ingresos'] = $this->Cobro_model->obtenerIngresosPorPeriodo();
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('reporteIngresos_view', $data);
        $this->load->view('inc/footer');
    }

    public function generarComprobante($idCobro) {
        // Desactivar la salida del búfer
        ob_end_clean();
    
        $cobro = $this->Cobro_model->obtenerCobro($idCobro);
        $cita = $this->Cita_model->recuperarCitaDetallada($cobro->idCita);
        
        if (!$cobro || !$cita) {
            show_error('No se encontró el cobro o la cita especificada', 404);
            return;
        }
        
        try {
            $pdf = new Pdf('P', 'mm', 'A4');
            $pdf->AliasNbPages();
            $pdf->AddPage();
            
            // Título
            $pdf->SetFont('Arial', 'B', 16);
            $pdf->SetTextColor(25, 25, 112); // Azul oscuro
            $pdf->Cell(0, 10, 'Comprobante de Pago', 0, 1, 'C');
            $pdf->Ln(5);
    
            // Información del cobro
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(0);
    
            $pdf->WriteHTML("<b>ID de Cobro:</b> " . $cobro->idCobro);
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Fecha de Cobro:</b> " . date('d/m/Y H:i', strtotime($cobro->fechaCobro)));
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Paciente:</b> " . $cita->nombre_paciente . ' ' . $cita->apellido_paciente);
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Médico:</b> " . $cita->nombre_medico . ' ' . $cita->apellido_medico);
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Fecha de Cita:</b> " . date('d/m/Y H:i', strtotime($cita->fecha)));
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Tipo de Atención:</b> " . $cita->nombreTipoAtencion);
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Monto:</b> Bs. " . number_format($cobro->monto, 2));
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Método de Pago:</b> " . $cobro->metodoPago);
            $pdf->Ln(6);
            $pdf->WriteHTML("<b>Número de Comprobante:</b> " . $cobro->numeroComprobante);
            $pdf->Ln(10);
    
            // Línea divisoria
            $pdf->SetDrawColor(25, 25, 112); // Azul oscuro
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
            $pdf->Ln(5);
    
            // Generar y añadir código QR
            $qrData = "ID: $cobro->idCobro\nFecha: $cobro->fechaCobro\nMonto: Bs. " . number_format($cobro->monto, 2);
            $qrParams = array(
                'data' => $qrData,
                'level' => 'H',
                'size' => 5
            );
            
            $qrCodePath = $this->ci_qrcode->generate($qrParams);
            
            if (file_exists($qrCodePath)) {
                $pdf->Image($qrCodePath, 80, 130, 50, 50, 'PNG');
                unlink($qrCodePath); // Eliminar el archivo temporal del QR
            }
            
            $pdf->Output('comprobante_'.$idCobro.'.pdf', 'I');
        } catch (Exception $e) {
            log_message('error', 'Error al generar el PDF: ' . $e->getMessage());
            show_error('Hubo un problema al generar el comprobante. Por favor, inténtelo de nuevo más tarde.', 500);
        }
    }
    
    
    private function generateQRCode($data) {
        $this->load->library('ciqrcode');
        $params['data'] = $data;
        $params['level'] = 'H';
        $params['size'] = 10;
        $params['savename'] = FCPATH . 'assets/img/qr_' . time() . '.png';
        $this->ciqrcode->generate($params);
        return $params['savename'];
    }
}