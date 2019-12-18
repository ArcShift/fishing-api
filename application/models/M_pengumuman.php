<?php

class M_pengumuman extends MY_Model {

    function all() {
        $this->db->select('id, title');
        return $this->db->get('announcement')->result_array();
    }

    function detail($id) {
        $this->db->where('id', $id);
        $r=$this->db->get('announcement')->row_array();
        $r['url_img']=base_url('upload/tangkapan/') .$r['url_img'];
        return $r;
    }

}
