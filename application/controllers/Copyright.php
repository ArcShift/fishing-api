<?php

class Copyright extends MY_Controller {

    protected $title = "Copyright";

    public function __construct() {
        parent::__construct();
//        $this->load->model("m_", "model");
    }

    public function index() {
        $this->render('copyright');
    }

}
