<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cita extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Cita_model');
        $this->load->model('Medico_model');
        $this->load->model('Paciente_model');
        $this->load->library('form_validation');
        
        if(!$this->session->userdata('logged_in')){
            redirect('login');
        }
    }

    public function index() {
        $data['citas'] = $this->Cita_model->listarCitas(1);
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('Cita_view', $data);
        $this->load->view('inc/footer');
    }
    
    
    public function ver($idCita) {
        $data['cita'] = $this->Cita_model->recuperarCitaDetallada($idCita);
        $data['numero_correlativo'] = $this->Cita_model->obtenerNumeroCorrelativo($idCita);
        
        if (!$data['cita']) {
            show_404();
        }
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('verCita_view', $data);
        $this->load->view('inc/footer');
    }

    
    public function agregar() {
        $data['medicos'] = $this->Medico_model->listaMedicos(1);
        $data['pacientes'] = $this->Paciente_model->listaPacientes(1);
        $data['tipos_atencion'] = $this->Cita_model->obtenerTiposDeAtencion();
        $data['horarios_disponibles'] = $this->Cita_model->obtenerHorariosDisponibles();
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formAgregarCita_view', $data);
        $this->load->view('inc/footer');
    }

    


    public function agregarbd() {
        $this->form_validation->set_rules('idPaciente', 'Paciente', 'required');
        $this->form_validation->set_rules('idMedico', 'Médico', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('motivoConsulta', 'Motivo de consulta', 'required');
        $this->form_validation->set_rules('idTipoDeAtencion', 'Tipo de Atención', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            $this->agregar();
        } else {
            $datos_cita = array(
                'idPaciente' => $this->input->post('idPaciente'),
                'idMedico' => $this->input->post('idMedico'),
                'fecha' => $this->input->post('fecha') . ' ' . $this->input->post('hora'),
                'motivoConsulta' => $this->input->post('motivoConsulta'),
                'idTipoDeAtencion' => $this->input->post('idTipoDeAtencion'),
                'estado' => 'pendiente'
            );
    
            $resultado = $this->Cita_model->agendarCita($datos_cita);
    
            if ($resultado['success']) {
                $this->session->set_flashdata('mensaje', 'Cita agendada con éxito.');
                redirect('cita'); // Redirect to the citas list
            } else {
                $this->session->set_flashdata('error', $resultado['message']);
                $this->agregar();
            }
        }
    }

    public function cancelar($idCita) {
        $resultado = $this->Cita_model->cancelarCita($idCita);
        if ($resultado) {
            $this->session->set_flashdata('mensaje', 'Cita cancelada con éxito');
        } else {
            $this->session->set_flashdata('error', 'Error al cancelar la cita');
        }
        redirect('cita');
    }

    public function modificar($idCita = null) {
        if ($idCita === null) {
            $idCita = $this->input->post('idCita');
        }
        
        $data['infoCita'] = $this->Cita_model->recuperarCitaDetallada($idCita);
        
        if ($data['infoCita'] === null) {
            $this->session->set_flashdata('error', 'No se pudo encontrar la cita especificada.');
            redirect('cita');
        }
        
        $data['pacientes'] = $this->Paciente_model->listaPacientes(1)->result();
        $data['medicos'] = $this->Medico_model->listaMedicos(1)->result();
        $data['tipos_atencion'] = $this->Cita_model->obtenerTiposDeAtencion();
        
        $this->load->view('inc/head');
        $this->load->view('inc/header');
        $this->load->view('formModificarCita_view', $data);
        $this->load->view('inc/footer');
    }
    

    public function modificarbd() {
        $idCita = $this->input->post('idCita');
    
        $this->form_validation->set_rules('idPaciente', 'Paciente', 'required');
        $this->form_validation->set_rules('idMedico', 'Médico', 'required');
        $this->form_validation->set_rules('fecha', 'Fecha', 'required');
        $this->form_validation->set_rules('hora', 'Hora', 'required');
        $this->form_validation->set_rules('motivoConsulta', 'Motivo de consulta', 'required');
        $this->form_validation->set_rules('idTipoDeAtencion', 'Tipo de Atención', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Si la validación falla, volvemos al formulario de modificación
            $this->modificar($idCita);
        } else {
            $datos_cita = array(
                'idPaciente' => $this->input->post('idPaciente'),
                'idMedico' => $this->input->post('idMedico'),
                'fecha' => $this->input->post('fecha') . ' ' . $this->input->post('hora'),
                'motivoConsulta' => $this->input->post('motivoConsulta'),
                'idTipoDeAtencion' => $this->input->post('idTipoDeAtencion')
            );
    
            $resultado = $this->Cita_model->modificarCita($idCita, $datos_cita);
    
            if ($resultado) {
                $this->session->set_flashdata('mensaje', 'Cita modificada con éxito');
            } else {
                $this->session->set_flashdata('error', 'Error al modificar la cita');
            }
    
            redirect('cita');
        }
    }

    
    public function obtenerHorariosDisponibles() {
        $fecha = $this->input->post('fecha');
        $idMedico = $this->input->post('idMedico');
        $horarios = $this->Cita_model->obtenerHorariosDisponibles($fecha, $idMedico);
        echo json_encode($horarios);
    }



    public function generarPDF($idCita) {
        $this->load->library('pdf');
        $data['cita'] = $this->Cita_model->recuperarCitaDetallada($idCita);
        
        $html = $this->load->view('pdf/cita_detalle', $data, true);
        
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Tu Nombre');
        $pdf->SetTitle('Detalle de Cita');
        $pdf->SetSubject('Detalle de Cita');
        
        $pdf->AddPage();
        $pdf->writeHTML($html, true, false, true, false, '');
        $pdf->Output('cita_'.$idCita.'.pdf', 'I');
    }
}