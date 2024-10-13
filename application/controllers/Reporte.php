<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Reporte_model');
        
        $this->load->library('pdf');
        
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

    public function listapdfPaciente()
	{
		
			$lista=$this->Paciente_model->listaPacientes();
			$lista=$lista->result();

			$this->pdf=new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Lista de Pacientes");
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE PACIENTES',0,0,'C',1);
			$this->pdf->Ln(10);

			$this->pdf->Cell(9,5,'No.','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'TELEFONO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'EMAIL','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'ALERGIAS','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'TIPO DE SANGRE','TBLR',0,'L',0);

			$this->pdf->Ln(5);

			$this->pdf->SetFont('Arial','',9);
			$num=1;
			foreach ($lista as $row) {
				$nombre=$row->nombre;
				$apellido=$row->apellido;
				$fechaNacimiento=$row->fechaNacimiento;
				$telefono=$row->telefono;
				$email=$row->email;
				$alergias=$row->alergias;
				$tipoSangre=$row->tipoSangre;


				$this->pdf->Cell(9,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$apellido,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$fechaNacimiento,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$telefono,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$email,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$alergias,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$tipoSangre,'TBLR',0,'L',0);

				$this->pdf->Ln(5);
				$num++;
			}

			$this->pdf->Output("listaPacientes.pdf","I");

		
	}

    public function listapdfMedico()
	{
		
			$lista=$this->Medico_model->listaMedicos();
			$lista=$lista->result();

			$this->pdf=new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Lista de Medicos");
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE MEDICOS',0,0,'C',1);
			$this->pdf->Ln(10);

			$this->pdf->Cell(9,5,'No.','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'TELEFONO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'EMAIL','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'ESPECIALIDAD','TBLR',0,'L',0);

			$this->pdf->Ln(5);

			$this->pdf->SetFont('Arial','',9);
			$num=1;
			foreach ($lista as $row) {
				$nombre=$row->nombre;
				$apellido=$row->apellido;
				$fechaNacimiento=$row->fechaNacimiento;
				$telefono=$row->telefono;
				$email=$row->email;
				$especialidad=$row->especialidad;


				$this->pdf->Cell(9,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$apellido,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$fechaNacimiento,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$telefono,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$email,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$especialidad,'TBLR',0,'L',0);

				$this->pdf->Ln(5);
				$num++;
			}

			$this->pdf->Output("listaMedicos.pdf","I");

		
	}

    public function listapdfUsuario()
	{
		
			$lista=$this->Administrador_model->listaUsuarios();
			$lista=$lista->result();

			$this->pdf=new Pdf();
			$this->pdf->AddPage();
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle("Lista de Usuarios");
			$this->pdf->SetLeftMargin(15);
			$this->pdf->SetRightMargin(15);
			$this->pdf->SetFillColor(210,210,210);
			$this->pdf->SetFont('Arial','B',11);
			$this->pdf->Cell(30);
			$this->pdf->Cell(120,10,'LISTA DE USUARIOS',0,0,'C',1);
			$this->pdf->Ln(10);

			$this->pdf->Cell(9,5,'No.','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'NOMBRE','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'APELLIDO','TBLR',0,'L',0);
			$this->pdf->Cell(50,5,'FECHA DE NACIMIENTO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'TELEFONO','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'EMAIL','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'EMAIL','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'ROL','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'DETALLES','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'FECHA CREACION','TBLR',0,'L',0);
			$this->pdf->Cell(15,5,'ULTIMA ACTUALIZACION','TBLR',0,'L',0);


			$this->pdf->Ln(5);

			$this->pdf->SetFont('Arial','',9);
			$num=1;
			foreach ($lista as $row) {
				$nombre=$row->nombre;
				$apellido=$row->apellido;
				$fechaNacimiento=$row->fechaNacimiento;
				$telefono=$row->telefono;
				$direccion=$row->direccion;
                $email=$row->email;
				$rol=$row->rol;



				$this->pdf->Cell(9,5,$num,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$nombre,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$apellido,'TBLR',0,'L',0);
				$this->pdf->Cell(50,5,$fechaNacimiento,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$telefono,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$direccion,'TBLR',0,'L',0);
                $this->pdf->Cell(15,5,$email,'TBLR',0,'L',0);
				$this->pdf->Cell(15,5,$rol,'TBLR',0,'L',0);

				$this->pdf->Ln(5);
				$num++;
			}

			$this->pdf->Output("listaUsuarios.pdf","I");

		
	}
}