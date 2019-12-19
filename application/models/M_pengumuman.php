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

}
