<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ortu_model');
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Data Ortu';
        $data['ortu'] = $this->Ortu_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Tambah Data Ortu';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/tambah', $data);
        $this->load->view('template/footer');
    }

    public function store() {
        $this->form_validation->set_rules('name_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('name_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'name_ibu' => $this->input->post('name_ibu'),
                'name_ayah' => $this->input->post('name_ayah'),
                'hubungan' => $this->input->post('hubungan'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'create_at' => date('Y-m-d H:i:s')
            ];
            $this->Ortu_model->create($data);
            $this->session->set_flashdata('success', 'Data ortu berhasil ditambahkan');
            redirect('ortu');
        }
    }

    public function edit($id) {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Ortu';
        $data['ortu'] = $this->Ortu_model->get_by_id($id);

        if (!$data['ortu']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('ortu');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('name_ibu', 'Nama Ibu', 'required');
        $this->form_validation->set_rules('name_ayah', 'Nama Ayah', 'required');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'name_ibu' => $this->input->post('name_ibu'),
                'name_ayah' => $this->input->post('name_ayah'),
                'hubungan' => $this->input->post('hubungan'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat')
            ];
            $this->Ortu_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data ortu berhasil diupdate');
            redirect('ortu');
        }
    }

    public function delete($id) {
        $this->Ortu_model->delete($id);
        $this->session->set_flashdata('success', 'Data ortu berhasil dihapus');
        redirect('ortu');
    }

}
