<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu_model extends CI_Model {

    protected $table = 'ortu';
    protected $primary_key = 'id_ortu';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Ambil semua data ortu
    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    // Ambil data ortu berdasarkan ID
    public function get_by_id($id) {
        return $this->db->where($this->primary_key, $id)->get($this->table)->row();
    }

    // Tambah data ortu baru
    public function create($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    // Update data ortu
    public function update($id, $data) {
        $this->db->where($this->primary_key, $id);
        return $this->db->update($this->table, $data);
    }

    // Hapus data ortu
    public function delete($id) {
        $this->db->where($this->primary_key, $id);
        return $this->db->delete($this->table);
    }

    // Hitung jumlah data ortu
    public function count_all() {
        return $this->db->count_all($this->table);
    }
}
