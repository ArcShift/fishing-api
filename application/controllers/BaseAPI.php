<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class BaseAPI extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    protected function check_param(...$param) {
        $input = json_decode(file_get_contents('php://input'), TRUE);
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

    protected function check_param_form(...$param) {
        $input = $this->input->post();
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

    protected function run_query($callback) {
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
        }
        $this->response($response, 200);
    }

    protected function upload_media($folder, $type = null, $filename = null) {
        $response = array();
        $root = $_SERVER['DOCUMENT_ROOT'];
        $config['upload_path'] = $root . '/fishing/upload/' . $folder;
        if ($type == 'image') {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
        } else {
            $config['allowed_types'] = 'gif|jpg|png|jpeg|mp4|3gp';
        }
        if (isset($filename)) {
            $config['file_name'] = $filename;
            $config['overwrite'] = true;
        }
        $config['max_size'] = 500000;
        $config['max_width'] = 10000;
        $config['max_height'] = 10000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('media')) {
            $response['message'] = 'error';
            $response['data'] = null;
            $response['error'] = $this->upload->display_errors();
        } else {
            $data = array('upload_data' => $this->upload->data());
            $response['message'] = 'success';
            $response['data'] = null;
            $response['error'] = null;
        }
        return $response;
    }

}
