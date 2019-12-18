<?php

class Map extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_map', 'model');
    }
    public function pengaduan_get() {
        $callback = $this->model->pengaduan();
        $this->get_response($callback);
    }

}
