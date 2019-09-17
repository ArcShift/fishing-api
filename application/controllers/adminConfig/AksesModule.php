<?php

class AksesModule extends MY_Controller {

    protected $title = "Akses Module";

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->load->model("m_role");
        $this->load->model("m_module");
        $this->data['roles']=$this->m_role->read();
        $this->data['modules']=$this->m_module->read();
        if($this->input->post()){
            print_r($this->input->post());
        }
        $this->render("adminConfig/aksesModule");
    }

}
