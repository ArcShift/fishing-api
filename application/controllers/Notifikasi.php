<?php

class Notifikasi extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_notifikasi', 'model');
    }

    function pengaduan_get() {
        $input = $this->check_param_get('id_user');
        $callback = $this->model->pengaduan($input['id_user']);
        $this->get_response($callback);
    }

    function sosial_media_get() {
        $input = $this->check_param_get('id_user');
        $callback = $this->model->sosial_media($input);
        $this->get_response($callback);
    }

    function detail_post_get() {
        $input = $this->check_param_get('id_post');
        $callback = $this->model->detail_post($input['id_post']);
        $this->get_response($callback);
    }

}
