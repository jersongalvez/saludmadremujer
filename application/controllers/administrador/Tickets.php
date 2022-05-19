<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tickets extends Admin_Controller {

    public function index() {
        $this->load->view("administrador/tickets");
    }

}

?>