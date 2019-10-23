<?php

require_once(APPPATH . "models/Base_model.php");

class M_profil extends Base_model {

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

    public function postinganku($input) {
        $data = array();
        $paging = 10;
        $this->db->select('fp.id, fp.caption, fpf.url_file, fp.created_at, f.id AS id_fisherman, f.username, f.url_photo');
        $this->db->where('id_fisherman', $input['id']);
        $this->db->join('fisherman_post fp', 'fp.id = fpf.id_fisherman_post');
        $this->db->join('fisherman f', 'f.id = fp.id_fisherman');
        $this->db->limit($paging, $paging * ($input['page'] - 1));
        $result = $this->db->get('fisherman_post_files fpf')->result_array();
        die($this->db->last_query());
        if (empty($result)) {
            return 'no_data';
        } else {
            foreach ($result as $r) {
                $data[$r['id']] = array();
                $data[$r['id']]['file'] = array();
            }
            foreach ($result as $r) {
                $data[$r['id']]['caption'] = $r['caption'];
                $data[$r['id']]['created_at'] = $r['created_at'];
                $data[$r['id']]['loves'] = null;
                $data[$r['id']]['user'] = array(
                    'id_user' => $r['id_fisherman'],
                    'username' => $r['username'],
                    'url_photo' => base_url('upload/profil/') . $r['url_photo'],
                );
                array_push($data[$r['id']]['file'], base_url('upload/post/') . $r['url_file']);
            }
            $data2 = array();
            foreach ($data as $k => $d) {
                $d['id_post'] = $k;
                array_push($data2, $d);
            }
            return $data2;
        }
    }

    public function postinganku2($input) {//TODO: db error checking
        $data = array();
        $response = array();
        $paging = 10;
        $this->db->select('id, username, url_photo');
        $this->db->where('id', $input['id']);
        $result = $this->db->get('fisherman')->result_array();
        if (empty($result))
            return 'no_data';
        $result = $result[0];
        $result['url_photo'] = base_url('upload/profil/') . $result['url_photo'];
        $data['user'] = $result;
        $this->db->select('id, caption, created_at');
        $this->db->where('id_fisherman', $data['user']['id']);
        $this->db->limit($paging, $paging * ($input['page'] - 1));
        $result = $this->db->get('fisherman_post')->result_array();
        if (empty($result))
            return 'no_data';
        $data['post'] = $result;
        for ($i = 0; $i < count($data['post']); $i++) {
            $data['post'][$i]['files'] = array();
            $data['post'][$i]['like'] = array();
            $this->db->where('id_fisherman_post', $data['post'][$i]['id']);
            $result = $this->db->get('fisherman_post_files')->result_array();
            foreach ($result as $r) {
                array_push($data['post'][$i]['files'], base_url('upload/post/') .$r['url_file']);
            }
            //TODO: LIST LIKE
        }
        return $data;
    }

}
