<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ortu_model extends CI_Model {

    private $table = 'ortu';

    public function get_all() {
        
        $query = $this->db->get($this->table);
        return $query->result();
    }
}