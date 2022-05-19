<?php

class Ecografias_model extends CI_model {

    //ECOGRAFIAS DE MAMA 
    public function createEcografiaMama($data) {
      $datos = [
        "documento_paciente" => $data["documento"],
        "doctor" => $data["doctor"],
        "pezon_izq" => $data["pezon_izq"],
        "tcsc_izq" => $data["tscs_izq"],
        "glandular_izq" => $data["glandular_izq"],
        "axila_izq" => $data["axila_izq"],
        "comentario_izq" => $data["comentario_izq"],
        "pezon_dere" => $data["pezon_dere"],
        "tcsc_dere" => $data["tscs_dere"],
        "glandular_dere" => $data["glandular_dere"],
        "axila_dere" => $data["axila_dere"],
        "comentario_dere" => $data["comentario_dere"],
        "conclusion" => $data["conclusion"],
        "sugerencias" => $data["sugerencias"],
        "fecha" => date("Y-m-d"),
        "usuario" => $this->session->userdata("nombre"),
      ];
      $this->db->insert("ecografia_mama", $datos);
    }

    
}