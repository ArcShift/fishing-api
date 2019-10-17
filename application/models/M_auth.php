<?php

class M_auth extends CI_Model {

    function register($input) {
        $input['password'] = md5($input['password']);
        if ($this->db->insert('fisherman', $input)) {
            $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
            $this->db->where('id', $this->db->insert_id());
            return $this->db->get('fisherman')->result_array()[0];
        } else {
            return false;
        }
    }

    function login($input) {
        $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
        $this->db->where("(email ='" . $input['email'] . "' OR username='" . $input['email'] . "')");
        $this->db->where('password', md5($input['password']));
        if ($this->db->count_all_results('fisherman', false) == 1) {
            $result=$this->db->get()->result_array()[0];
            if (!empty($result['url_photo'])) {
                $result['url_photo'] = base_url('upload/profil/') . $result['url_photo'];
            } else {
                $result['url_photo'] = null;
            }
            return $result;
        } else {
            return 'no_data';
        }
    }

}
