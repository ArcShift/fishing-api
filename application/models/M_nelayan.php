<?php

class M_nelayan extends CI_Model {

    private $table = "fisherman";

    public function reads($page) {
        $result= array();
        if ($this->input->post('nama')) {
            $this->db->like('name', $this->input->post('nama'));
        }
        $result['count']=$this->db->count_all_results($this->table, FALSE);
        $limit =$this->config->item('page_limit');
        $offset = $limit*($page-1);
        $this->db->limit($limit, $offset);
        $result['data']=$this->db->get()->result_array();
        return $result;
    }

    public function read($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->result_array()[0];
    }

}
