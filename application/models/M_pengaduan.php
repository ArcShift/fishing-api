<?php

class M_pengaduan extends MY_Model {

    function get_search($id, $val, $method=null){
        if($method == 'search') {
            $query = $this->db->query("SELECT fc.* FROM fisherman_complaintment fc 
                WHERE fc.id_fisherman = ? AND fc.title LIKE ?
            ", array($id, '%'.$val.'%'))->result_array();
        }
        if($method == 'filter') {
            $query = $this->db->query("SELECT fc.* FROM fisherman_complaintment fc 
                WHERE fc.id_fisherman = ? AND fc.status = ?
            ", array($id, $val))->result_array();
        }

        return $query;
    }

}
