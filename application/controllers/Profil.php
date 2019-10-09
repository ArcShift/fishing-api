<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Profil extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
    }

    public function edit_post() {
        echo 
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response= array();
        print_r($input);
//        print_r($this->input->post());
    }
    public function edit_email_post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response= array();
        if ($this->model->update_email($input)) {
            $response['message'] = 'success';
        } else {
            $response['message'] = 'failed';
            $response['error'] = $this->db->error()['message'];
        }
        $this->response($response, 200);
    }
    public function ubah_password_post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response= array();
        if ($this->model->update_pass($input)) {
            $response['message'] = 'success';
        } else {
            $response['message'] = 'failed';
            $response['error'] = $this->db->error()['message'];
        }
        $this->response($response, 200);
    }
}
