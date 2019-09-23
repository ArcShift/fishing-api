<?php

class M_nelayan extends CI_Model {

    private $table = "fisherman";

    public function reads() {
        return $this->db->get($this->table, $this->config->item('page_limit'))->result_array();
    }

    public function read($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->result_array()[0];
    }

}
