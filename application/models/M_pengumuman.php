<?php

class M_pengumuman extends MY_Model {

    function all() {
        $this->db->select('a.id, a.title, a.sort_desc, r.nama AS admin, a.created_at');
        $this->db->join('user u', 'a.user=u.id');
        $this->db->join('role r', 'u.idUserType=r.id');
        return $this->db->get('announcement a')->result_array();
    }

    function detail($id) {
        $this->db->where('id', $id);
        $r = $this->db->get('announcement')->row_array();
        $r['url_img'] = base_url('upload/tangkapan/') . $r['url_img'];
        return $r;
    }

    function get_library($path){
        $query =  $this->db->query("SELECT * FROM document")->result_array();

        $x = 0;
        foreach($query as $r){
            $query[$x]['url'] = $path.$r['url'];
            $x++;
        }
        return $query;
    }

    function get_statistik($id){
        $query =  $this->db->query("SELECT created_at 
            FROM fisherman
            WHERE id = ?
        ", $id)->row_array();

        $query =  $this->db->query("SELECT sum(total_weight) as total_tangkapan, max(total_weight) as max_tangkapan 
            FROM fisherman_log_catch_fish
            WHERE id_fisherman = ?
        ", $id)->row_array();

        $query['total_jenis_ikan'] = $this->db->query("SELECT DISTINCT id_fish FROM fisherman_log_catch_fish
            WHERE id_fisherman = ?
        ", $id)->result_array();
        $query['total_jenis_ikan'] = count($query['total_jenis_ikan']);

        $query['total_pengaduan'] = $this->db->query("SELECT count(id) as total_pengaduan 
            FROM fisherman_complaintment
            WHERE id_fisherman = ?
        ", $id)->row_array()['total_pengaduan'];
        
        $query['proses_pengaduan'] = $this->db->query("SELECT count(id) as total_pengaduan 
            FROM fisherman_complaintment
            WHERE id_fisherman = ? AND `status` = 'sedang ditangani'
        ", $id)->row_array()['total_pengaduan'];

        $query['selesai_pengaduan'] = $this->db->query("SELECT count(id) as total_pengaduan 
            FROM fisherman_complaintment
            WHERE id_fisherman = ? AND `status` = 'selesai'
        ", $id)->row_array()['total_pengaduan'];

        return $query;
    }

}
