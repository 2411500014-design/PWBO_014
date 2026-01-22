<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Kunjungan_model', 'Anak_model']);
    }

    // Tampil semua data kunjungan
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

    // Form tambah data kunjungan
    public function tambah() {
        $this->load->helper('form');
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

    // Simpan data kunjungan baru
    public function store() {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('anak_id', 'Nama Anak', 'required|trim');
        $this->form_validation->set_rules('tgl_kunjungan', 'Tanggal Kunjungan', 'required|trim');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // Siapkan data untuk disimpan
            $data = [
                'anak_id' => $this->input->post('anak_id'),
                'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
                'fasilitas' => $this->input->post('fasilitas')
            ];

            // Simpan ke database
            $this->Kunjungan_model->create($data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data kunjungan berhasil ditambahkan');
            redirect('kunjungan');
        }
    }

    // Form edit data kunjungan
    public function edit($id) {
        $this->load->helper('form');
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Kunjungan';
        $data['kunjungan'] = $this->Kunjungan_model->get_by_id($id);
        $data['anak_list'] = $this->Anak_model->get_all();

        // Cek apakah data ada
        if (!$data['kunjungan']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('kunjungan');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('kunjungan/edit', $data);
        $this->load->view('template/footer');
    }

    // Update data kunjungan
    public function update($id) {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('anak_id', 'Nama Anak', 'required|trim');
        $this->form_validation->set_rules('tgl_kunjungan', 'Tanggal Kunjungan', 'required|trim');
        $this->form_validation->set_rules('fasilitas', 'Fasilitas', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            // Siapkan data untuk diupdate
            $data = [
                'anak_id' => $this->input->post('anak_id'),
                'tgl_kunjungan' => $this->input->post('tgl_kunjungan'),
                'fasilitas' => $this->input->post('fasilitas')
            ];

            // Update ke database
            $this->Kunjungan_model->update($id, $data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data kunjungan berhasil diupdate');
            redirect('kunjungan');
        }
    }

    // Hapus data kunjungan
    public function delete($id) {
        $this->Kunjungan_model->delete($id);
        $this->session->set_flashdata('success', 'Data kunjungan berhasil dihapus');
        redirect('kunjungan');
    }
}
