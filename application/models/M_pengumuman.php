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

    function get_library(){
        $query =  $this->db->query("SELECT * FROM document")->result_array();
        $x = 0;
        foreach($query as $r){
            $query[$x]['url'] = base_url('upload/dokumen').$r['url'];
            $x++;
        }
        return $query;
    }

    function get_statistik($id){
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

        $query['tgl_register'] =  $this->db->query("SELECT created_at 
            FROM fisherman
            WHERE id = ?
        ", $id)->row_array()['created_at'];
        $query['tgl_register'] = date('d M Y', strtotime($query['tgl_register']));

        return $query;
    }

    function get_beranda($id){
        $id_param =  $this->db->query("SELECT id_follower FROM fisherman_follow WHERE id_fisherman = ?", $id)->result_array();      

        foreach($id_param as $r) $param[] = $r['id_follower'];

        $param = array();
        $x = '';
        foreach($param as $r) $x .= "?,";
        $x .= '?';

        $param[] = $id;

        $query = $this->db->query("SELECT fp.* 
            FROM fisherman_post fp
            WHERE fp.id_fisherman IN ($x) ORDER BY fp.id DESC
        ",$param)->result_array();
        
        $x=0;
        foreach($query as $r){
            $path = $this->db->query("SELECT url_file FROM fisherman_post_files
                WHERE id_fisherman_post = ?
            ", $r['id'])->result_array();

            foreach($path as $p) $query[$x]['path_file'][] =$this->config->item('base_url').'/upload/post/'.$p['url_file'];

            $query[$x]['total_like'] = $this->db->query("SELECT count(id_fisherman) as total FROM fisherman_post_likes
                WHERE id_fisherman_post = ?
            ", $r['id'])->row_array()['total'];

            $query[$x]['comment'] = $this->db->query("SELECT fpc.*, f.name as name_fisherman FROM fisherman_post_comments fpc
                LEFT JOIN fisherman f ON f.id = fpc.id_fisherman
                WHERE fpc.id_fisherman_post = ?
            ", $r['id'])->result_array();

            $x++;
        }

        return $query;
    }

}
