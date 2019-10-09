<?php

class M_profil extends CI_Model {

    function update_email($input) {
        $this->db->set('email', $input['email']);
        $this->db->where('id', $input['id']);
        if ($this->db->update('fisherman')) {
            return true;
        } else {
            return false;
        }
    }
    function update_pass($input) {
        $this->db->set('password', md5($input['password']));
        $this->db->where('id', $input['id']);
        if ($this->db->update('fisherman')) {
            return true;
        } else {
            return false;
        }
    }

}
