<?php

class Historias_model extends CI_model {

    public function getHistoriasId($paciente) {
        $this->db->select("h.*, p.nombre as pacientes,p.apellido, d.nombre as doctor");
        $this->db->from("historial_pacientes h");
        $this->db->join("pacientes p", "h.paciente = p.documento");
        $this->db->join("doctores d", "h.doctor = d.codigo_doctor");
        $this->db->where("h.paciente", $paciente);
        $result = $this->db->get();
        return $result;
    }

    public function getTriajeId($paciente) {
        $this->db->select("t.*, p.nombre as paciente,p.apellido,p.documento,d.nombre as medico,d.codigo_doctor,p.edad,p.sexo,e.descripcion, e.codigo_especialidad");
        $this->db->from("triajes t");
        $this->db->join("pacientes p", "t.paciente = p.documento");
        $this->db->join("doctores d", "t.doctor = d.codigo_doctor");
        $this->db->join("especialidades e", "t.especialidad = e.codigo_especialidad");
        $this->db->where("t.paciente", $paciente);
        $this->db->order_by("t.codigo_triaje", "desc");
        $result = $this->db->get();

        return $result->row();
    }

    public function getatencionid($paciente) {
        $this->db->select("especialidad");
        $this->db->from("atenciones");
        $this->db->where("paciente", $paciente);
        $result = $this->db->get();

        return $result;
    }
    // PARA MEDICINA GENERAL EL TIPO DE CONSULTA ES 1
    // PARA GINECOLOGIA  EL TIPO DE CONSULTA ES 2 
    public function crearHistorialPacientesGinecologicas($data, $id,$tipo) {
        $datos = [
            "tipo_consulta" => $tipo,
            "paciente" => $data["paciente"],
            "doctor" => $data["doctor"],
            "codigo_historia" => $id,
            "triaje" => $data["triaje"],
            "estado" => "Activo",
            "fecha" => date("d-m-Y"),
            "hora" => date("h:i A"),
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("historial_pacientes", $datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function crearHconsultasGinecologicas($data) {
        $datos = [
            "familiares" => $data["familiares"],
            "patologicos" => $data["patologicos"],
            "gineco_obstetrico" => $data["gine_obste"],
            "fum" => $data["fum"],
            "rm" => $data["rm"],
            "flujo_genital" => $data["flujo_genital"],
            "no_de_parejas" => $data["parejas"],
            "gestas" => $data["gestas"],
            "partos" => $data["partos"],
            "abortos" => $data["abortos"],
            "anticonceptivos" => $data["anticonceptivos"],
            "tipo" =>  $data["tipo"],
            "tiempo" => $data["tiempo"],
            "cirugia_ginecologica" => $data["cirugia_ginecologica"],
            "otros" =>  $data["otros"],
            "fecha_pap" => $data["pap"],
            "no_hijos" =>  $data["hijos"],
            "motivo_consulta" => $data["motivo_consulta"],
            "signossintomas" => $data["signos_sintomas"],
            "piel_tscs" => $data["piel_tscs"],
            "tiroides" =>  $data["tiroides"],
            "mamas" => $data["mamas"],
            "arespiratorio" => $data["a_respiratorio"],
            "acardiovascular" => $data["a_cardiovascular"],
            "abdomen" =>  $data["abdomen"],
            "genito_urinario" =>  $data["genito"],
            "tacto_rectal" => $data["tacto"],
            "locomotor" => $data["locomotor"],
            "sistema_nervioso" => $data["sistema_nervioso"],
            "examenes_auxiiliares" => $data["exa_auxiliares"],
            "plan_trabajo" => $data["plan_trabajo"],
            "proxima_cita" => $data["proxima_cita"],
            "firma_medico" =>  $data["firma_medico"],
            "estado" => "Activo",
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("h_ginecologias", $datos);
        $id = $this->db->insert_id();
        return $id;
    }

    public function crearHconsultasGeneral($data) {

        $datos = [
            "anamnesis" => $data["anamnesis"],
            "empresa" => $data["empresa"],
            "compania" => $data["compania"],
            "iafa" => $data["iafa"],
            "nombre_acompanante" => $data["acompanante"],
            "dni" => $data["documento"],
            "celular" =>  $data["celular"],
            "motivo_consulta" => $data["motivo_consulta"],
            "tratamiento_anterior" => $data["tratamiento_anterior"],
            "enfermedad_actual" => $data["enfermedad_actual"],
            "inicio" => $data["inicio"],
            "curso" => $data["curso"],
            "sintomas" => $data["sintomas"],
            "cabeza" => $data["cabeza"],
            "cuello" => $data["cuello"],
            "ap_respiratoria" => $data["ap_respiratorio"],
            "ap_cardio" => $data["ap_cardio"],
            "abdomen" => $data["abdomen"],
            "ap_genitourinario" => $data["ap_genito"],
            "loco_motor" => $data["locomotor"],
            "sistema_nervioso" => $data["sistema_nervioso"],
            "apetito" => $data["apetito"],
            "sed" => $data["sed"],
            "orina" => $data["orina"],
            "examen_dx" => $data["examendx"],
            "procedimientos" => $data["procedimientos"],
            "interconsultas" => $data["interconsultas"],
            "tratamiento" => $data["tratamiento"],
            "referencia" =>  $data["referencia"],
            "proxima_cita" =>  $data["cita"],
            "firma_medico" => $data["firma"],
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("h_consultas", $datos);
        $id = $this->db->insert_id();

        return $id;

    }

    public function crearRecetaMedica($data){
        $datos = [
            "paciente" => $data["paciente"],
            "fecha" => date("Y-m-d"),
            "medicina" => $data["medicina"],
            "receta" => $data["receta"],
            "autorizo" => $this->session->userdata("nombre")." ".$this->session->userdata("apellido")
        ];
        $this->db->insert("recetas_medicas", $datos);
    }

    public function getRecetas($paciente) {
        $this->db->select("*");
        $this->db->from("recetas_medicas");
        $this->db->where("paciente", $paciente);
        $result = $this->db->get();
        return $result;
    }

    public function subirDocumentos($data){
        $datos = [
            "paciente" => $data["paciente"],
            "titulo" => $data["titulo"],
            "url_documento" => $data["icono"],
            "tp_documento" => "hfisico",
            "fecha" => date("Y-m-d")
        ];
        $this->db->insert("documentos_pacientes", $datos);
    }

    public function getDocumentos($paciente, $tp_documento) {
        $this->db->select("*");
        $this->db->from("documentos_pacientes");
        $this->db->where("paciente", $paciente);
        $this->db->where("tp_documento", $tp_documento);
        $result = $this->db->get();

        return $result;
    }

    public function GenerarPdfGinecologia($id){
        $this->db->select("h.*, p.*,p.nombre as pacientes,d.*, g.*,t.*");
        $this->db->from("historial_pacientes h");
        $this->db->join("pacientes p", "h.paciente = p.documento");
        $this->db->join("doctores d", "h.doctor = d.codigo_doctor");
        $this->db->join("h_ginecologias g", "h.codigo_historia = g.codigo_h_ginecologia");
        $this->db->join("triajes t", "h.triaje = t.codigo_triaje");
        $this->db->where("h.codigo_historial_paciente", $id);
        $this->db->where("h.tipo_consulta", 2);
        $result = $this->db->get();

        return $result;

    }

    public function GenerarPdfMedicinaGeneral($id){
        $this->db->select("h.*, p.*,p.nombre as pacientes,d.*, c.*,t.*");
        $this->db->from("historial_pacientes h");
        $this->db->join("pacientes p", "h.paciente = p.documento");
        $this->db->join("doctores d", "h.doctor = d.codigo_doctor");
        $this->db->join("h_consultas c", "h.codigo_historia = c.codigo_h_consulta");
        $this->db->where("h.codigo_historial_paciente", $id);
        $this->db->join("triajes t", "h.triaje = t.codigo_triaje");
        $this->db->where("h.tipo_consulta", 1);
        $result = $this->db->get();

        return $result;
    }

    public function getDiagnosticos() {
        $this->db->select("*");
        $this->db->from("diagnosticoscie10");
        $result = $this->db->get();

        return $result;
    }

    public function crearDiagnosticos($data) {
        $datos = [
            "paciente" => $data["paciente"],
            "codigo_diagnosti" => $data["diagnosticos"],
            "tipo_especialidad" => 2,
            "historia" => $data["historia"],
            "fecha" =>  date("Y-m-d"),
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("diagnosticos", $datos);
    }

    public function crearDiagnosticosGeneral($data) {
        $datos = [
            "paciente" => $data["paciente"],
            "codigo_diagnosti" => $data["diagnosticos"],
            "tipo_especialidad" => 1,
            "historia" => $data["historia"],
            "fecha" =>  date("Y-m-d"),
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("diagnosticos", $datos);
    }

    // SET collation_connection = 'utf8mb4_general_ci';
    // ALTER DATABASE your_bd CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
    // ALTER TABLE your_table CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

    public function getDiagnosticosGinecologia($historia, $fecha){
        $fechan = date("Y-m-d", strtotime($fecha));
		$this->db->select("d.*, c.descripcion, c.clave");
		$this->db->from("diagnosticos d");
		$this->db->join("diagnosticoscie10 c", "d.codigo_diagnosti = c.id");
		$this->db->where("d.historia", $historia);
		$this->db->where("d.tipo_especialidad", 2);
		$this->db->where("d.fecha", $fechan);
		$result = $this->db->get();

		return $result;
	}

    public function getDiagnosticosGeneral($historia, $fecha){
        $fechan = date("Y-m-d", strtotime($fecha));
		$this->db->select("d.*, c.descripcion, c.clave");
		$this->db->from("diagnosticos d");
		$this->db->join("diagnosticoscie10 c", "d.codigo_diagnosti = c.id");
		$this->db->where("d.historia", $historia);
		$this->db->where("d.tipo_especialidad", 1);
		$this->db->where("d.fecha", $fechan);
		$result = $this->db->get();

		return $result;
	}
    
}

?>