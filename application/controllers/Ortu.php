<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Ortu_model');
    }

    // Tampil semua data ortu
    public function index() {
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Data Orang Tua';
        $data['ortu'] = $this->Ortu_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/index', $data);
        $this->load->view('template/footer');
    }

    // Form tambah data ortu
    public function tambah() {
        $this->load->helper('form');
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Tambah Data Orang Tua';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/tambah', $data);
        $this->load->view('template/footer');
    }

    // Simpan data ortu baru
    public function store() {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('name_ibu', 'Nama Ibu', 'required|trim');
        $this->form_validation->set_rules('name_ayah', 'Nama Ayah', 'required|trim');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // Siapkan data untuk disimpan
            $data = [
                'name_ibu' => $this->input->post('name_ibu'),
                'name_ayah' => $this->input->post('name_ayah'),
                'hubungan' => $this->input->post('hubungan'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'create_at' => date('Y-m-d H:i:s')
            ];

            // Simpan ke database
            $this->Ortu_model->create($data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data orang tua berhasil ditambahkan');
            redirect('ortu');
        }
    }

    // Form edit data ortu
    public function edit($id) {
        $this->load->helper('form');
        $data['user'] = [
            'name'  => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Orang Tua';
        $data['ortu'] = $this->Ortu_model->get_by_id($id);

        // Cek apakah data ada
        if (!$data['ortu']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('ortu');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('ortu/edit', $data);
        $this->load->view('template/footer');
    }

    // Update data ortu
    public function update($id) {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('name_ibu', 'Nama Ibu', 'required|trim');
        $this->form_validation->set_rules('name_ayah', 'Nama Ayah', 'required|trim');
        $this->form_validation->set_rules('hubungan', 'Hubungan', 'required|trim');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            // Siapkan data untuk diupdate
            $data = [
                'name_ibu' => $this->input->post('name_ibu'),
                'name_ayah' => $this->input->post('name_ayah'),
                'hubungan' => $this->input->post('hubungan'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat')
            ];

            // Update ke database
            $this->Ortu_model->update($id, $data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data orang tua berhasil diupdate');
            redirect('ortu');
        }
    }

    // Hapus data ortu
    public function delete($id) {
        $this->Ortu_model->delete($id);
        $this->session->set_flashdata('success', 'Data orang tua berhasil dihapus');
        redirect('ortu');
    }

}
