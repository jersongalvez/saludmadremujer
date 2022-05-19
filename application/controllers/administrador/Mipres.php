<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mipres extends Admin_Controller {

    public function index() {
        $this->load->view("administrador/prescripciones");
    }
}