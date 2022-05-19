<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atencion extends Admin_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->model("Atencion_model");
		$this->load->model("Doctores_model");
		$this->load->model("Especialidades_model");
		$this->load->model("Atencion_model");
		$this->load->model("Pagos_model");
	}
	
	public function index()
	{
		$atenciones = $this->Atencion_model->getAtenciones();
		$doctores = $this->Doctores_model->getDoctores();
		$especialidades = $this->Especialidades_model->getEspecialidades();
		$data = ["doctor" => $doctores, "especialidad" => $especialidades, "atencion" => $atenciones];
		$this->load->view('administrador/atencion', $data);
	}

	public function atencionMedicos() {
		$pacientes = $this->Atencion_model->getAtencionesDoctor();
		$data = [
			"paciente" => $pacientes 
		];
		$this->load->view('administrador/doctoresatencion', $data);
	}

	public function searchAtencion() {
		$dni = $this->input->post("dni");
		$result = $this->Atencion_model->searchAtencion($dni);

		if($result){
			echo json_encode($result);
		}
		else {
			echo "error";
		}
	}

	public function searchEspecialidad() {
		$especialidad = $this->input->post("especialidad");
		$result = $this->Especialidades_model->searchEspecialidades($especialidad);
		echo json_encode($result);
	}

	public function registrarAtencion() {
		$dni = $this->input->post("dni");
		$nombre = $this->input->post("nombre");
		$especialidad = $this->input->post("especialidad");
		$doctor = $this->input->post("doctor");
		$costo = $this->input->post("costo");
		$comision = $this->input->post("comision");
		$turno = $this->input->post("turno");

		//FACTURA
		$descuento = $this->input->post("descuento");
		$total = $this->input->post("total");
		$total_recibida= $this->input->post("cantidad_recibida");
		$tipo_deposito = $this->input->post("forma_pago");

		$factura = [
			"dni" => $dni,
			"doctor" => $doctor,
			"descuento" => $descuento,
			"especialidad" => $especialidad,
			"comision" => $comision,
			"total" => $total,
			"total_recibida" => $total_recibida,
			"tipo_deposito" => $tipo_deposito,
		];
		$data = [
			"dni" => $dni,
			"nombre" => $nombre,
			"especialidad" => $especialidad,
			"doctor" => $doctor,
			"costo" => $costo,
			"comision" => $comision,
		];
		 $this->Atencion_model->registrarAtencion($data);
		 $this->Pagos_model->CrearPagos($factura);
		 $this->Atencion_model->CrearLineaTiempoAtencion($dni, $especialidad,$doctor);

	}

	public function countTurnos() {
		$result = $this->Atencion_model->CountTurnos();
		$data = [
			"numero" => $result
		];
		echo  json_encode($data);
	}

	public function mandarTriaje() {
		$id = $this->uri->segment(3);
		$this->Atencion_model->mandarTriaje($id);

		redirect(base_url("administracion/atencion"));
	}

	public function cargarFacturaAtencion() 
	{
		$id = $this->uri->segment(3);
		$atenciones = $this->Atencion_model->cargarFacturaAtencion($id);
		$this->load->library("pdf");
        $pdfAct = new Pdf();
		$data = [
			"atencion" => $atenciones 
		];
		$this->load->view("administrador/facturapos", $data);
	}

	public function mandarAtendido() {
		$codigo = $this->uri->segment(3);
		$this->Atencion_model->mandarAtendido($codigo);
		redirect(base_url("administracion/atencionmedicos"));
	}
}
