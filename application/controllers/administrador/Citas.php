<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends Admin_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model("Doctores_model");
		$this->load->model("Citas_model");
	}	
	public function index()
	{
		$doctores = $this->Doctores_model->getDoctores();
		$citas = $this->Citas_model->getCitas();
		$data = ["doctor" => $doctores, "cita" => $citas];
		$this->load->view('administrador/citas', $data);
	}

	public function crearCita() {
		$dni = $this->input->post("dni");
		$medico = $this->input->post("medico");
		$fecha = $this->input->post("fecha");
		$hora = $this->input->post("hora");
		$estado = $this->input->post("estado");
		$observaciones = $this->input->post("observaciones");

		$datos = [
			"dni" => $dni,
			"medico" => $medico,
			"fecha" => $fecha,
			"hora" => $hora,
			"estado" => $estado,
			"observaciones" => $observaciones
		];
		$this->Citas_model->crearCita($datos);
	}

	public function calendario () {
		$doctores = $this->Doctores_model->getDoctores();
		$data = ["doctor" => $doctores];
		$this->load->view("administrador/calendario", $data);
	}

	public function calendarioDoctor () {
		$this->load->view("administrador/calendariodoctor");
	}

	public function getdataCalendario() {
		$citas = $this->Citas_model->getdataCalendario();
		// $datos = array(
		// 	'id' => $citas->codigo_cita,
        //     'title' => $citas->apellido."".$citas->nombre." ( ".$citas->paciente." )"."  ".$citas->comentarios,
        //     'start' => $citas->fecha." ".$citas->hora,
        //     'end' => $citas->fecha." ".$citas->hora,
        //     "color" => "red",
        //     "display" => "auto",
		// 	"type"=> 1
		// );
		echo json_encode($citas);
	}

	public function getAllDataCalendario() {
		
		$allcitas = $this->Citas_model->getAllDataCalendario();
		
		echo json_encode($allcitas);
	}

	public function getDatosCitas() {
		$medico = $this->input->post("medico");

		$doctores = $this->Citas_model->getDatosCitas($medico);
		echo json_encode($doctores);
	}

	public function getCitasId() {
		$id = $this->input->post("id");
		$result = $this->Citas_model->getCitasId($id);

		echo json_encode($result);
	}

	public function editarCitas() {
		$id = $this->input->post("id");
		$medico = $this->input->post("medico");
		$fecha = $this->input->post("fecha");
		$hora = $this->input->post("hora");
		$estado  = $this->input->post("estado");
		$observaciones = $this->input->post("observaciones");
		$data = [
			"medico" => $medico,
			"fecha" => $fecha,
			"hora" => $hora,
			"estado" => $estado,
			"observaciones" => $observaciones,
		];
		$this->Citas_model->editarCitas($data, $id);
	}

}