<?php

class Lineatiempo_model extends CI_model {

    public function getLineaClientes() {
        $this->db->select("L.*,d.nombre as doctor");
        $this->db->from("linea_tiempo L");
        $this->db->join("doctores d", "L.id__doctor = d.codigo_doctor");
        $this->db->where("L.dni_paciente", $this->session->userdata("documento"));
        $this->db->order_by("codigo_linea", "DESC");
        $result = $this->db->get();
        return $result;
    }

}
?>