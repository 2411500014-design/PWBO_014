<?php
class User_model extends CI_Model {

    public function check_login($email, $password) {
        $this->db->where('email', $email);
        $query = $this->db->get('user');
        $user = $query->row();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }
        return false;
    }
}