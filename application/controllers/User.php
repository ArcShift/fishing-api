<?php

class User extends MY_Controller {

    protected $title = "User";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_user", "model");
    }

    public function data() {
        $this->data['data1'] = $this->model->read();
        $this->render('user/list');
    }

    public function create() {
        echo "create user";
    }

    public function detail() {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        if ($this->input->post("changePass")) {
            $this->form_validation->set_rules('pass', 'Password Lama', 'required|callback_check_pass');
            $this->form_validation->set_rules('newPass', 'Password Baru', 'required');
            $this->form_validation->set_rules('confirmPass', 'Konfirmasi Password', 'required|matches[newPass]');
            if ($this->form_validation->run()) {
                if (!$this->model->gantiPassword()) {
                    echo "gagal mengganti password";
                }
            }
        } elseif ($this->input->post("saveData")) {
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            if ($this->form_validation->run()) {
                if (!$this->model->updateData()) {
                    echo "gagal update data";
                } else {
                    if ($this->input->post("id") === $this->session->userId) {
                        $this->session->set_userdata("user", $this->input->post("nama"));
                    }
                }
            }
        }
        $this->title = "User - Detail";
        $this->data['data1'] = $this->model->detail();
        $this->render('user/detail');
    }

    function check_pass() {
        $this->load->model("m_login");
        if ($this->model->checkPass()) {
            return true;
        } else {
            $this->form_validation->set_message('check_pass', '{field} tidak sama');
            return false;
        }
    }

}
