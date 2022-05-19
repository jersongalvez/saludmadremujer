<?php

class Inventarios_model extends CI_model {

    public function createProductos($data) {
      
      $datos = [
        "categoria" => $data["categoria"],
        "codigo" => $data["codigo"],
        "codigo_barras" => $data["codigo_barras"],
        "nombre" => $data["nombre"],
        "medida" => $data["medida"],
        "cantidad" => $data["cantidad"],
        "precio" => $data["precio"],
        "moneda" => $data["moneda"],
        "descripcion" => $data["descripcion"],
        "stock" => 0,
        "estado" => "ACTIVO",
        "fecha" => date("Y-m-d"),
        "hora" => date("h:i A"),
        "usuario" => $this->session->userdata("nombre") 
      ];
      $this->db->insert("productos", $datos);
    }

    public function getProductos() {
        $this->db->select("p.*, c.nombre as categorias");
        $this->db->from("productos p");
        $this->db->join("categorias c", "p.categoria = c.codigo_categoria");
        $result = $this->db->get();

        return $result;
    }

    public function getStock($id){
        $this->db->select("stock");
        $this->db->from("productos");
        $this->db->where("codigo_producto", $id);
        $result = $this->db->get();

        return $result->row();
    }

    public function crearDocumentoKardexEntrada($data){
        $datos = [
            "id_producto" => $data["producto"],
            "tp_documento" => "NE",
            "entrada" => $data["cantidad"] ,
            "salida" => 0,
            "devolucion" => 0,
            "fecha" => date("Y-m-d"),
            "hora" => date("h:i A"),
            "descripcion" => $data["comentarios"] ,
            "sede" => $data["seccion"],
            "motivo" => $data["motivo"],
            "usuario" => $this->session->userdata("nombre"),
            "saldo" => $data["total"]
        ];
        $this->db->insert("kardex", $datos);
    }

    public function crearDocumentoKardexSalida($data){
        $datos = [
            "id_producto" => $data["producto"],
            "tp_documento" => "FO",
            "entrada" =>  0,
            "salida" => $data["cantidad"],
            "devolucion" => 0,
            "fecha" => date("Y-m-d"),
            "hora" => date("h:i A"),
            "descripcion" => $data["comentarios"] ,
            "sede" => $data["seccion"],
            "motivo" => $data["motivo"],
            "usuario" => $this->session->userdata("nombre"),
            "saldo" => $data["total"]
        ];
        $this->db->insert("kardex", $datos);
    }

    public function actualizarStock($cantidad, $id) {
        $datos = [
            "stock" => $cantidad
        ];
        $this->db->where("codigo_producto", $id);
        $this->db->update("productos", $datos);
    }

    public function getConsultaInventario($stock) {
        if($stock == 0){
            $sql = "SELECT p.*, c.nombre as categorias FROM productos p INNER JOIN categorias c on p.categoria = c.codigo_categoria ORDER BY p.fecha ASC";
        }
        else if($stock == 1){
            $sql = "SELECT p.*, c.nombre as categorias FROM productos p INNER JOIN categorias c on p.categoria = c.codigo_categoria where p.stock < 0 ORDER BY p.fecha ASC";
        }
        else if($stock == 2){
            $sql = "SELECT p.*, c.nombre as categorias FROM productos p INNER JOIN categorias c on p.categoria = c.codigo_categoria where p.stock = 0 ORDER BY p.fecha ASC";
        }
        else if($stock == 3){
            $sql = "SELECT p.*, c.nombre as categorias FROM productos p INNER JOIN categorias c on p.categoria = c.codigo_categoria where p.stock > 0 ORDER BY p.fecha ASC";
        }
        $result = $this->db->query($sql);

        return $result;
    }

    public function consultarkardex($producto, $fech1, $fech2) {
        $sql = "SELECT * FROM kardex where id_producto = $producto and fecha >= '$fech1' and fecha <=  '$fech2' ORDER BY fecha ASC ";
        $result = $this->db->query($sql);

        return $result;
    }

    public function getProductoId($id) {
        $this->db->select("*");
        $this->db->from("productos");
        $this->db->where("codigo_producto", $id);
        $result = $this->db->get();

        return $result;
    }

    
}

?>