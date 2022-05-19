<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends Admin_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model("Generic_model");
	}
	public function index()
	{

		$medicos = $this->Generic_model->countMedicos();
		$pacientes = $this->Generic_model->countPacientes();
		$citas = $this->Generic_model->countCitas();
		$historias = $this->Generic_model->countHistorias();
		$pagos = $this->Generic_model->countPagos();
		$nuevosPacientes = $this->Generic_model->getPacientesNuevos();
		$data = [
		  "pacientesn" => $nuevosPacientes, 
		  "medico" => $medicos,
		  "paciente" => $pacientes,
		  "cita" => $citas,
		  "historia" => $historias,
		  "pago" => $pagos
		];
		$this->load->view('administrador/inicio', $data);
	}
}
