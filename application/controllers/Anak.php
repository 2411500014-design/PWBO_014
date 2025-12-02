<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anak extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Anak_model', 'Ortu_model']);
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Data Anak';
        $data['anak'] = $this->Anak_model->get_all();
        $data['ortu_list'] = $this->Ortu_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('anak/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Tambah Data Anak';
        $data['ortu_list'] = $this->Ortu_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('anak/tambah', $data);
        $this->load->view('template/footer');
    }

    public function store() {
        $this->form_validation->set_rules('ortu_id', 'Orang Tua', 'required');
        $this->form_validation->set_rules('name', 'Nama Anak', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('bb_lahir', 'Berat Badan Lahir', 'required|numeric');
        $this->form_validation->set_rules('tb_lahir', 'Tinggi Badan Lahir', 'required|numeric');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('goldar', 'Golongan Darah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'ortu_id' => $this->input->post('ortu_id'),
                'name' => $this->input->post('name'),
                'nik' => $this->input->post('nik'),
                'jk' => $this->input->post('jk'),
                'bb_lahir' => $this->input->post('bb_lahir'),
                'tb_lahir' => $this->input->post('tb_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'goldar' => $this->input->post('goldar'),
                'create_at' => date('Y-m-d H:i:s')
            ];
            $this->Anak_model->tambah($data);
            $this->session->set_flashdata('success', 'Data anak berhasil ditambahkan');
            redirect('anak');
        }
    }

    public function edit($id) {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Anak';
        $data['anak'] = $this->Anak_model->get_by_id($id);
        $data['ortu_list'] = $this->Ortu_model->get_all();

        if (!$data['anak']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('anak');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('anak/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('ortu_id', 'Orang Tua', 'required');
        $this->form_validation->set_rules('name', 'Nama Anak', 'required');
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
        $this->form_validation->set_rules('bb_lahir', 'Berat Badan Lahir', 'required|numeric');
        $this->form_validation->set_rules('tb_lahir', 'Tinggi Badan Lahir', 'required|numeric');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('goldar', 'Golongan Darah', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'ortu_id' => $this->input->post('ortu_id'),
                'name' => $this->input->post('name'),
                'nik' => $this->input->post('nik'),
                'jk' => $this->input->post('jk'),
                'bb_lahir' => $this->input->post('bb_lahir'),
                'tb_lahir' => $this->input->post('tb_lahir'),
                'tgl_lahir' => $this->input->post('tgl_lahir'),
                'goldar' => $this->input->post('goldar')
            ];
            $this->Anak_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data anak berhasil diupdate');
            redirect('anak');
        }
    }

    public function delete($id) {
        $this->Anak_model->delete($id);
        $this->session->set_flashdata('success', 'Data anak berhasil dihapus');
        redirect('anak');
    }
}
