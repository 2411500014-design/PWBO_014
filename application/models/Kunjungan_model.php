<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan_model extends CI_Model {

    protected $table = 'kunjungan';
    protected $primary_key = 'id_kunjungan';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data kunjungan dengan join ke tabel anak dan ortu
    public function get_all() {
        $this->db->select('kunjungan.*, anak.name as nama_anak, anak.nik, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('anak', 'anak.id_anak = kunjungan.anak_id', 'left');
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        return $this->db->get()->result();
    }

    // Ambil data kunjungan berdasarkan ID dengan join ke tabel anak dan ortu
    public function get_by_id($id) {
        $this->db->select('kunjungan.*, anak.name as nama_anak, anak.nik, anak.id_anak, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('anak', 'anak.id_anak = kunjungan.anak_id', 'left');
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        $this->db->where('kunjungan.' . $this->primary_key, $id);
        return $this->db->get()->row();
    }

    // Tambah data kunjungan baru
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update data kunjungan
    public function update($id, $data) {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data kunjungan
    public function delete($id) {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    // Ambil data kunjungan berdasarkan anak_id
    public function get_by_anak($anak_id) {
        $this->db->select('kunjungan.*, anak.name as nama_anak');
        $this->db->from($this->table);
        $this->db->join('anak', 'anak.id_anak = kunjungan.anak_id', 'left');
        $this->db->where('kunjungan.anak_id', $anak_id);
        return $this->db->get()->result();
    }
}
