<?php

class Nelayan extends MY_Controller {

    protected $title = "Nelayan";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_nelayan", "model");
//        $this->load->model("m_role");
//        $this->data['roles'] = $this->m_role->read();
//        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->input->post('read')) {//GOTO detail page
            $this->session->set_flashdata("id", $this->input->post('read'));
            redirect("/nelayan/detail");
        }
        $pagination = array(
        "module" => "Nelayan",
        "page" => 1
        );
        if ($pagination["module"] == $this->session->userdata('pagination')["module"]) {
            $pagination = $this->session->userdata('pagination');
            echo "update";
        }else{
            echo "create";
        }

        $this->session->set_userdata('pagination', $pagination);
        $this->data['data'] = $this->model->reads();
        $this->render('nelayan/reads');
    }

    public function detail() {
        if (empty($this->session->flashdata('id'))) {
            redirect('nelayan');
        }
        $this->data['data'] = $this->model->read($this->session->flashdata('id'));
        $this->render('nelayan/read');
    }

}
