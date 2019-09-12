<?php

class MY_Controller extends CI_Controller {

    protected $title = null;
    protected $data = array();

    public function __construct() {
        parent::__construct();
        if (!$this->session->has_userdata('user')) {
            redirect('login');
        }
        $this->load->model("m_module", "module");
    }

    protected function render($view) {
        $this->data['title'] = $this->title;
        $this->data['view'] = $view;
        $this->data['module'] = $this->session->userdata('menu');
        $this->load->view('container/admin', $this->data);
    }

}
