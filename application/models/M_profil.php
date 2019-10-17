<?php

class M_profil extends CI_Model {

    private $table = "fisherman";

    function edit($input) {
        $this->db->set('name', $input['name']);
        $this->db->set('bio', $input['bio']);
        $this->db->set('phone_number', $input['phone_number']);
        return $this->update($input);
    }

    function update_email($input) {
        $this->db->set('email', $input['email']);
        return $this->update($input);
    }

    function update_pass($input) {
        $this->db->set('password', md5($input['password']));
        return $this->update($input);
    }

    function update_foto($input, $data) {
        $this->db->set('url_photo', $data['file_name']);
        return $this->update($input);
    }

    private function update($input) {
        $this->db->where('id', $input['id']);
        if ($this->db->update('fisherman')) {
            return $this->retrieve($input);
        } else {
            return false;
        }
    }

    public function retrieve($input) {
        $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers');
        $this->db->where('id', $input['id']);
        if ($this->db->count_all_results('fisherman', false) == 1) {
            $result = $this->db->get()->result_array()[0];
            if (!empty($result['url_photo'])) {
                $result['url_photo'] = base_url('upload/profil/') . $result['url_photo'];
            } else {
                $result['url_photo'] = null;
            }
            return $result;
        } else {
            return 'no_data';
        }
    }

}
