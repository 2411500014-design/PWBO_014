<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anak extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Anak_model', 'Ortu_model']);
    }

    // Tampil semua data anak
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

    // Form tambah data anak
    public function tambah() {
        $this->load->helper('form');
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

    // Simpan data anak baru
    public function store() {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('ortu_id', 'Orang Tua', 'required|trim');
        $this->form_validation->set_rules('name', 'Nama Anak', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('bb_lahir', 'Berat Badan Lahir', 'required|trim|numeric');
        $this->form_validation->set_rules('tb_lahir', 'Tinggi Badan Lahir', 'required|trim|numeric');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('goldar', 'Golongan Darah', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // Siapkan data untuk disimpan
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

            // Simpan ke database
            $this->Anak_model->create($data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data anak berhasil ditambahkan');
            redirect('anak');
        }
    }

    // Form edit data anak
    public function edit($id) {
        $this->load->helper('form');
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Anak';
        $data['anak'] = $this->Anak_model->get_by_id($id);
        $data['ortu_list'] = $this->Ortu_model->get_all();

        // Cek apakah data ada
        if (!$data['anak']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('anak');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('anak/edit', $data);
        $this->load->view('template/footer');
    }

    // Update data anak
    public function update($id) {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('ortu_id', 'Orang Tua', 'required|trim');
        $this->form_validation->set_rules('name', 'Nama Anak', 'required|trim');
        $this->form_validation->set_rules('nik', 'NIK', 'required|trim|numeric');
        $this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required|trim');
        $this->form_validation->set_rules('bb_lahir', 'Berat Badan Lahir', 'required|trim|numeric');
        $this->form_validation->set_rules('tb_lahir', 'Tinggi Badan Lahir', 'required|trim|numeric');
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('goldar', 'Golongan Darah', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            // Siapkan data untuk diupdate
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

            // Update ke database
            $this->Anak_model->update($id, $data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data anak berhasil diupdate');
            redirect('anak');
        }
    }

    // Hapus data anak
    public function delete($id) {
        $this->Anak_model->delete($id);
        $this->session->set_flashdata('success', 'Data anak berhasil dihapus');
        redirect('anak');
    }
}
