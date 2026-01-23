<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Anak_model', 'Ortu_model', 'Kunjungan_model', 'Pengukuran_model']);
    }

    public function index()
    {
        $data['user'] = [
            'name' => $this->session->userdata('name_user'),
            'email' => $this->session->userdata('email')
        ];

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('laporan/index', $data);
        $this->load->view('template/footer');
    }

    // Return JSON data for requested type
    public function data($type = '')
    {
        switch ($type) {
            case 'anak':
                $rows = $this->Anak_model->get_all();
                break;
            case 'ortu':
                $rows = $this->Ortu_model->get_all();
                break;
            case 'kunjungan':
                $rows = $this->Kunjungan_model->get_all();
                break;
            case 'pengukuran':
                $rows = $this->Pengukuran_model->get_all();
                break;
            default:
                $rows = [];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($rows));
    }

    // Return detailed data for a single anak (child)
    public function anak($id = null)
    {
        if (!$id) {
            $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'missing id']));
            return;
        }

        $anak = $this->Anak_model->get_by_id($id);
        if (!$anak) {
            $this->output
                ->set_status_header(404)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'anak not found']));
            return;
        }

        // Ambil semua kunjungan untuk anak ini
        $this->load->model('Kunjungan_model');
        $this->load->model('Pengukuran_model');

        $kunjungan = $this->Kunjungan_model->get_by_anak($id);
        $visits = [];
        foreach ($kunjungan as $k) {
            $measures = $this->Pengukuran_model->get_by_kunjungan($k->id_kunjungan);
            // Bisa ada banyak pengukuran per kunjungan; ambil semua
            $visits[] = [
                'id_kunjungan' => $k->id_kunjungan,
                'tgl_kunjungan' => $k->tgl_kunjungan,
                'fasilitas' => isset($k->fasilitas) ? $k->fasilitas : null,
                'pengukuran' => $measures
            ];
        }

        $result = [
            'anak' => $anak,
            'ortu' => ['name_ibu' => isset($anak->name_ibu) ? $anak->name_ibu : null, 'name_ayah' => isset($anak->name_ayah) ? $anak->name_ayah : null],
            'kunjungan' => $visits
        ];

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }
}
