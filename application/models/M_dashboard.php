<?php

class M_dashboard extends CI_Model{
    public function countAdmin() {
        return $this->db->count_all_results('user');
    }
    public function countFisherman() {
        return $this->db->count_all_results('fisherman');
    }
}
