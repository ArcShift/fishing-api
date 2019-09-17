<?php

class M_admin extends CI_Model {

    public function read() {
        $this->db->select("u.id, t.nama AS type, u.nama");
        $this->db->join("userType t", "u.idUserType = t.id");
        return $this->db->get("user u")->result_array();
    }

    public function create() {
        $post= $this->input->post();
        $data = array(
            'nama' => $post['username'],
            'idUserType' => $post['type'],
            'pass' => $post['pass']
        );
        if ($this->db->insert('user', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function detail() {
        if ($this->input->post('id')) {
            $this->db->where('u.id', $this->input->post('id'));
        } else {
            $this->db->where('u.id', $this->session->userId);
        }
        $this->db->select("u.id, t.nama AS type, u.nama");
        $this->db->join("userType t", "u.idUserType = t.id");
        return $this->db->get("user u")->result_array();
    }

    public function checkPass() {
        $this->db->where('id', $this->input->post('id'));
        $this->db->where('pass', md5($this->input->post('pass')));
        $result = $this->db->get('user');
        if ($result->num_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function gantiPassword() {
        $this->db->set("pass", md5($this->input->post("newPass")));
        $this->db->where("id", $this->input->post("id"));
        return $this->db->update("user");
    }

    public function updateData() {
        $this->db->set("nama", $this->input->post("nama"));
        $this->db->where("id", $this->input->post("id"));
        return $this->db->update("user");
    }

}
