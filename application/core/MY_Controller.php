<?php

class MY_Controller extends CI_Controller {

    protected $title = null;
    protected $subTitle = null;
    protected $data = array();

    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('user')) {
            redirect('login');
        }
        $this->load->model("m_module", "module");
        $this->load->model("base_model", "b_model");
    }

    protected function render($view) {
        $this->data['title'] = $this->title;
        $this->data['subTitle'] = $this->subTitle;
        $this->data['view'] = $view;
        $this->data['module'] = $this->title;
        $this->load->view('template/container', $this->data);
    }

    protected function reads() {
        $this->subTitle = "List";
        if ($this->input->post('read')) {
            $this->session->set_flashdata('id', $this->input->post('read'));
            redirect('/' . $this->title . '/detail');
        }
        if ($this->input->post('edit')) {
            $this->session->set_flashdata('id', $this->input->post('edit'));
            redirect('/' . $this->title . '/edit');
        }
        if ($this->input->post('initDelete')) {
            $this->session->set_flashdata('id', $this->input->post('initDelete'));
            redirect('/' . $this->title . '/delete');
        }
        $pagination = array(
            "module" => $this->title,
            "page" => 1,
        );
        if ($pagination["module"] == $this->session->userdata('pagination')["module"]) {
            $pagination = $this->session->userdata('pagination');
        }
        if ($this->input->post('page')) {
            $pagination['page'] = $this->input->post('page');
        } else if ($this->input->post('cari')) {
            $pagination['page'] = 1;
        }
        $this->session->set_userdata('pagination', $pagination);
        $this->data['pagination'] = $pagination;
        $result = $this->b_model->reads($pagination['page'], $this->data);
        $this->data['dataCount'] = $result['count'];
        $this->data['data'] = $result['data'];
        $this->render('template/reads');
    }

    protected function delete() {
        $this->subTitle = "Delete";
        $this->render('template/delete');
    }

}
