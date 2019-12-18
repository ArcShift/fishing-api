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
}
