<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    protected $requires_auth = FALSE;

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library(['form_validation','session']);
        $this->load->helper(['url','form']);
    }

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }

        $this->load->view('login/index');
    }

    public function auth() {
        $this->form_validation->set_rules('email','Email','required|valid_email');
        $this->form_validation->set_rules('password','Password','required');

        if ($this->form_validation->run() === FALSE) {
            $this->session->set_flashdata('error', validation_errors(' ', ' '));
            return redirect('login');
        }

        $email    = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        $user = $this->User_model->check_login($email, $password);

        if ($user) {
            $this->session->set_userdata([
                'logged_in' => TRUE,
                'Id_user'   => $user->Id_user,
                'name_user' => $user->name_user,
                'email'     => $user->email
            ]);

            return redirect('dashboard');
        }

        $this->session->set_flashdata('error','Email atau password tidak valid.');
        redirect('login');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}