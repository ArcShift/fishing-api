<?php

class M_role extends CI_Model {

    public function read() {
        return $this->db->get('userType')->result_array();
    }

    public function create() {
        $this->db->set('nama', $this->input->post("nama"));
        if ($this->db->insert("userType")) {
            return 'success';
        } else {
            return $this->db->_error_message();
        }
    }

    public function update() {
        $this->db->set('nama', $this->input->post("nama"));
        $this->db->where('id', $this->input->post("id"));
        if ($this->db->update("userType")) {
            return 'success';
        } else {
            return $this->db->_error_message();
        }
    }

}
