<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "controllers/BaseAPI.php");

class Posting extends BaseAPI {

    public function __construct() {
        parent::__construct();
//        $this->load->model('m_profil', 'model');
    }

    public function posting_post() {
//        $input = json_decode(file_get_contents('php://input'), TRUE);
//        print_r($input);
//        print_r($this->input->post());
//        print_r($_FILES);
    }

}
