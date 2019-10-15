<?php

class M_pengaduan extends CI_Model {

    function read() {
        return $this->db->get('fisherman_complaintment')->result_array();
    }

}
