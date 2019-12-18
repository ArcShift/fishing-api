<?php

class Map extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_map', 'model');
    }

    public function tangkapan_get() {
        $callback = $this->model->tangkapan();
        $this->get_response($callback);
    }

}
