<?php
class Pengaduan extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('m_pengaduan', 'model');
    }

    public function search_get() {
        $input = $this->check_param_get('id_fisherman', 'val');
        $callback = $this->model->get_search($input['id_fisherman'], $input['val'], 'search');
        $this->get_response($callback);
    }

    public function filter_get() {
        $input = $this->check_param_get('id_fisherman', 'val');
        $input['val'] = strtolower($input['val']);
        $callback = $this->model->get_search($input['id_fisherman'], $input['val'], 'filter');
        $this->get_response($callback);
    }

    public function test_get(){
        echo 'sukses';
    }
}