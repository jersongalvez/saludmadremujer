<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ecografias extends Admin_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model("Ecografias_model");
	}

    //ECOGRAFIA DE MAMA
    public function ecografiaMama() {
        $this->load->library("pdf");
        $pdfAct = new Pdf();
        $this->load->view("administrador/ecografias/ecografia_transvaginal");
    }

    public function createEcografiaMama() {
        $documento = $this->input->post("documento");
        $doctor = $this->input->post("doctor");
        $pezon_izq = $this->input->post("pezon_izq");
        $tscs_izq = $this->input->post("tscs_izq");
        $glandular_izq = $this->input->post("glandular_izq");
        $axila_izq = $this->input->post("axila_izq");
        $comentario_izq = $this->input->post("comentario_izq");
        $pezon_dere = $this->input->post("pezon_dere");
        $tscs_dere = $this->input->post("tscs_dere");
        $glandular_dere = $this->input->post("glandular_dere");
        $axila_dere = $this->input->post("axila_dere");
        $comentario_dere = $this->input->post("comentario_dere");
        $conclusion = $this->input->post("conclusion");
        $sugerencias = $this->input->post("sugerencias");

        $datos = [
            "documento" => $documento,
            "doctor" => $doctor,
            "pezon_izq" => $pezon_izq,
            "tscs_izq" => $tscs_izq,
            "glandular_izq" => $glandular_izq,
            "axila_izq" => $axila_izq,
            "comentario_izq" => $comentario_izq,
            "pezon_dere" => $pezon_dere,
            "tscs_dere" => $tscs_dere,
            "glandular_dere" => $glandular_dere,
            "axila_dere" => $axila_dere,
            "comentario_dere" => $comentario_dere,
            "conclusion" => $conclusion,
            "sugerencias" => $sugerencias,
        ];
    }


    //ECOGRAFIA TRANSVAGINAL
}