<?php

class M_login extends CI_Model {

    public function login() {
        $this->db->select('u.id, u.nama, r.nama AS role');
        $this->db->where('u.nama', $this->input->post('user'));
        $this->db->where('u.pass', md5($this->input->post('pass')));
        $this->db->join('role r', 'r.id = u.idUserType');
        $result = $this->db->get('user u');
        if ($result->num_rows()) {
            $result = $result->result_array()[0];
            $data = array(
                'userId' => $result['id'],
                'user' => $result['nama'],
                'role' => $result['role']
            );
            $this->session->set_userdata($data);
            return true;
        } else {
            return false;
        }
    }

}
