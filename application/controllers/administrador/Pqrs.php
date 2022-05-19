<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pqrs extends Admin_Controller {

    public function index() {
        $this->load->view("administrador/pqrs");
    }

}
?>