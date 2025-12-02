<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Kunjungan_model', 'Anak_model']);
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Data Kunjungan';
        $data['kunjungan'] = $this->Kunjungan_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('kunjungan/index', $data);
        $this->load->view('template/footer');
    }

    public function tambah() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Tambah Data Kunjungan';
        $data['anak_list'] = $this->Anak_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('kunjungan/tambah', $data);
        $this->load->view('template/footer');
    }

    public function store() {
        $this->form_validation->set_rules('anak_id', 'Nama Anak', 'required');
        $this->form_validation->set_rules('tgl_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'anak_id' => $this->input->post('anak_id'),
                'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
                'fasilitas' => $this->input->post('fasilitas')
            ];
            $this->Kunjungan_model->tambah($data);
            $this->session->set_flashdata('success', 'Data kunjungan berhasil ditambahkan');
            redirect('kunjungan');
        }
    }

    public function edit($id) {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Kunjungan';
        $data['kunjungan'] = $this->Kunjungan_model->get_by_id($id);
        $data['anak_list'] = $this->Anak_model->get_all();

        if (!$data['kunjungan']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('kunjungan');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('kunjungan/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id) {
        $this->form_validation->set_rules('anak_id', 'Nama Anak', 'required');
        $this->form_validation->set_rules('tgl_kunjungan', 'Tanggal Kunjungan', 'required');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'anak_id' => $this->input->post('anak_id'),
                'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
                'fasilitas' => $this->input->post('fasilitas')
            ];
            $this->Kunjungan_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data kunjungan berhasil diupdate');
            redirect('kunjungan');
        }
    }

    public function delete($id) {
        $this->Kunjungan_model->delete($id);
        $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus');
        redirect('kunjungan');
    }
}
