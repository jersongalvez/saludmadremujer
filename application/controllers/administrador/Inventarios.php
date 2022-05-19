<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventarios extends Admin_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model("Generic_model");
		$this->load->model("Inventarios_model");
	}

    public function index() {
        $productos = $this->Inventarios_model->getProductos();
        $data = [
            "producto" => $productos
        ];
        $this->load->view("administrador/inventarios", $data);
    }

    public function movimientos() {
        $productos = $this->Inventarios_model->getProductos();
        $data = [
            "producto" => $productos
        ];
        $this->load->view("administrador/movimientos", $data);
    }

    public function productos() {
        $categorias = $this->Generic_model->getCategorias();
        $productos = $this->Inventarios_model->getProductos();
        $data = [
            "categoria" => $categorias,
            "producto" => $productos
        ];
        $this->load->view("administrador/productos", $data);
    }

    public function createProductos() {
        $categoria = $this->input->post("categoria");
        $codigo = $this->input->post("codigo");
        $codigo_barras = $this->input->post("codigo_barras");
        $nombre = $this->input->post("nombre");
        $medida = $this->input->post("medida");
        $cantidad = $this->input->post("cantidad");
        $precio = $this->input->post("precio");
        $moneda = $this->input->post("moneda");
        $descripcion = $this->input->post("descripcion");

        $datos = [
            "categoria" => $categoria,
            "codigo" => $codigo,
            "codigo_barras" => $codigo_barras,
            "nombre" => $nombre,
            "medida" => $medida,
            "cantidad" => $cantidad,
            "precio" => $precio,
            "moneda" => $moneda,
            "descripcion" => $descripcion,
        ];
        $this->Inventarios_model->createProductos($datos);
    }

    //KARDEX

    public function crearDocumentoKardexEntrada() {
        $cantidad = $this->input->post("cantidad");
        $total = $this->input->post("total");
        $producto = $this->input->post("producto");
        $seccion = $this->input->post("seccion");
        $motivo = $this->input->post("motivo");
        $comentarios = $this->input->post("comentarios");

        $data = [
            "cantidad" => $cantidad,
            "producto" => $producto,
            "seccion" => $seccion,
            "motivo" => $motivo,
            "comentarios" => $comentarios,
            "total" => $total
        ];
        $this->Inventarios_model->crearDocumentoKardexEntrada($data);
        $this->Inventarios_model->actualizarStock($total, $producto);
        
    }

    public function crearDocumentoKardexSalida() {
        $cantidad = $this->input->post("cantidad");
        $total = $this->input->post("total");
        $producto = $this->input->post("producto");
        $seccion = $this->input->post("seccion");
        $motivo = $this->input->post("motivo");
        $comentarios = $this->input->post("comentarios");

        $data = [
            "cantidad" => $cantidad,
            "producto" => $producto,
            "seccion" => $seccion,
            "motivo" => $motivo,
            "comentarios" => $comentarios,
            "total" => $total
        ];
        $this->Inventarios_model->crearDocumentoKardexSalida($data);
        $this->Inventarios_model->actualizarStock($total, $producto);
        
    }

    public function getStock($id){
        $stock = $this->Inventarios_model->getStock($id);

        echo json_encode($stock);
    }

    public function getConsultaInventario($stock) {
        $result = $this->Inventarios_model->getConsultaInventario($stock);
        echo json_encode($result->result());
    }

    public function consultarkardex() {
        $producto_kardex = $this->input->post("producto_kardex");
        $fecha_inicial = $this->input->post("fecha_inicial");
        $fecha_final = $this->input->post("fecha_final");
        $result = $this->Inventarios_model->consultarkardex($producto_kardex, $fecha_inicial, $fecha_final);

        echo json_encode($result->result());
    }

    public function generarPdfInventarios() {
        $stock = $this->input->post("stock");
        $this->load->library("pdf");
        $pdfAct = new Pdf();
        $inventarios = $this->Inventarios_model->getConsultaInventario($stock);
        $data = ["inventario" => $inventarios];
        $this->load->view("administrador/pdfinventarios", $data);
    }

    public function generarPdfKardex() {
        $producto = $this->input->post("producto_kardex");
        $fecha1 = $this->input->post("fecha_inicial");
        $fecha2 = $this->input->post("fecha_final");
        $this->load->library("pdf");
        $pdfAct = new Pdf();
        $productos = $this->Inventarios_model->getProductoId($producto);
        $kardexs = $this->Inventarios_model->consultarkardex($producto, $fecha1, $fecha2);
        $data = [
          "kardex" => $kardexs,
          "fecha1" => $fecha1,
          "fecha2" => $fecha2,
          "producto" => $productos
        ];
        $this->load->view("administrador/pdfkardex", $data);
    }
}