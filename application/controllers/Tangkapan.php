<?php

class Tangkapan extends MY_Controller {
    protected $module = "tangkapan";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_tangkapan", "model");
    }
    public function index() {
        $this->subTitle= "grafik";
        $this->data['data']=$this->model->jumlah();
        $this->render('tangkapan/grafik');
    }
}
