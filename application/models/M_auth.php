<?php

class M_auth extends CI_Model {

    function register($input) {
        $input['password'] = md5($input['password']);
        if ($this->db->insert('fisherman', $input)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function login($input) {
        $this->db->select('id');
        $this->db->where("(email ='" . $input['email'] . "' OR username='" . $input['email'] . "')");
        $this->db->where('password', md5($input['password']));
        if ($this->db->count_all_results('fisherman', false) == 1) {
            return $this->db->get()->result_array()[0]['id'];
        } else {
            return 'no_data';
        }
    }

}
