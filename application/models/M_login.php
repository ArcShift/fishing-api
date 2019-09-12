<?php

class M_login extends CI_Model {

    public function login() {
        $this->db->where('nama', $this->input->post('user'));
        $this->db->where('pass', md5($this->input->post('pass')));
        $result = $this->db->get('user');
        if ($result->num_rows()) {
            $result = $result->result_array()[0];
            $data = array(
                'userId' => $result['id'],
                'user' => $result['nama']
            );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

}
