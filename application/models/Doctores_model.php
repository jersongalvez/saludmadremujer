<?php

class Doctores_model extends CI_model {

    public function getDoctores() {
        $this->db->select("*");
        $this->db->from("doctores");
        $this->db->where("estado", "Activo");
        $result = $this->db->get();

        return $result;
    }

    public function getDoctoresId($id) {
        $this->db->select("*");
        $this->db->from("doctores");
        $this->db->where("codigo_doctor",$id);
        $result = $this->db->get();

        return $result->row();
    }

    public function crearDoctor($data) {
        $datos = [
            "cpe" => $data["cpe"],
            "nombre" => $data["nombre"],
            "email" => $data["correo"],
            "direccion" => $data["direccion"],
            "telefono" => $data["telefono"],
            "perfil" => $data["perfil"],
            "estado" => "Activo",
            "usuario" => $this->session->userdata("nombre")
        ];
        $this->db->insert("doctores", $datos);
    }

    public function eliminarDoctores($id){
        $data = [
            "estado" => "Inactivo"
        ];
        $this->db->where("codigo_doctor", $id);
        $this->db->update("doctores", $data);
    }

    public function actualizarDoctor($data) {
        $datos = [
           "cpe" => $data["documento"], 
           "nombre" => $data["nombre"], 
           "email" => $data["correo"], 
           "direccion" => $data["direccion"], 
           "telefono" => $data["telefono"], 
           "perfil" => $data["perfil"], 
           "lunes" => $data["lunes"], 
           "martes" => $data["martes"], 
           "miercoles" => $data["miercoles"], 
           "jueves" => $data["jueves"], 
           "viernes" => $data["viernes"], 
           "sabado" => $data["sabado"], 
           "domingo" => $data["domingo"],
           "desde" => $data["desde"],
           "hasta" => $data["hasta"],
        ];
        $this->db->where("cpe", $data["documento"]);
        $this->db->update("doctores", $datos);
    }
}