<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patologia extends Admin_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model("Patologia_model");
	}

    public function index()
    {
        
    }

    public function subirDocumentoPatologia() {
        $paciente = $this->input->post("paciente");
		$titulo = $this->input->post("titulo");
		$fecha = date("dmY");
		$dir_subida = 'public/patologia/';
        $fichero_subido = $dir_subida.basename($paciente."-".$fecha."-".$_FILES['icono']['name']);

		move_uploaded_file($_FILES['icono']['tmp_name'], $fichero_subido);

			$datos = array(
				"paciente" => $paciente,
				"titulo" => $titulo,
				"icono" => $paciente."-".$fecha."-".$_FILES['icono']['name']
			);
		
		$this->Patologia_model->subirDocumentoPatologia($datos);
		redirect(base_url("administracion/historia/".$paciente));
    }
}

?>