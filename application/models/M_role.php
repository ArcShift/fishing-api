<?php

class M_role extends CI_Model {
    private $table= "role";
    public function read() {
        return $this->db->get($this->table)->result_array();
    }

    public function create() {
        $this->db->set('nama', $this->input->post("nama"));
        if ($this->db->insert($this->table)) {
            return 'success';
        } else {
            return $this->db->_error_message();
        }
    }

    public function update() {
        $this->db->set('nama', $this->input->post("nama"));
        $this->db->where('id', $this->input->post("id"));
        if ($this->db->update($this->table)) {
            return 'success';
        } else {
            return $this->db->_error_message();
        }
    }

}
