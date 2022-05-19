<?php

class Citas_model extends CI_model {

    public function crearCita($data) {
        $datos = [
            "paciente" => $data["dni"],
            "doctor" => $data["medico"],
            "fecha" => $data["fecha"],
            "fechafin" => $data["fecha"],
            "hora" => $data["hora"],
            "comentarios" => $data["observaciones"],
            "estado" => $data["estado"],
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("citas", $datos);
    }

    public function getDatosCitas($id) {
        $this->db->select("*");
        $this->db->from("doctores");
        $this->db->where("codigo_doctor", $id);
        $result = $this->db->get();

        return $result->row();
    }

    public function getCitas() {
        $this->db->select("c.*,p.documento,p.nombre,p.apellido,p.telefono,d.nombre as doctor");
        $this->db->from("citas c");
        $this->db->join("pacientes p", "c.paciente = p.documento");
        $this->db->join("doctores d", "c.doctor = d.codigo_doctor");
        $this->db->order_by("c.fecha ", "DESC");
        // $this->db->group_by("p.documento");
        $result = $this->db->get();

        return $result;
    }

    public function getdataCalendario() {
        $this->db->select("CONCAT(p.apellido,' ',p.nombre, ' ( ',c.paciente,' )  DESCRIPCION => ',c.comentarios) as title,CONCAT(c.fecha,' ',c.hora) as start, CONCAT(c.fecha,' ',c.hora) as end,c.*");
        $this->db->from("citas c");
        $this->db->join("pacientes p", "c.paciente = p.documento");
        $this->db->where("c.doctor", $this->session->userdata("codigo"));
        $this->db->where("c.estado", "Confirmado");
        $this->db->group_by('c.codigo_cita');
        return   $this->db->get()->result();  
    }

    public function getAllDataCalendario() {
        $this->db->select("CONCAT(p.apellido,' ',p.nombre, ' ( ',c.paciente,' )  DESCRIPCION => ',c.comentarios, ' <= DOCTOR => ',  d.nombre) as title,CONCAT(c.fecha,' ',c.hora) as start, CONCAT(c.fecha,' ',c.hora) as end,c.*,d.color");
        $this->db->from("citas c");
        $this->db->join("pacientes p", "c.paciente = p.documento");
        $this->db->join("doctores d", "c.doctor = d.codigo_doctor");
        // $this->db->where("c.doctor", $medico);
        $this->db->group_by('c.codigo_cita');
        return   $this->db->get()->result();  
    }

    public function getCitasId($id) {
        $this->db->select("c.*, p.nombre, p.apellido,p.documento");
        $this->db->from("citas c");
        $this->db->join("pacientes p", "c.paciente = p.documento");
        $this->db->where("c.codigo_cita", $id);
        $result = $this->db->get();

        return $result->row();
    }

    public function editarCitas($data, $id) {
		$datos = [
            "doctor" => $data["medico"],
            "fecha" => $data["fecha"],
            "fechafin" => $data["fecha"],
            "hora" => $data["hora"],
            "estado" => $data["estado"],
            "comentarios" => $data["observaciones"]
        ];
        $this->db->where("codigo_cita", $id);
        $this->db->update("citas", $datos);
	}

}