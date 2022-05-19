<?php

class Precios_model extends CI_model {

    public function getPrecios() {
        $this->db->select("*");
        $this->db->from("especialidades");
        $result = $this->db->get();

        return $result;
    }

    public function crearPrecioServicio($data) {

        $datos  = [
            "descripcion" => $data["especialidad"],
            "costo" => $data["precio"],
            "comision_aproximada" => $data["comision"],
            "estado" => "Disponible",
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("especialidades", $datos);

    }

    public function getPreciosId($id) {
        $this->db->select("*");
        $this->db->from("especialidades");
        $this->db->where("codigo_especialidad", $id);
        $result = $this->db->get();

        return $result;
    }

    public function actualizarPrecios($data, $id) {
        $datos  = [
            "descripcion" => $data["especialidad"],
            "costo" => $data["precio"],
            "comision_aproximada" => $data["comision"],
            "estado" => $data["estado"]
        ];
        $this->db->where("codigo_especialidad", $id);
        $this->db->update("especialidades", $datos);
    }

}

?>