<?php

class Posting extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_posting', 'model');
        $this->load->model('m_notifikasi');
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
        $input = $this->check_param_get('id');
        $callback = $this->model->detail($input);
        $this->get_response($callback);
    }

    public function riwayat_tangkapan_get() {
        $input = $this->check_param_get('id', 'page');
        $callback = $this->model->riwayat_tangkapan($input);
        $this->get_response($callback);
    }

    public function detail_riwayat_tangkapan_get() {
        $input = $this->check_param_get('id');
        $callback = $this->model->detail_riwayat_tangkapan($input['id']);
        $this->get_response($callback);
    }

    public function pengaduan_get() {
        $input = $this->check_param_get('id', 'page');
        $callback = $this->model->get_pengaduan($input);
        $this->get_response($callback);
    }

    public function detail_pengaduan_get() {
        $input = $this->check_param_get('id');
        $callback = $this->model->detail_pengaduan($input['id']);
        $this->get_response($callback);
    }

    public function like_post() {
        $input = $this->check_param_raw('id_post', 'id_fisherman');
        $callback = $this->model->like($input);
        $callback == 'like' ? $this->m_notifikasi->like($input) : null;
        $this->get_response($callback);
    }

    public function follow_post() {
        $input = $this->check_param_raw('id_fisherman', 'id_follower');
        $callback = $this->model->follow($input);
        if($callback == 'follow'){
            if(!$this->m_notifikasi->follow($input)){
                $callback= false;
            }
        }
        $this->get_response($callback);
    }

    public function explore_get() {//paging?
        $input = $this->check_param_get('id_fisherman');
        $callback = $this->model->explore($input);
        $this->get_response($callback);
    }

}
