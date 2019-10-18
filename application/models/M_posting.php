<?php

class M_posting extends CI_Model {

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
            $response['message'] = "error";
            $response['data'] = null;
            $response['error'] = $this->db->error()['message'];
        } else {
            $response['message'] = "success";
            $response['data'] = null;
            $response['error'] = null;
        }
        return $response;
    }

    function pengaduan($data) {
        $response = array();
        $post = $this->input->post();
        $this->db->trans_start();
        $this->db->set('id_fisherman', $post['id_fisherman']);
        $this->db->set('latitude', $post['latitude']);
        $this->db->set('longitude', $post['longitude']);
        $this->db->set('full_location_name', $post['full_name_location']);
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
            $response['message'] = "error";
            $response['data'] = null;
            $response['error'] = $this->db->error()['message'];
        } else {
            $response['message'] = "success";
            $response['data'] = null;
            $response['error'] = null;
        }
        return $response;
    }

}
