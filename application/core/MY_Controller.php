<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . '/libraries/REST_Controller.php');

class MY_Controller extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil');
        $this->load->library('session');
    }

    protected function check_param($param, $input) {
        $response = array();
        foreach ($param as $p) {
            if (!isset($input[$p])) {
                $response['message'] = 'error';
                $response['data'] = null;
                $response['error'] = 'wrong_parameter';
                $this->response($response, 200);
            }
        }
        return $input;
    }

    protected function check_param_raw(...$param) {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        return $this->check_param($param, $input);
    }

    protected function check_param_form(...$param) {
        $input = $this->input->post();
        return $this->check_param($param, $input);
    }

    protected function check_param_get(...$param) {
        $input = $this->input->get();
        return $this->check_param($param, $input);
    }

    protected function get_response($callback) {
        $response = array();
        if ($callback) {
            if ($callback === "no_data") {
                $response['message'] = $callback;
                $response['data'] = null;
                $response['error'] = null;
            } else {
                $response['message'] = 'success';
                $response['data'] = $callback;
                $response['error'] = null;
            }
        } else {
            $response['message'] = "error";
            $response['data'] = null;
            $response['error'] = $this->db->error()['message'];
            if (empty($response['error'])) {
                $response['error'] = $this->session->flashdata('error');
            }
        }
        $this->response($response, 200);
    }

    protected function get_user($id) {
        if (!empty($id)) {
            $callback = $this->m_profil->retrieve($id);
        }
        $this->get_response($callback);
    }

    protected function upload_media($folder, $type = null, $filename = null) {
        $response = array();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $config['upload_path'] = $this->config->item('upload_path') . $folder;
        if ($type == 'image') {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
        }
        if (isset($filename)) {
            $config['file_name'] = $filename;
            $config['overwrite'] = true;
        }
        $config['max_size'] = 5000000000000;
        $config['max_width'] = 10000;
        $config['max_height'] = 10000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('media')) {
            $response['message'] = 'error';
            $response['data'] = null;
            $response['error'] = $this->upload->display_errors();
            $this->response($response, 200);
        } else {
            return $this->upload->data();
        }
    }

    public function upload_multiple_media($folder) {
        $response = array();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $config['upload_path'] = $this->config->item('upload_path') . $folder;
        $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4';
        $this->load->library('upload', $config);
        $data = array();
        for ($i = 0; $i < count($_FILES['media']['name']); $i++) {
            $_FILES['file']['name'] = $_FILES['media']['name'][$i];
            $_FILES['file']['type'] = $_FILES['media']['type'][$i];
            $_FILES['file']['tmp_name'] = $_FILES['media']['tmp_name'][$i];
            $_FILES['file']['error'] = $_FILES['media']['error'][$i];
            $_FILES['file']['size'] = $_FILES['media']['size'][$i];
            if (!$this->upload->do_upload('file')) {
                $response['message'] = 'error';
                $response['data'] = null;
                $response['error'] = $this->upload->display_errors();
                $this->response($response, 200);
            } else {
                $data[$i] = $this->upload->data();
            }
        }
        return $data;
    }

    function send_notification($userId, $title, $message) {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $headers = array(
            //authorizationkey : kunci server cloud messaging -> cara mendapatkannya pergi console.firebase.google.com
            'Authorization:key = AAAAjkAyl2g:APA91bENJ2Vo6pP4-wGu4GykBFhEf31bxyqAI7iZYTpohEX_Q9QQMM0-qaZ_--OJnWIercO69LBR2ij3huXkmG4QaOqzJEL_djSHGTZvfwdKS9LZeF4xPnLMbXa5qv-H2klLe7WMyur6',
            'Content-Type: application/json'
        );
        //yang akan tampil di notifikasi android
        $notification = array(
            'title' => $title,
            'body' => $message,
            'click_action' => 'FLUTTER_NOTIFICATION_CLICK',
            'sound' => "default"
        );
        //bisa digunakan untuk membawa data dari database, seperti membawa parameter user_id
        $data = array(
            'data_1' => "data_1",
            'data_2' => "data_2",
            'data_3' => "data_3",
            'data_4' => "data_4"
        );
        $this->db->where('id',$userId);
        $result=$this->db->get('fisherman')->row_array();
//        die(print_r($result));
        $fields = array(
            // to : adalah token firebase tujuan untuk hp android yang akan dikirimkan notifikasi
            'to' => $result['mobile_token'],
            'priority' => 'high',
            'notification' => $notification,
            'data' => $data
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
//        die('gagal');
        if ($result === FALSE) {
            return 'Curl failed: ' . curl_error($ch);
        } else {
            return TRUE;
        }
//        curl_close($ch);
    }

}
