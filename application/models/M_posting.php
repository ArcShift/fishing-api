<?php

class M_posting extends MY_Model {

    var $paging = 10;

    function posting($data) {
        $response = array();
        $post = $this->input->post();
        $this->db->trans_start();
        $this->db->set('id_fisherman', $post['id']);
        $this->db->set('caption', $post['caption']);
        $this->db->insert('fisherman_post');
        $id_post = $this->db->insert_id();
        foreach ($data as $d) {
            $this->db->set('id_fisherman_post', $id_post);
            $this->db->set('url_file', $d['file_name']);
            $this->db->set('file_type', $d['file_type']);
            $this->db->insert('fisherman_post_files');
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() == FALSE) {
            return false;
        } else {
            $this->db->where('id_fisherman', $post['id']);
            return array('jumlah' => $this->db->count_all_results('fisherman_post'));
        }
    }

    function pengaduan($data) {//ERROR NOT WORK
        $response = array();
        $post = $this->input->post();
        $this->db->trans_start();
        $this->db->set('id_fisherman', $post['id_fisherman']);
        $this->db->set('latitude', $post['latitude']);
        $this->db->set('longitude', $post['longitude']);
        $this->db->set('full_location_name', $post['full_name_location']);
        $this->db->set('description', $post['description']);
        $this->db->set('title', $post['title']);
        $this->db->insert('fisherman_complaintment');
        $id_post = $this->db->insert_id();
        foreach ($data as $d) {
            $this->db->set('id_fisherman_complaintment', $id_post);
            $this->db->set('url_file', $d['file_name']);
            $this->db->set('file_type', $d['file_type']);
            $this->db->insert('fisherman_complaintment_files');
        }
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            $this->db->where('id_fisherman', $post['id_fisherman']);
            return array('jumlah' => $this->db->count_all_results('fisherman_complaintment'));
        }
    }

    function ikan() {
        $this->db->select('id, name, about_fish');
        return $this->db->get('fish')->result_array();
    }

    function tangkapan($data) {
        $post = $this->input->post();
        $this->db->trans_start();
        $this->db->set('id_fisherman', $post['id_fisherman']);
        $this->db->set('id_fish', $post['id_fish']);
        $this->db->set('total_weight', $post['total_weight']);
        $this->db->set('date', $post['date']);
        $this->db->set('time', $post['time']);
        $this->db->set('latitude', $post['latitude']);
        $this->db->set('longitude', $post['longitude']);
        $this->db->set('description', $post['description']);
        $this->db->insert('fisherman_log_catch_fish');
        $this->checkQuery();
        $id_post = $this->db->insert_id();
        foreach ($data as $d) {
            $this->db->set('id_fisherman_log_catch_fish', $id_post);
            $this->db->set('url_file', $d['file_name']);
            $this->db->set('file_type', $d['file_type']);
            $this->db->insert('fisherman_log_catch_fish_files');
            $this->checkQuery();
        }
        $this->db->trans_complete();
        return true;
    }

    function detail($input) {
        $this->db->where('id', $input['id']);
        $data = $this->db->get('fisherman_post')->row_array();
        if (empty($data)) {
            return 'no_data';
        }
        $this->db->select('fpc.*, f.username, CONCAT("' . base_url('upload/profil/') . '", f.url_photo) AS photo');
        $this->db->join('fisherman f', 'f.id=fpc.id_fisherman');
        $this->db->where('id_fisherman_post', $input['id']);
        $data['komentar'] = $this->db->get('fisherman_post_comments fpc')->result_array();
//        die ($this->db->last_query());
        return $data;
    }

    function riwayat_tangkapan($input) {
        $this->db->select('c.*, f.name AS fish_name');
        $this->db->where('c.id_fisherman', $input['id']);
        $this->db->limit($this->paging, $this->paging * ($input['page'] - 1));
        $this->db->join('fish f', 'f.id=c.id_fish');
        $data = $this->db->get('fisherman_log_catch_fish c')->result_array();
        if (empty($data)) {
            return 'no_data';
        } else {
            return $data;
        }
    }

    function detail_riwayat_tangkapan($id) {
        $this->db->select('c.*, f.name AS fish_name, f.about_fish');
        $this->db->where('c.id', $id);
        $this->db->join('fish f', 'f.id=c.id_fish');
        $data = $this->db->get('fisherman_log_catch_fish c')->row_array();
        if (empty($data)) {
            return 'no_data';
        }
        $this->db->where('id_fisherman_log_catch_fish', $id);
        $data['files'] = $this->db->get('fisherman_log_catch_fish_files')->result_array();
        for ($i = 0; $i < count($data['files']); $i++) {
            $data['files'][$i]['url_file'] = base_url('upload/tangkapan/') . $data['files'][$i]['url_file'];
        }
        return $data;
    }

    function get_pengaduan($input) {
        $this->db->where('id_fisherman', $input['id']);
        $this->db->limit($this->paging, $this->paging * ($input['page'] - 1));
        $data = $this->db->get('fisherman_complaintment')->result_array();
        if (empty($data)) {
            return 'no_data';
        } else {
            return $data;
        }
    }

    function detail_pengaduan($id) {
        $this->db->where('id', $id);
        $data = $this->db->get('fisherman_complaintment')->row_array();
        if (empty($data)) {
            return 'no_data';
        }
        $this->db->where('id_fisherman_complaintment', $id);
        $data['files'] = $this->db->get('fisherman_complaintment_files')->result_array();
        for ($i = 0; $i < count($data['files']); $i++) {
            $data['files'][$i]['url_file'] = base_url('upload/pengaduan/') . $data['files'][$i]['url_file'];
        }
        return $data;
    }

    function like($input) {
        $this->db->where('id_fisherman', $input['id_fisherman']);
        $this->db->where('id_fisherman_post', $input['id_post']);
        $data = $this->db->get('fisherman_post_likes')->row_array();
        if (empty($data)) {
            $this->db->set('id_fisherman', $input['id_fisherman']);
            $this->db->set('id_fisherman_post', $input['id_post']);
            $result = $this->db->insert('fisherman_post_likes');
            if ($result != false) {
                return 'like';
            } else {
                return false;
            }
        } else {
            $this->db->where('id_fisherman', $input['id_fisherman']);
            $this->db->where('id_fisherman_post', $input['id_post']);
            $result = $this->db->delete('fisherman_post_likes');
            if ($result != false) {
                return 'unlike';
            } else {
                return false;
            }
        }
    }

    function follow($input) {//follow/unfollow
        $this->db->where('id_fisherman', $input['id_fisherman']);
        $this->db->where('id_follower', $input['id_follower']);
        $result = $this->db->get('fisherman_follow')->row_array();
        if (empty($result)) {
            $this->db->set('id_fisherman', $input['id_fisherman']);
            $this->db->set('id_follower', $input['id_follower']);
            $result = $this->db->insert('fisherman_follow');
            if ($result != false) {
                return 'follow';
            }
        } else {
            $this->db->where('id_fisherman', $input['id_fisherman']);
            $this->db->where('id_follower', $input['id_follower']);
            $result = $this->db->delete('fisherman_follow');
            if ($result != false) {
                return 'unfollow';
            }
        }
        return false;
    }

    function explore($input) {
        $this->db->select('p.*');
        $this->db->where('f.id_follower', $input['id_fisherman']);
        $this->db->join('fisherman_follow f', 'f.id_fisherman=p.id_fisherman');
        $this->db->order_by('created_at', 'DESC');
        $data = $this->db->get('fisherman_post p')->result_array();
        if (empty($data)) {
            return 'no_data';
        } else {
            foreach ($data as $k => $d) {
                $data[$k]['file'] = array();
                $this->db->select('url_file');
                $this->db->where('id_fisherman_post', $d['id']);
                $result = $this->db->get('fisherman_post_files')->result_array();
                foreach ($result as $r) {
                    array_push($data[$k]['file'], $r['url_file']);
                }
            }
            return $data;
        }
    }

}
