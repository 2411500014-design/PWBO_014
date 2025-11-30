<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    public function index() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('dashboard', $data);
        $this->load->view('template/footer');
    }
}