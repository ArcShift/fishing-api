<?php

class M_dashboard extends CI_Model{
    public function countAdmin() {
        return $this->db->count_all('user');
    }
    public function countFisherman() {
        return $this->db->count_all('fisherman');
    }
    public function countFish() {
        return $this->db->count_all('fish');
    }
    public function countPengaduan() {
        return $this->db->count_all('fisherman_complaintment');
    }
}
