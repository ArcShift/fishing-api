<?php

class M_ikan extends CI_Model {

    function reads($page) {
        $result = array();
        if ($this->input->post('nama')) {
            $this->db->like('name', $this->input->post('nama'));
        }
        $this->db->select("id, name, about_fish");
        $result['count'] = $this->db->count_all_results("fish", FALSE);
        $limit = $this->config->item('page_limit');
        $offset = $limit * ($page - 1);
        $this->db->limit($limit, $offset);
        $result['data'] = $this->db->get()->result_array();
        return $result;
    }

    function create() {
        $post = $this->input->post();
        $data = array(
            'name' => $post['nama'],
            'about_fish' => $post['keterangan'],
        );
        if ($this->db->insert('fish', $data)) {
            return true;
        } else {
            return false;
        }
    }

}
