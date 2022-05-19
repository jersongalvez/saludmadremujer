<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Triaje extends Admin_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model("Atencion_model");
		$this->load->model("Doctores_model");
		$this->load->model("Especialidades_model");
		$this->load->model("Atencion_model");
		$this->load->model("Triaje_model");
	}
	
	public function index()
	{
		$atenciones = $this->Triaje_model->getTriaje();
		$doctores = $this->Doctores_model->getDoctores();
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$data = ["doctor" => $doctores, "especialidad" => $especialidades, "atencion" => $atenciones];
		$this->load->view('administrador/triaje', $data);
	}

	public function getTriajeId() {
		$dni = $this->input->post("id");
		$result = $this->Triaje_model->getTriajeId($dni);

		echo json_encode($result);
	}

	public function crearTriaje() {
		$dni = $this->input->post("dni");
		$doctor = $this->input->post("doctor");
		$especialidad = $this->input->post("especialidad");		
		$presion = $this->input->post("presion");
		$temperatura = $this->input->post("temperatura");
		$respiratoria = $this->input->post("respiratoria");
		$cardiaca = $this->input->post("cardiaca");
		$saturacion = $this->input->post("saturacion");
		$peso = $this->input->post("peso");
		$talla = $this->input->post("talla");
		$lmc = $this->input->post("lmc");
		
		$data = [
			"dni" => $dni,
			"doctor" => $doctor,
			"especialidad" => $especialidad,
			"presion" => $presion,
			"temperatura" => $temperatura,
			"respiratoria" => $respiratoria,
			"cardiaca" => $cardiaca,
			"saturacion" => $saturacion,
			"peso" => $peso,
			"talla" => $talla,
			"lmc" => $lmc
		];
		$this->Triaje_model->crearTriaje($data);
	}

	public function mandaraConsulta() {
		$id = $this->uri->segment(3);
		$this->Atencion_model->mandaraConsulta($id);
		redirect(base_url("administracion/triaje"));
	}
}
