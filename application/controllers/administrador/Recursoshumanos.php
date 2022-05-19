<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recursoshumanos extends Admin_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("Usuarios_model");
	}
	
	public function index()
	{

		$administradores = $this->Usuarios_model->getAdministtradores();
		$atenciones = $this->Usuarios_model->getAtenciones();
		$enfermeras  = $this->Usuarios_model->getEnfermeras();
		$doctores = $this->Usuarios_model->getDoctor();
		$laboratoristas = $this->Usuarios_model->getLaboratorista();
		$patologos = $this->Usuarios_model->getPatologo();
		$data = [
			"administrador" => $administradores,
			"atencion" => $atenciones,
			"enfermera" => $enfermeras,
			"doctor" => $doctores,
			"laboratorista" => $laboratoristas,
			"patologo" => $patologos
		];
		$this->load->view('administrador/recursoshumanos', $data);
	}

	public function crearUsuarios() {
		$nombre = $this->input->post("nombre");
		$apellido = $this->input->post("apellido");
		$usuario = $this->input->post("usuario");
		$tp_usuario = $this->input->post("tp_usuario");
		$telefono = $this->input->post("telefono");
		$direccion = $this->input->post("direccion");
		$correo = $this->input->post("correo");
		$password = $this->input->post("password");
		
		$datos = [
			"nombre" => $nombre,
			"apellido" => $apellido,
			"tp_usuario" => $tp_usuario,
			"telefono" => $telefono,
			"direccion" => $direccion,
			"email" => $correo,
			"password" => $password,
			"usuario" => $usuario
		];
		$this->Usuarios_model->crearUsuarios($datos);																																																																																																		

	}

	public function getUsuariosId(){
		$id = $this->input->post("id");
		$result = $this->Usuarios_model->getUsuariosId($id);

		echo json_encode($result);
	}

	public function actualizarUsuario() {
		$id = $this->input->post("id");
		$tp_usuario = $this->input->post("tp_usuario");
		$telefono = $this->input->post("telefono");
		$correo  = $this->input->post("correo");
		$usuario = $this->input->post("usuario");

		$data = [
			"tp_usuario" => $tp_usuario,
			"telefono" => $telefono,
			"correo" => $correo,
			"usuario" => $usuario
		];
		$this->Usuarios_model->actualizarUsuario($data, $id);
	}

	public function eliminarUsuario() {
		$id = $this->uri->segment(3);
		$this->Usuarios_model->eliminarUsuario($id);
		redirect(base_url("administracion/recursoshumanos"));
	}
}
