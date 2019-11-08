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
        $callback=$this->model->posting($data);
        $this->get_response($callback);
    }
    public function pengaduan_post() {
        $this->check_param_form('id_fisherman', 'latitude','longitude', 'full_name_location');
        $data=$this->upload_multiple_media('pengaduan');
        $callback=$this->model->pengaduan($data);
        $this->get_response($callback);
    }
    public function fish_get() {
        $callback=$this->model->ikan();
        $this->get_response($callback);
    }

}
