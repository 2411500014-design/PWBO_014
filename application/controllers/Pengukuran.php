<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengukuran extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Pengukuran_model', 'Kunjungan_model']);
        $this->load->library(['form_validation', 'session']);
        $this->load->helper(['url', 'form']);
    }

    public function index()
    {
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

    public function tambah()
    {
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

    public function store()
    {
        $this->form_validation->set_rules('kunjungan_id', 'Kunjungan', 'required');
        $this->form_validation->set_rules('tgl_ukur', 'Tanggal Ukur', 'required');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|numeric');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|numeric');
        $this->form_validation->set_rules('lk', 'Lingkar Kepala', 'required|numeric');
        $this->form_validation->set_rules('vaksin', 'Vaksin', 'required');
        $this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->tambah();
        } else {
            $data = [
                'kunjungan_id' => $this->input->post('kunjungan_id'),
                'tgl_ukur' => $this->input->post('tgl_ukur'),
                'bb' => $this->input->post('bb'),
                'tb' => $this->input->post('tb'),
                'lk' => $this->input->post('lk'),
                'vaksin' => $this->input->post('vaksin'),
                'status_gizi' => $this->input->post('status_gizi')
            ];
            $this->Pengukuran_model->tambah($data);
            $this->session->set_flashdata('success', 'Data pengukuran berhasil ditambahkan');
            redirect('pengukuran');
        }
    }

    public function edit($id)
    {
        $data['user'] = [
            'name' => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];
        $data['page_title'] = 'Edit Data Pengukuran';
        $data['pengukuran'] = $this->Pengukuran_model->get_by_id($id);
        $data['kunjungan_list'] = $this->Kunjungan_model->get_all();

        if (!$data['pengukuran']) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect('pengukuran');
        }

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('pengukuran/edit', $data);
        $this->load->view('template/footer');
    }

    public function update($id)
    {
        $this->form_validation->set_rules('kunjungan_id', 'Kunjungan', 'required');
        $this->form_validation->set_rules('tgl_ukur', 'Tanggal Ukur', 'required');
        $this->form_validation->set_rules('bb', 'Berat Badan', 'required|numeric');
        $this->form_validation->set_rules('tb', 'Tinggi Badan', 'required|numeric');
        $this->form_validation->set_rules('lk', 'Lingkar Kepala', 'required|numeric');
        $this->form_validation->set_rules('vaksin', 'Vaksin', 'required');
        $this->form_validation->set_rules('status_gizi', 'Status Gizi', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->edit($id);
        } else {
            $data = [
                'kunjungan_id' => $this->input->post('kunjungan_id'),
                'tgl_ukur' => $this->input->post('tgl_ukur'),
                'bb' => $this->input->post('bb'),
                'tb' => $this->input->post('tb'),
                'lk' => $this->input->post('lk'),
                'vaksin' => $this->input->post('vaksin'),
                'status_gizi' => $this->input->post('status_gizi')
            ];
            $this->Pengukuran_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data pengukuran berhasil diupdate');
            redirect('pengukuran');
        }
    }

    public function delete($id)
    {
        $this->Pengukuran_model->delete($id);
        $this->session->set_flashdata('success', 'Data pengukuran berhasil dihapus');
        redirect('pengukuran');
    }
}
