<?php

class M_profil extends CI_Model {

    private $table = "fisherman";

    function edit($input) {
        $this->db->set('name', $input['name']);
        $this->db->set('bio', $input['bio']);
        $this->db->set('phone_number', $input['phone_number']);
        $this->db->where('id', $input['id']);
        return $this->update_n_retrieve($input);
    }

    function update_email($input) {
        $this->db->set('email', $input['email']);
        $this->db->where('id', $input['id']);
        return $this->update_n_retrieve($input);
    }

    function update_pass($input) {
        $this->db->set('password', md5($input['password']));
        $this->db->where('id', $input['id']);
        return $this->update_n_retrieve($input);
    }

    private function update_n_retrieve($input) {
        if ($this->db->update('fisherman')) {
            $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
            $this->db->where('id', $input['id']);
            if ($this->db->count_all_results('fisherman', false) == 1) {
                return $this->db->get()->result_array()[0];
            } else {
                return 'no_data';
            }
        } else {
            return false;
        }
    }

}
