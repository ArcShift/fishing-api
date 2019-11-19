<?php

class Posting extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_posting', 'model');
    }

    public function index_post() {
        $this->check_param_form('id', 'caption');
        $data = $this->upload_multiple_media('post');
        $callback = $this->model->posting($data);
        $this->get_response($callback);
    }

    public function pengaduan_post() {
        $this->check_param_form('id_fisherman', 'latitude', 'longitude', 'full_name_location');
        $data = $this->upload_multiple_media('pengaduan');
        $callback = $this->model->pengaduan($data);
        $this->get_response($callback);
    }

    public function fish_get() {
        $callback = $this->model->ikan();
        $this->get_response($callback);
    }

    public function tangkapan_post() {
        $this->check_param_form('id_fisherman', 'id_fish', 'total_weight', 'date', 'time', 'latitude', 'longitude', 'description');
        $data = $this->upload_multiple_media('tangkapan');
        $callback = $this->model->tangkapan($data);
        $this->get_response($callback);
    }

    public function detail_get() {
        $input = $this->check_param_get('id', 'page');
        $callback = $this->model->detail($input);
        $this->get_response($callback);
    }
    public function riwayat_tangkapan_get() {
        $input = $this->check_param_get('id', 'page');
        $callback = $this->model->riwayat_tangkapan($input);
        $this->get_response($callback);
    }
}
