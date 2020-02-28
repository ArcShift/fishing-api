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
        $this->load->model('m_posting');
        if (is_array($callback)) {
            foreach ($callback as $k=>$c) {
                if (!is_null($c['id_post'])) {
                    $c['post']= $this->m_posting->detail($c['id_post']);
                }
                $callback[$k]=$c;
            }
        }
        $this->get_response($callback);
    }

}
