<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citas extends Admin_Controller {

	public function __construct() {
		parent:: __construct();
		$this->load->model("Doctores_model");
		$this->load->model("Citas_model");
	}	
	public function index()
	{
		$doctores = $this->Doctores_model->getDoctores();
		//$__doctores__pro = $doctores;
		//$horarios_diarios = array();
		//array_push($horarios_mostrar,array("hora" =>$hor________min_1));
		//if ($__doctores__pro->num_rows() > 0)
        //{
		//	foreach ($__doctores__pro->result() as $row)
        //    {
		//		$row->Horas_lunes = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_lunes,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_martes = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_martes,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_miercoles = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_miercoles,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_jueves = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_jueves,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_viernes = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_viernes,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_sabado = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_sabado,$row->nombre,$row->codigo_doctor);
		//		$row->Horas_domingo = $this->Set_All_Horarios__ALL_BIG__($__doctores__pro,$row->Horas_domingo,$row->nombre,$row->codigo_doctor);
        //    }
        //}
		$citas = $this->Citas_model->getCitas();
		$data = [
			"doctor" 			=> $doctores,
			//"__doctores__pro" 	=> $__doctores__pro,
			"cita" 				=> $citas
		];
		$this->load->view('administrador/citas', $data);
	}
	public function Set_All_Horarios__ALL_BIG__($__doctores__pro,$horario__,$nombre,$codigo_doctor){
		if($horario__!=""){
			$__doctores__pro = array();//13;15:30-19:00;21-23
			$horas__ = explode(";", $horario__);//[13];[15:30-19:00];[21-23]
			array_splice($horas__,0,1);//[15:30-19:00];[21-23]

			for($i=0; $i < sizeof($horas__);$i++){
				$hor__as = explode("-", $horas__[$i]);//(15:30)-(19:00)

				$hor__min_1 = explode(":", $hor__as[0]);//([15]:[30])
				$hor__1 = ($hor__min_1[0]*1);	//[15]
				$min__1 = 0;//[0]
				if(sizeof($hor__min_1)>1){	
					$min__1 = ($hor__min_1[1]*1);//[30]
				}

				$hor__min_2 = explode(":", $hor__as[1]);//([19]:[00])
				$hor__2 = ($hor__min_2[0]*1);	//[19]
				$min__2 = 0;//[0]
				if(sizeof($hor__min_2)>1){	
					$min__2 = ($hor__min_2[1]*1);////[00]
				}

				$am_pm = "";
				if(!($hor__1*1>12)){//AM
					$am_pm = "am";
				}else{//PM
					$am_pm = "am";
				}
				$hor________min_1 = $this->ceros($hor__1*1,2).":".$this->ceros($min__1*1,2).":00";
				$hor________min_2 = $this->ceros($hor__2*1,2).":".$this->ceros($min__2*1,2).":00";

				$hor________min_1 = strtotime($hor________min_1);
				array_push($__doctores__pro,array("hora" =>$hor________min_1));

				$hor________min_1 = strtotime('.'.$duracion__.' minute',$hor________min_1);
				array_push($__doctores__pro,array("hora" =>$hor________min_1));

				$hor________min_2 = $this->ceros($hor__2*1,2).":".$this->ceros($min__2*1,2).":00";
				$hor________min_2 = strtotime($hor________min_2);
				for($iaxx=0; $iaxx < 50;$iaxx++){
					if($hor________min_1>=$hor________min_2){
						$iaxx = 50;
					}else{
						$hor________min_1 = strtotime('.'.$duracion__.' minute',$hor________min_1);
						array_push($horarios_mostrar,array("hora" =>$hor________min_1));
					}
				}
				$horarios_mostrar_new = array();
				for($iaa=0; $iaa < sizeof($horarios_mostrar);$iaa++){
					$horarios_mostrar_new[$iaa]['hora'] = date('H:i',$horarios_mostrar[$iaa]['hora']);
				}
			}
			//var_dump($horarios_mostrar);

			if ($CitasIdxFecha->num_rows() > 0)
			{
				foreach ($CitasIdxFecha->result() as $row)
				{
					$horarios_mostrar_new = $this->eliminar__($horarios_mostrar_new,$row->hora);
				}
			}
			if(sizeof($horarios_mostrar)>0){
				$data = [
					"horarios_mostrar" => $horarios_mostrar_new,
					"sms" => "Horarios Disponibles",
					"acction" => 1
				];
				echo json_encode($data);
			}else{
				$data = [
					"horarios_mostrar" => $horarios_mostrar_new,
					"sms" => "Dia No Disponible",
					"acction" => 2
				];
				echo json_encode($data);
			}
		}
		echo $horario__;
    } 

	public function crearCita() {
		$dni = $this->input->post("dni");
		$nombre = $this->input->post("nombre");
		$telefono = $this->input->post("telefono");
		$medico = $this->input->post("medico");
		$fecha = $this->input->post("fecha");
		$hora = $this->input->post("hora");
		$estado = $this->input->post("estado");
		$observaciones = $this->input->post("observaciones");

		$datos = [
			"dni" => $dni,
			"nombre" => $nombre,
			"telefono" => $telefono,
			"medico" => $medico,
			"fecha" => $fecha,
			"hora" => $hora,
			"estado" => $estado,
			"observaciones" => $observaciones
		];
		$this->Citas_model->crearCita($datos);
	}

	public function calendario () {
		$doctores = $this->Doctores_model->getDoctores();
		$data = ["doctor" => $doctores];
		$this->load->view("administrador/calendario", $data);
	}

	public function calendarioDoctor () {
		$this->load->view("administrador/calendariodoctor");
	}

	public function getdataCalendario() {
		$citas = $this->Citas_model->getdataCalendario();
		// $datos = array(
		// 	'id' => $citas->codigo_cita,
        //     'title' => $citas->apellido."".$citas->nombre." ( ".$citas->paciente." )"."  ".$citas->comentarios,
        //     'start' => $citas->fecha." ".$citas->hora,
        //     'end' => $citas->fecha." ".$citas->hora,
        //     "color" => "red",
        //     "display" => "auto",
		// 	"type"=> 1
		// );
		echo json_encode($citas);
	}

	public function getAllDataCalendario() {
		
		$allcitas = $this->Citas_model->getAllDataCalendario();
		
		echo json_encode($allcitas);
	}

	public function getDatosCitas() {
		$medico = $this->input->post("medico");
		$doctores = $this->Citas_model->getDatosCitas($medico);
		echo json_encode($doctores);
	}

	public function getHorariosDoc() {
		$fecha = $this->input->post("fecha");//var_dump($fecha);
		$medico = $this->input->post("medico");//var_dump($medico);
		$CitasIdxFecha = $this->Citas_model->getCitasIdxFecha($fecha,$medico);
		$HorariosDoc 		= $this->Citas_model->getHorariosDoc($medico);
		$horario__ = "";//Horario del dia para este Doctor
		$timestamp = strtotime($fecha);
		$day = date('N', $timestamp);
		//var_dump($day);
		//var_dump($CitasIdxFecha);
		if ($HorariosDoc->num_rows() > 0)
        {
			foreach ($HorariosDoc->result() as $row)
            {
				switch ($day){
					case 1: $horario__ = $row->Horas_lunes;break;
					case 2: $horario__ = $row->Horas_martes;break;
					case 3: $horario__ = $row->Horas_miercoles;break;
					case 4: $horario__ = $row->Horas_jueves;break;
					case 5: $horario__ = $row->Horas_viernes;break;
					case 6: $horario__ = $row->Horas_sabado;break;
					case 7: $horario__ = $row->Horas_domingo;break;
				}
            }
        }
		echo $this->Set_All_Horarios__($horario__,$CitasIdxFecha);
	}
	public function Set_All_Horarios__($horario__,$CitasIdxFecha){
		$horario__ 		= str_replace(" ", "", $horario__);
		if($horario__!=""){
			$horarios_mostrar = array();
			$horas__ = explode(";", $horario__);
			$duracion__ = $horas__[0];
			array_splice($horas__,0,1);
			for($i=0; $i < sizeof($horas__);$i++){
				$hor__as = explode("-", $horas__[$i]);
				if(sizeof($hor__as)>1){
					$hor__min_1 = explode(":", $hor__as[0]);
					$hor__min_2 = explode(":", $hor__as[1]);
					$hor__1 = ($hor__min_1[0]*1);	$min__1 = 0;
					if(sizeof($hor__min_1)>1){	$min__1 = ($hor__min_1[1]*1);}
					$hor__2 = ($hor__min_2[0]*1);	
					$min__2 = 0;

					if(sizeof($hor__min_2)>1){	$min__2 = ($hor__min_2[1]*1);}
					$hor________min_1 = $this->ceros($hor__1*1,2).":".$this->ceros($min__1*1,2).":00";
					$hor________min_1 = strtotime($hor________min_1);
					array_push($horarios_mostrar,array("hora" =>$hor________min_1));
					$hor________min_1 = strtotime('.'.$duracion__.' minute',$hor________min_1);
					array_push($horarios_mostrar,array("hora" =>$hor________min_1));
					$hor________min_2 = $this->ceros($hor__2*1,2).":".$this->ceros($min__2*1,2).":00";
					$hor________min_2 = strtotime($hor________min_2);
					for($iaxx=0; $iaxx < 50;$iaxx++){
						if($hor________min_1>=$hor________min_2){
							$iaxx = 50;
						}else{
							$hor________min_1 = strtotime('.'.$duracion__.' minute',$hor________min_1);
							array_push($horarios_mostrar,array("hora" =>$hor________min_1));
						}
					}
					$horarios_mostrar_new = array();
					for($iaa=0; $iaa < sizeof($horarios_mostrar);$iaa++){
						$horarios_mostrar_new[$iaa]['hora'] = date('H:i',$horarios_mostrar[$iaa]['hora']);
					}
				}
				
			}

			if ($CitasIdxFecha->num_rows() > 0){
				foreach ($CitasIdxFecha->result() as $row)
				{
					$horarios_mostrar_new = $this->eliminar__($horarios_mostrar_new,$row->hora);
				}
			}
			if(sizeof($horarios_mostrar)>0){
				$data = [
					"horarios_mostrar" => $horarios_mostrar_new,
					"sms" => "Horarios Disponibles",
					"acction" => 1
				];
				echo json_encode($data);
			}else{
				$data = [
					"horarios_mostrar" => $horarios_mostrar_new,
					"sms" => "Dia No Disponible",
					"acction" => 2
				];
				echo json_encode($data);
			}
		}else{
			$data = [
				"horarios_mostrar" => array(),
				"sms" => "Dia No Disponible",
				"acction" => 2
			];
			echo json_encode($data);
		}
    } 

    public function eliminar__($arrr,$hora__){
		for($iaa=0; $iaa < sizeof($arrr);$iaa++){
			if($arrr[$iaa]['hora'] == $hora__){
				array_splice($arrr,$iaa,1);
				$this->eliminar__($arrr,$hora__);
			}
		}
        return $arrr;
    } 

    public function ceros($valor, $longitud){
        $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
        return $res;
    } 

	public function getCitasId() {
		$id = $this->input->post("id");
		$result = $this->Citas_model->getCitasId($id);
		echo json_encode($result);
	}

	public function editarCitas() {
		$id = $this->input->post("idee");
		$dni = $this->input->post("dni");
		$nombre = $this->input->post("nombre");
		$telefono = $this->input->post("telefono");
		$medico = $this->input->post("medico");
		$fecha = $this->input->post("fecha");
		$hora = $this->input->post("hora");
		$estado  = $this->input->post("estado");
		$observaciones = $this->input->post("observaciones");
		$data = [
			"dni" => $dni,
			"nombre" => $nombre,
			"telefono" => $telefono,
			"medico" => $medico,
			"fecha" => $fecha,
			"hora" => $hora,
			"estado" => $estado,
			"observaciones" => $observaciones,
		];
		$this->Citas_model->editarCitas($data, $id);
	}

}