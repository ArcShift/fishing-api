<?php

class M_dashboard extends CI_Model{
    public function countAdmin() {
        $this->db->where('idUserType <> 1');
        return $this->db->count_all_results('user');
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
    public function countPengaduanTertangani() {
        $this->db->where('status','selesai');
        return $this->db->count_all_results('fisherman_complaintment');
    }
}
