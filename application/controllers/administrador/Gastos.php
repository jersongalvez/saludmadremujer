<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gastos extends Admin_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model("Gastos_model");
		$this->load->model("Usuarios_model");
	}	
	public function index()
	{
		$gastos = $this->Gastos_model->getGastos();
		$users = $this->Usuarios_model->getAllUsers();
		$data = [
            "gastos" => $gastos,
            "users" => $users
        ];
		$this->load->view('administrador/gastos', $data);
	}

	public function FormGastoCPE() {
		$idgastos = $this->input->post("idgastos");
		$statee = $this->input->post("statee");//var_dump($statee);
		$cpe_tipo = $this->input->post("cpe_tipo");
		$cpe_serie = $this->input->post("cpe_serie");
		$cpe_numero = $this->input->post("cpe_numero");
		$cpe_gravada = $this->input->post("cpe_gravada");
		$cpe_igv = $this->input->post("cpe_igv");
		$cpe_total = $this->input->post("cpe_total");
		$f_emision = $this->input->post("f_emision");
		$f_recepcion = $this->input->post("f_recepcion");
		$descripcion = $this->input->post("descripcion");
		$prov_tipo_doc = $this->input->post("prov_tipo_doc");
		$prov_nro_doc = $this->input->post("prov_nro_doc");
		$prov_razon_social = $this->input->post("prov_razon_social");

		if($this->Gastos_model->val_CPE($cpe_tipo,$cpe_serie,$cpe_numero,$prov_nro_doc,$idgastos,$statee)){
			$data = [
				"sms" => "Este comprobante ya se encuentra registrado",
				"acction" => 2
			];
			echo json_encode($data);
		}else{
			$data = [
				"idgastos" => $idgastos,
				"cpe_tipo" => $cpe_tipo,
				"statee" => $statee,
				"cpe_serie" => $cpe_serie,
				"cpe_numero" => $cpe_numero,
				"cpe_gravada" => $cpe_gravada,
				"cpe_igv" => $cpe_igv,
				"cpe_total" => $cpe_total,
				"f_emision" => $f_emision,
				"f_recepcion" => $f_recepcion,
				"descripcion" => $descripcion,
				"prov_tipo_doc" => $prov_tipo_doc,
				"prov_nro_doc" => $prov_nro_doc,
				"prov_razon_social" => $prov_razon_social,
				"codigo_usuario" => $this->session->userdata("codigo")
			];
			$this->Gastos_model->FormGastoCPE($data);
			if($statee=='Registrar'){
				$data = [
					"sms" => "Registrado Correctamente",
					"acction" => 1
				];
			}else{
				$data = [
					"sms" => "Actualizo Correctamente",
					"acction" => 1
				];
			}
			echo json_encode($data);
		}
    }

	public function LoadCpeGasto() {
		$ideee = $this->input->post("ideee");
		$result = $this->Gastos_model->LoadCpeGasto($ideee);
		if ($result->num_rows() > 0){
			$data = [
				"gastos" => ($result->row()),
				"sms" => "Listo"
			];
			echo json_encode($data);
		}
		else {
			echo "error";
		}
	}

	public function searchProveedor() {
		$ruc = $this->input->post("ruc");
		$result = $this->Gastos_model->searchProveedor($ruc);
		if($result){
			echo json_encode($result);
		}
		else {
			echo "error";
		}
	}
	public function facturaElectronica() {
		$this->load->view("administrador/facturaelectronica");
	}
}