<?php

class M_map extends MY_Model {
    function pengaduan(){
        $this->db->select('fm.username AS nelayan, f.name AS ikan, c.latitude, c.longitude, c.description');
        $this->db->join('fisherman fm','fm.id=c.id_fisherman');
        $this->db->join('fish f','f.id=c.id_fish');
        return $this->db->get('fisherman_log_catch_fish c')->result_array();
    }
}