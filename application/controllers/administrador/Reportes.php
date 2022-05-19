<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Doctores_model");
		$this->load->model("Reportes_model");
	}
	
	public function index()
	{
		$doctores = $this->Doctores_model->getDoctores();
		$data = ["doctor" => $doctores];	
		$this->load->view('administrador/reportes', $data);
	}

	public function reporteComisionDiario() {
		$doctor = $this->input->post("doctor");
		$fecha  = $this->input->post("fecha");
		$this->load->library("pdf");
        $pdfAct = new Pdf();
		$reportes1 = $this->Reportes_model->reporteComisionDiario($doctor, $fecha);
		$reportes2 = $this->Reportes_model->getTotalComisionDiario($doctor, $fecha);
		$data = [
			"reporte1" => $reportes1,
			"reporte2" => $reportes2
		];
		$this->load->view('administrador/pdfreportediario', $data);
	}

	public function  reporteGastos() {
		$fecha1 = $this->input->post("fecha1");
		$fecha2 = $this->input->post("fecha2");
		$this->load->library("pdf");
        $pdfAct = new Pdf();
		$gastos = $this->Reportes_model->reporteGastos($fecha1, $fecha2);
		$totales = $this->Reportes_model->getTotalGastos($fecha1, $fecha2);
		$data = ["gasto" => $gastos, "total" => $totales];
		$this->load->view('administrador/pdfreportegastos', $data);

	}

	public function reporteLaboratorio() {
		$usuario = $this->input->post("usuario");
	    $fecha = $this->input->post("fecha");
		$this->load->library("pdf");
        $pdfAct = new Pdf();
		$laboratorios = $this->Reportes_model->reporteLaboratorio($usuario, $fecha);
		$totales = $this->Reportes_model->totalLaboratorio($usuario, $fecha);
		$data = ["laboratorio" => $laboratorios, "total" => $totales];
		$this->load->view('administrador/pdfreportelaboratorio', $data);
	}
}
