<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Financiero extends Admin_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model("Financiero_model");
	}	
	public function index()
	{
		$pagos = $this->Financiero_model->getPagos();
		$data = ["pago" => $pagos];
		$this->load->view('administrador/financiero', $data);
	}

	public function crearGastos() {
        $nombre = $this->input->post("nombre");
        $cantidad = $this->input->post("cantidad");
        $descripcion = $this->input->post("descripcion");

        $data = [
            "nombre" => $nombre,
            "cantidad" => $cantidad,
            "descripcion" => $descripcion
        ];

        $this->Financiero_model->crearGastos($data);
    }
	//FACTURACION ELECTRONICA

	public function facturaElectronica() {
		$this->load->view("administrador/facturaelectronica");
	}
}