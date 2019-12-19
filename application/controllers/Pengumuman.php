<?php
class Pengumuman extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('m_pengumuman', 'model');
    }
    public function index_get() {
        $callback = $this->model->all();
        $this->get_response($callback);
    }
    public function detail_get() {
        $input = $this->check_param_get('id_announcement');
        $callback = $this->model->detail($input['id_announcement']);
        $this->get_response($callback);
    }

    public function library_get(){
        $path =  $this->config->item('path_dokumen');
        $callback = $this->model->get_library($path);
        $this->get_response($callback);
    }

    public function statistik_get(){
        $input = $this->check_param_get('id_fisherman');
        $callback = $this->model->get_statistik($input['id_fisherman']);
        $this->get_response($callback);
    }
}
