<?php

class M_pengaduan extends CI_Model {

    function read($id) {
        $result = array();
        $this->db->where('fc.id', $id);
        $this->db->join('fisherman f', 'fc.id_fisherman= f.id');
        $result['main'] = $this->db->get('fisherman_complaintment fc')->result_array()[0];
        $this->db->where('fc.id', $id);
        $this->db->join('fisherman_complaintment fc', 'fc.id= fcf.id_fisherman_complaintment');
        $result['files'] = $this->db->get('fisherman_complaintment_files fcf')->result_array();
        
        return $result;
    }

}
