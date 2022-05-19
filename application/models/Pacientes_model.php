<?php

class Pacientes_model extends CI_model {

    public function getPacientes() {
        $this->db->select("*");
        $this->db->from("pacientes");
        $this->db->where("estado", "Activo");
        $result = $this->db->get();

        return $result;
    }

    public function getPacienteId($documento) {
        $this->db->select("*");
        $this->db->from("pacientes");
        $this->db->where("documento", $documento);
        $result = $this->db->get();

        return $result;
    }

    public function CrearPaciente($data) {
        $password = rand(100000, 999999);
        $datos = [
            "hc" => $data["hc"],
            "nombre" => $data["nombre"],
            "apellido" => $data["apellido"],
            "documento" => $data["dni"],
            "direccion" => $data["direccion"],
            "telefono" => $data["celular"],
            "sexo" => $data["sexo"],
            "fecha_nacimiento" => $data["fecha_nacimiento"],
            "edad" => $data["edad"],
            "menor_edad" => $data["menor"],
            "familiar_documento" => $data["documento"],
            "familiar_nombre" => $data["responsable"],
            "ocupacion" => $data["ocupacion"],
            "grado_academico" => $data["grado_academico"],
            "estado_civil" => $data["estado_civil"],
            "departamento" => $data["departamento"],
            "provincia" => $data["provincia"],
            "distrito" => $data["distrito"],
            "creacion_fecha" => date("Y-m-d"),
            "creacion_hora" => date("h:i A"),
            "usuario" => $this->session->userdata("nombre"),
            "password" => $password,
            "estado" => "Activo"
        ];
        $this->db->insert("pacientes", $datos);
    }   

    public function CountPacientes() {
        $this->db->select("count(*) as numero");
        $this->db->from("pacientes");
        $result = $this->db->get();
        
        return $result->row();
    }

    public function actualizarPaciente($data, $id) {
        $datos = [
            "direccion" => $data["direccion"],
            "telefono" => $data["celular"],
            "familiar_documento" => $data["documento"],
            "familiar_nombre" => $data["responsable"],
            "ocupacion" => $data["ocupacion"],
            "sexo" => $data["sexo"],
            "edad" => $data["edad"],
            "fecha_nacimiento" => $data["fecha_nacimiento"],
            "grado_academico" => $data["grado_academico"],
            "estado_civil" => $data["estado_civil"],
            "departamento" => $data["departamento"],
            "provincia" => $data["provincia"],
            "distrito" => $data["distrito"],
        ];
        $this->db->where("codigo_paciente", $id);
        $this->db->update("pacientes", $datos);
    }

    public function eliminarPaciente($id) {
        $data = [
            "estado" => "Inactivo"
        ];
        $this->db->where("documento", $id);
        $this->db->update("pacientes", $data);
    }

      public function cargarPacientesPaginacion($params){
		$columns = $totalRecords = $data = array();
		$columns = array( 
			0 => 'documento',
			1 => 'hc', 
			2 => 'apellido',
			3 => 'nombre',
			4 => 'direccion',
			5 => 'telefono',
			6 => 'fecha_nacimiento',
            7 => 'sexo',
            8 => 'estado_civil'
		);

		$where = $sqlTot = $sqlRec = "";
		if( !empty($params['search']['value']) ) {   
			$where .=" AND (";
			$cont = 0;
			foreach ($columns as $key => $value){
				if($value != "acciones" && $value != "estado"){
					if($cont > 0){
						$where .=" OR ";
					}
					$where .=" ".$value." LIKE '%".$params['search']['value']."%' ";    
					$cont++;
				}
			}
			$where .=" )";
		}
		$sql = "SELECT * FROM pacientes WHERE estado = 'Activo'";
		$sqlTot .= $sql;
		$sqlRec .= $sql;

		if(isset($where) && $where != ''){
			$sqlTot .= $where;
			$sqlRec .= $where;
		}
	
		if($columns[$params['order'][0]['column']] != 'acciones'){
			$sqlRec .= " ORDER BY ". $columns[$params['order'][0]['column']]." ".$params['order'][0]['dir']." ";
		}

	 	$sqlRec .=  "  LIMIT ".$params['start']." ,".$params['length']." ";
	 	$queryTot = $this->db->query($sqlTot);

	 	$totalRecords = $queryTot->num_rows();

	 	$queryRecords = $this->db->query($sqlRec);

	 	return array("queryRecords" => $queryRecords, "totalRecords" => $totalRecords, "params" => $params);
	}


}
?>