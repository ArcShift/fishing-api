<?php

class M_admin extends CI_Model {

    public function read() {
        if ($this->input->post('username')) {
            $this->db->like('u.nama', $this->input->post('username'));
        }
        if ($this->input->post('role')) {
            $this->db->like('r.id', $this->input->post('role'));
        }
        $this->db->select("u.id, r.nama AS type, u.nama");
        $this->db->join("role r", "u.idUserType = r.id");
        return $this->db->get("user u")->result_array();
    }

    public function create() {
        $post = $this->input->post();
        $data = array(
            'nama' => $post['username'],
            'idUserType' => $post['type'],
            'pass' => md5($post['pass'])
        );
        if ($this->db->insert('user', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function detail($id) {
        $this->db->where('u.id', $id);
        $this->db->select("u.id, r.nama AS type, u.nama");
        $this->db->join("role r", "u.idUserType = r.id");
        return $this->db->get("user u")->result_array()[0];
    }

    public function delete($id) {
        $this->db->where('id', $id);
        if ($this->db->delete('user')) {
            return true;
        } else {
            return false;
        }
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
