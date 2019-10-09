<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "controllers/BaseAPI.php");

class Profil extends BaseAPI {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
    }

    public function edit_post() {//unfinish 
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response = array();
        print_r($input);
//        print_r($this->input->post());
    }

    public function edit_email_post() {
        $input = $this->check_param('id','email');
        $callback=$this->model->update_email($input);
        $this->run_query($callback);
    }

    public function ubah_password_post() {
        $input = $this->check_param('id','password');
        $callback=$this->model->update_pass($input);
        $this->run_query($callback);
    }

}
