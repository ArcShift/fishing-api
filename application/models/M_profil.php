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
        $this->db->select('f.id, f.name, f.username, f.email, f.phone_number,f.bio, f.url_photo, f.created_at, f.updated_at');
        $this->db->where('f.id', $id);
        if ($this->db->count_all_results('fisherman f', false) == 1) {
            $result = $this->db->get()->row_array();
            $this->db->where('id_fisherman', $id);
            $result['post'] = $this->db->count_all_results('fisherman_post');
            $this->db->where('id_fisherman', $id);
            $result['follower'] = $this->db->count_all_results('fisherman_follow');
            $this->db->where('id_follower', $id);
            $result['following'] = $this->db->count_all_results('fisherman_follow');
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
        $this->db->select('id, name, username, url_photo');
        $this->db->or_like('name', $input['keyword']);
        $this->db->or_like('username', $input['keyword']);
        $result = $this->db->get('fisherman')->result_array();
        foreach ($result as $k => $r) {
            if (!empty($r['url_photo'])) {
                $result[$k]['url_photo'] = base_url('upload/profil/') . $r['url_photo'];
            }
        }
        return $result;
    }

    function detail_search($input) {
        $this->db->select('f.name, f.username, f.email, f.phone_number, f.bio, f.url_photo, f.created_at, ff.id_follower AS follow');
        $this->db->where('f.id', $input['id_fisherman']);
        $this->db->join('fisherman_follow ff', 'ff.id_fisherman= f.id AND ff.id_follower=' . $input['id_user'], 'LEFT');
        $r = $this->db->get('fisherman f')->row_array();
        if (!empty($r)) {
            $r['url_photo'] = empty($r['url_photo']) ? null : base_url('upload/profil/') . $r['url_photo'];
            $r['follow'] = empty($r['follow']) ? false : true;
            $this->db->where('id_fisherman', $input['id_fisherman']);
            $r['follower'] = $this->db->count_all_results('fisherman_follow');
            $this->db->where('id_follower', $input['id_fisherman']);
            $r['following'] = $this->db->count_all_results('fisherman_follow');
            $this->db->select('id, caption, created_at');
            $this->db->where('id_fisherman', $input['id_fisherman']);
            $r['post'] = $this->db->get('fisherman_post')->result_array();
            for ($i = 0; $i < count($r['post']); $i++) {
                $r['post'][$i]['files'] = array();
                $this->db->where('id_fisherman_post', $r['post'][$i]['id']);
                $result = $this->db->get('fisherman_post_files')->result_array();
                $this->db->select('id_fisherman, created_at');
                $this->db->where('id_fisherman_post', $r['post'][$i]['id']);
                $r['post'][$i]['like'] = $this->db->get('fisherman_post_likes')->result_array();
                foreach ($result as $r1) {
                    array_push($r['post'][$i]['files'], base_url('upload/post/') . $r1['url_file']);    
                }
            }
            return $r;
        } else {
            return false;
        }
    }

    function list_follow($input) {
        $data = array();
        $user= isset($input['id_fisherman'])?$input['id_fisherman']:$input['id_user'];
        $this->db->select('f.id, f.name, f.username, f.email, f.url_photo, f2.id_follower AS following');
        $this->db->where('ff.id_fisherman', $user);
        $this->db->join('fisherman f', 'f.id=ff.id_follower');
        $this->db->join('fisherman_follow f2', 'f2.id_follower=' . $input['id_user'] . ' AND f2.id_fisherman= f.id', 'LEFT');
        $data['follower'] = $this->db->get('fisherman_follow ff')->result_array();
        foreach ($data['follower'] as $k => $v) {
            $data['follower'][$k]['url_photo'] = empty($v['url_photo']) ? null : base_url('upload/profil/') . $v['url_photo'];
            $data['follower'][$k]['following'] = empty($v['following']) ? false : true;
        }
        $this->db->select('f.id, f.name, f.username, f.email, f.url_photo');
        $this->db->where('ff.id_follower', $user);
        $this->db->join('fisherman f', 'f.id=ff.id_fisherman');
        $data['following'] = $this->db->get('fisherman_follow ff')->result_array();
        foreach ($data['following'] as $k => $v) {
            $data['following'][$k]['url_photo'] = empty($v['url_photo']) ? null : base_url('upload/profil/') . $v['url_photo'];
        }
        return $data;
    }

}
