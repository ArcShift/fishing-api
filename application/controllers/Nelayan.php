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
//        $this->session->unset_userdata('pagination');
        if ($this->input->post('read')) {//GOTO detail page
            $this->session->set_flashdata("id", $this->input->post('read'));
            redirect("/nelayan/detail");
        }
        $pagination = array(
            "module" => "Nelayan",
            "view" => "list", //list, thumnail
            "page" => 1,
        );
        if ($pagination["module"] == $this->session->userdata('pagination')["module"]) {
            $pagination = $this->session->userdata('pagination');
//            echo "update";
        } else {
//            echo "create";
        }
        if ($this->input->post('page')) {
            $pagination['page'] = $this->input->post('page');
        }
        if ($this->input->post('view')) {
            $pagination['view'] = $this->input->post('view');
        }
        $this->session->set_userdata('pagination', $pagination);
        $this->data['pagination'] = $pagination;
        $result = $this->model->reads($pagination['page']);
        $this->data['dataCount'] = $result['count'];
        $this->data['data'] = $result['data'];
        if ($pagination['view'] === 'list') {
            $this->render('nelayan/reads');
        } else {
            $this->render('nelayan/reads_thumnail');
        }
    }

    public function detail() {
        if (empty($this->session->flashdata('id'))) {
            redirect('nelayan');
        }
        $this->data['data'] = $this->model->read($this->session->flashdata('id'));
        $this->render('nelayan/read');
    }

}
