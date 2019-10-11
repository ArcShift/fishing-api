<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "controllers/BaseAPI.php");

class Posting extends BaseAPI {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_posting', 'model');
    }

    public function index_post() {
        $this->check_param_form('id', 'caption');
        $data=$this->upload_multiple_media('post');
        $response=$this->model->posting($data);
        $this->response($response, 200);
    }
    public function pengaduan_post() {
        $this->check_param_form('id_fisherman', 'latitude','longitude', 'full_name_location');
        $data=$this->upload_multiple_media('pengaduan');
        $response=$this->model->pengaduan($data);
        $this->response($response, 200);
    }

}
