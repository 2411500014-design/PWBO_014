<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengukuran_model extends CI_Model {

    protected $table = 'pengukuran';
    protected $primary_key = 'id_ukur';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select('pengukuran.*, kunjungan.tgl_kunjungan, anak.name as nama_anak, anak.nik, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('kunjungan', 'kunjungan.id_kunjungan = pengukuran.kunjungan_id', 'left');
        $this->db->join('anak', 'anak.id_anak = kunjungan.anak_id', 'left');
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('pengukuran.*, kunjungan.tgl_kunjungan, kunjungan.id_kunjungan, anak.name as nama_anak, anak.nik, anak.id_anak, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('kunjungan', 'kunjungan.id_kunjungan = pengukuran.kunjungan_id', 'left');
        $this->db->join('anak', 'anak.id_anak = kunjungan.anak_id', 'left');
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        $this->db->where('pengukuran.' . $this->primary_key, $id);
        return $this->db->get()->row();
    }

    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data) {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id) {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    public function get_by_kunjungan($kunjungan_id) {
        $this->db->select('pengukuran.*, kunjungan.tgl_kunjungan');
        $this->db->from($this->table);
        $this->db->join('kunjungan', 'kunjungan.id_kunjungan = pengukuran.kunjungan_id', 'left');
        $this->db->where('pengukuran.kunjungan_id', $kunjungan_id);
        return $this->db->get()->result();
    }
}
