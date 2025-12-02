<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu_controller extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Ortu_model');
    }

    public function index() {
        $data['list_ortu'] = $this->Ortu_model->get_all();     
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/index', $data);
        $this->load->view('template/footer');
    }
}