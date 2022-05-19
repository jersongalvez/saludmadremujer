<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Precios extends Admin_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model("Precios_model");
	}
	
	public function index()
	{
		$precios = $this->Precios_model->getPrecios();
		$data = ["precio" => $precios];
		$this->load->view('administrador/precios', $data);
	}

	public function crearPrecioServicio() {
		$especialidad = $this->input->post("especialidad");
		$precio = $this->input->post("precio");
		$comision = $this->input->post("comision");

		$data = [
			"especialidad" => $especialidad,
			"precio" => $precio,
			"comision" => $comision
		];
		$this->Precios_model->crearPrecioServicio($data);
	}

	public function getPreciosId() {
		$id = $this->input->post("id");
		$result = $this->Precios_model->getPreciosId($id);

		$resultado = $result->result()[0];
		echo json_encode($resultado);
	}

	public function actualizarPrecios() {
		$id = $this->input->post("id");
		$especialidad = $this->input->post("especialidad");
		$precio = $this->input->post("precio");
		$comision = $this->input->post("comision");
		$estado = $this->input->post("estado");

		$data = [
			"especialidad" => $especialidad,
			"precio" => $precio,
			"comision" => $comision,
			"estado" => $estado
		];
		$this->Precios_model->actualizarPrecios($data, $id);
	}
}
