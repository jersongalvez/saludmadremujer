<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends Admin_Controller {

	public function __construct() {
		parent::__construct(); 
        $this->load->model("Usuarios_model");       
	}

    public function index() {
        $informaciones = $this->Usuarios_model->getUsuarioInformacion();
        $data = [
          "informacion" => $informaciones
        ];
        $this->load->view("administrador/perfil", $data);
    }
}
?>