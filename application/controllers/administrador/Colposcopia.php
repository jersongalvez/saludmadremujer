<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colposcopia extends Admin_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model("Colposcopia_model");
        
	}

    public function index() {
        $colposcopias = $this->Colposcopia_model->getColposcopia();
        
        $data = ["colposcopia" => $colposcopias];
        $this->load->view("administrador/colposcopia", $data);
    }

    public function crearColposcopia() {
        $dni = $this->input->post("dni");
        $nombre = $this->input->post("nombre");
        $medico = $this->input->post("medico");
        $fecha = $this->input->post("fecha");
        $escamo_columnar = $this->input->post("escamo_columnar");
        $endocervix = $this->input->post("endocervix");
        $vagina = $this->input->post("vagina");
        $vulva = $this->input->post("vulva");
        $perineo = $this->input->post("perineo");
        $region_parianal = $this->input->post("region_parianal");
        $biopsia = $this->input->post("biopsia");
        $papanicolaou = $this->input->post("papanicolaou");
        $conclusiones = $this->input->post("conclusiones");

        $data = [
            "dni" => $dni,
            "nombre" => $nombre,
            "medico" => $medico,
            "fecha" => $fecha,
            "escamo_columnar" => $escamo_columnar,
            "endocervix" => $endocervix,
            "vagina" => $vagina,
            "vulva" => $vulva,
            "perineo" => $perineo,
            "region_parianal" => $region_parianal,
            "biopsia" => $biopsia,
            "papanicolaou" => $papanicolaou,
            "conclusiones" => $conclusiones
        ];
        $id = $this->Colposcopia_model->crearColposcopia($data);
     
        $dir_subida = 'public/colposcopia/';
        $fichero_subido = $dir_subida.basename($_FILES['imagen1']['name']);
		move_uploaded_file($_FILES['imagen1']['tmp_name'], $fichero_subido);
			$datos = array
            (
				"id" => $id,
				"icono" => $_FILES['imagen1']['name']
			);

            $dir_subida = 'public/colposcopia/';
            $fichero_subido = $dir_subida.basename($_FILES['imagen2']['name']);
            move_uploaded_file($_FILES['imagen2']['tmp_name'], $fichero_subido);
                $datos2 = array
                (
                    "id" => $id,
                    "icono" => $_FILES['imagen2']['name']
                );
        $this->Colposcopia_model->updateImagen1($datos);
        $this->Colposcopia_model->updateImagen2($datos2);
        redirect(base_url("administracion/colposcopia"));

    }

    public function crearpdfcolposcopia() {
        $id = $this->uri->segment(3);
        $this->load->library("pdf");
        $pdfAct = new Pdf();
        $colposcopias = $this->Colposcopia_model->crearpdfcolposcopia($id);
        $cpes = $this->Colposcopia_model->getCpeDoctor();
        $data = [
            "colposcopia" => $colposcopias,
            "cpe" => $cpes
        ];
        $this->load->view("administrador/pdfcolposcopia", $data);
    }
}

?>