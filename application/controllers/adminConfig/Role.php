<?php

class Role extends MY_Controller {

    protected $title = "User Role";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_role", "model");
    }

    public function index() {
        if ($this->input->post("create")) {
           $this->model->create();
        }else if($this->input->post("update")) {
           $this->model->update();
        }
        $this->data['data1'] = $this->model->read();
        $this->render('adminconfig/role');
    }

    public function update() {
        echo "update user";
    }

    public function delete() {
        echo "delete user";
    }

}
