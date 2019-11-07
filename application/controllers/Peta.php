<?php

class Peta extends MY_Controller {

    protected $module = "peta";

    public function __construct() {
        parent::__construct();
//        $this->load->model("m_admin", "model");
//        $this->load->model("m_role");
//        $this->data['roles'] = $this->m_role->read();
//        $this->load->library('form_validation');
    }
    public function index() {
        $this->render('peta');
    }

}
