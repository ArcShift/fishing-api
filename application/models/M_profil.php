<?php

//require_once(APPPATH . "models/Base_model.php");

class M_profil extends MY_Model {

    private $table = "fisherman";

    function register($input) {
        $input['password'] = md5($input['password']);
        if ($this->db->insert('fisherman', $input)) {
            return $this->retrieve($this->db->insert_id());
        } else {
            return false;
        }
    }

    function login($input) {
        $this->db->select('id');
        $this->db->where("(email ='" . $input['email'] . "' OR username='" . $input['email'] . "')");
        $this->db->where('password', md5($input['password']));
        if ($this->db->count_all_results('fisherman', false) == 1) {
            return $this->retrieve($this->db->get()->row_array()['id']);
        } else {
            return 'no_data';
        }
    }

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
            return $this->retrieve($input['id']);
        } else {
            return false;
        }
    }

    public function retrieve($id) {
        $this->db->select('id, name, username, email, phone_number, mobile_token, bio, url_photo, total_post, following, followers, created_at, updated_at');
        $this->db->where('id', $id);
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

    public function postinganku($input) {//TODO: db error checking
        $data = array();
        $response = array();
        $paging = 10;
        $this->db->select('id, username, url_photo');
        $this->db->where('id', $input['id']);
        $result = $this->db->get('fisherman')->result_array();
        if (empty($result))
            return 'no_data';
        $result = $result[0];
        if (!empty($result['url_photo'])) {
            $result['url_photo'] = base_url('upload/profil/') . $result['url_photo'];
        }
        $data['user'] = $result;
        $this->db->select('id, caption, created_at');
        $this->db->where('id_fisherman', $data['user']['id']);
//        $this->db->limit($paging, $paging * ($input['page'] - 1));
        $result = $this->db->get('fisherman_post')->result_array();
        if (empty($result))
            return 'no_data';
        $data['post'] = $result;
        for ($i = 0; $i < count($data['post']); $i++) {
            $data['post'][$i]['files'] = array();
            $this->db->select('id_fisherman, created_at');
            $this->db->where('id_fisherman_post', $data['post'][$i]['id']);
            $data['post'][$i]['like'] = $this->db->get('fisherman_post_likes')->result_array();
            $this->db->where('id_fisherman_post', $data['post'][$i]['id']);
            $result = $this->db->get('fisherman_post_files')->result_array();
            foreach ($result as $r) {
                array_push($data['post'][$i]['files'], base_url('upload/post/') . $r['url_file']);
            }
        }
        return $data;
    }

    public function komentar($input) {
        $this->db->set('id_fisherman', $input['id_fisherman']);
        $this->db->set('id_fisherman_post', $input['id_post']);
        $this->db->set('comment', $input['komentar']);
        if ($this->db->insert('fisherman_post_comments')) {
            $this->db->where('id', $this->db->insert_id());
            return $this->db->get('fisherman_post_comments')->row_array();
        } else {
            return false;
        }
    }

    function search($input) {
        $this->db->select('id, name, username');
        $this->db->or_like('name', $input['keyword']);
        $this->db->or_like('username', $input['keyword']);
        return $this->db->get('fisherman')->result_array();
    }

}
