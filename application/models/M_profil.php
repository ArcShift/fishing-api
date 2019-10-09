<?php

class M_profil extends CI_Model {

    function update_email($input) {
        $this->db->set('email', $input['email']);
        $this->db->where('id', $input['id']);
        if ($this->db->update('fisherman')) {
            $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
            $this->db->where('id', $input['id']);
            return $this->db->get('fisherman')->result_array()[0];
        } else {
            return false;
        }
    }

    function update_pass($input) {
        $this->db->set('password', md5($input['password']));
        $this->db->where('id', $input['id']);
        if ($this->db->update('fisherman')) {
            $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
            $this->db->where('id', $input['id']);
            return $this->db->get('fisherman')->result_array()[0];
        } else {
            return false;
        }
    }

}
