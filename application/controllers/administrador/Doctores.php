<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Doctores extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Doctores_model");
	}
	
	public function index()
	{
		$doctores = $this->Doctores_model->getDoctores();
		$data = ["doctor" => $doctores];
		$this->load->view('administrador/doctores', $data);
	}

	public function crearDoctor() {
        $cpe = $this->input->post("cpe");
        $nombre = $this->input->post("nombre");
        $perfil = $this->input->post("perfil");
        $telefono = $this->input->post("telefono");
        $direccion = $this->input->post("direccion");
        $correo = $this->input->post("correo");
        $password = $this->input->post("password");

		$data = [
			"cpe" => $cpe,
			"nombre" => $nombre,
			"perfil" => $perfil,
			"telefono" => $telefono,
			"direccion" => $direccion,
			"correo" => $correo,
			"password" => $password
		];
		$this->Doctores_model->crearDoctor($data);
    }

	public function getDoctoresId()
	{
		$doctor = $this->input->post("id");
		$result = $this->Doctores_model->getDoctoresId($doctor);

		echo json_encode($result);
	}

	public function eliminarDoctores() {
		$id = $this->uri->segment(3);
		$this->Doctores_model->eliminarDoctores($id);
		redirect("administracion/doctores");
	}

	public function actualizarDoctor() {
        $lunes = $this->input->post("lunes");
        $martes = $this->input->post("martes");
        $miercoles = $this->input->post("miercoles");
        $jueves = $this->input->post("jueves");
        $viernes = $this->input->post("viernes");
        $sabado = $this->input->post("sabado");
        $domingo = $this->input->post("domingo");
		$desde = $this->input->post("desde");
		$hasta = $this->input->post("hasta");
        $documento = $this->input->post("documento");
        $nombre = $this->input->post("nombre");
        $perfil = $this->input->post("perfil");
        $telefono = $this->input->post("telefono");
        $direccion = $this->input->post("direccion");
        $correo = $this->input->post("correo");

		$datos = [
			"lunes" => $lunes,
			"martes" => $martes,
			"miercoles" => $miercoles,
			"jueves" => $jueves,
			"viernes" => $viernes,
			"sabado" => $sabado,
			"domingo" => $domingo,
			"desde" => $desde,
			"hasta" => $hasta,
			"documento" => $documento,
			"nombre" => $nombre,
			"perfil" => $perfil,
			"telefono" => $telefono,
			"direccion" => $direccion,
			"correo" => $correo,
		];
		$this->Doctores_model->actualizarDoctor($datos);
    }
}
