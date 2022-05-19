<?php

class Especialidades_model extends CI_model {

    public function getEspecialidades() {
        $this->db->select("*");
        $this->db->from("especialidades");
        $this->db->where("estado", "Disponible");
        $this->db->order_by("descripcion", "ASC");
        $result = $this->db->get();

        return $result;
    }

    public function searchEspecialidades($especialidad) {
        $this->db->select("costo, comision_aproximada");
        $this->db->from("especialidades");
        $this->db->where("codigo_especialidad", $especialidad);
        $especialidad = $this->db->get();
        return $especialidad->row();
    }

}