<?php

class M_pengumuman extends MY_Model {

    function all() {
        $this->db->select('id, title');
        return $this->db->get('announcement')->result_array();
    }

    function detail($id) {
        $this->db->where('id', $id);
        return $this->db->get('announcement')->result_array();
    }

}
