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

}
