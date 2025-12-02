<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anak_model extends CI_Model {

    protected $table = 'anak';
    protected $primary_key = 'id_anak';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all() {
        $this->db->select('anak.*, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        return $this->db->get()->result();
    }

    public function get_by_id($id) {
        $this->db->select('anak.*, ortu.name_ibu, ortu.name_ayah');
        $this->db->from($this->table);
        $this->db->join('ortu', 'ortu.id_ortu = anak.ortu_id', 'left');
        $this->db->where('anak.' . $this->primary_key, $id);
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

    public function get_by_ortu($ortu_id) {
        return $this->db->where('ortu_id', $ortu_id)->get($this->table)->result();
    }
}
