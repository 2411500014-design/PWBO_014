<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengukuran extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Pengukuran_model', 'Kunjungan_model']);
    }

    // Tampil semua data pengukuran
    public function index() {
        $data['user'] = [
            'name' => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Data Pengukuran';
        $data['pengukuran'] = $this->Pengukuran_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pengukuran/index', $data);
        $this->load->view('template/footer');
    }

    // Form tambah data pengukuran
    public function tambah() {
        $this->load->helper('form');
        $data['user'] = [
            'name' => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Tambah Data Pengukuran';
        $data['kunjungan_list'] = $this->Kunjungan_model->get_all();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pengukuran/tambah', $data);
        $this->load->view('template/footer');
    }

    // Simpan data pengukuran baru
    public function store() {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('kunjungan_id', 'Kunjungan', 'required|trim');
        $this->form_validation->set_rules('tgl_ukur', 'Tanggal Ukur', 'required|trim');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|trim|numeric');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|trim|numeric');
        $this->form_validation->set_rules('lk', 'Lingkar Kepala', 'required|trim|numeric');
        $this->form_validation->set_rules('vaksin', 'Vaksin', 'required|trim');
        $this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            // Siapkan data untuk disimpan
            $data = [
                'kunjungan_id' => $this->input->post('kunjungan_id'),
                'tgl_ukur' => $this->input->post('tgl_ukur'),
                'bb' => $this->input->post('bb'),
                'tb' => $this->input->post('tb'),
                'lk' => $this->input->post('lk'),
                'vaksin' => $this->input->post('vaksin'),
                'status_gizi' => $this->input->post('status_gizi')
            ];

            // Simpan ke database
            $this->Pengukuran_model->create($data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data pengukuran berhasil ditambahkan');
            redirect('pengukuran');
        }
    }

    // Form edit data pengukuran
    public function edit($id) {
        $this->load->helper('form');
        $data['user'] = [
            'name' => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Pengukuran';
        $data['pengukuran'] = $this->Pengukuran_model->get_by_id($id);
        $data['kunjungan_list'] = $this->Kunjungan_model->get_all();

        // Cek apakah data ada
        if (!$data['pengukuran']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('pengukuran');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pengukuran/edit', $data);
        $this->load->view('template/footer');
    }

    // Update data pengukuran
    public function update($id) {
        $this->load->library('form_validation');
        // Validasi form
        $this->form_validation->set_rules('kunjungan_id', 'Kunjungan', 'required|trim');
        $this->form_validation->set_rules('tgl_ukur', 'Tanggal Ukur', 'required|trim');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|trim|numeric');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|trim|numeric');
        $this->form_validation->set_rules('lk', 'Lingkar Kepala', 'required|trim|numeric');
        $this->form_validation->set_rules('vaksin', 'Vaksin', 'required|trim');
        $this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required|trim');

        // Jika validasi gagal, kembali ke form
        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            // Siapkan data untuk diupdate
            $data = [
                'kunjungan_id' => $this->input->post('kunjungan_id'),
                'tgl_ukur' => $this->input->post('tgl_ukur'),
                'bb' => $this->input->post('bb'),
                'tb' => $this->input->post('tb'),
                'lk' => $this->input->post('lk'),
                'vaksin' => $this->input->post('vaksin'),
                'status_gizi' => $this->input->post('status_gizi')
            ];

            // Update ke database
            $this->Pengukuran_model->update($id, $data);
            
            // Tampilkan pesan sukses
            $this->session->set_flashdata('success', 'Data pengukuran berhasil diupdate');
            redirect('pengukuran');
        }
    }

    // Hapus data pengukuran
    public function delete($id) {
        $this->Pengukuran_model->delete($id);
        $this->session->set_flashdata('success', 'Data pengukuran berhasil dihapus');
        redirect('pengukuran');
    }
}
