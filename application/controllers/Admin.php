<?php

class Admin extends MY_Controller {

    protected $title = "User";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_admin", "model");
        $this->load->library('form_validation');
    }

    public function index() {
        $this->data['data1'] = $this->model->read();
        $this->render('admin/list');
    }

    public function create() {
        $this->title = "Create User";
        if ($this->input->post('create')) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.nama]');
            $this->form_validation->set_rules('pass', 'Password', 'required');
            $this->form_validation->set_rules('passConfirm', 'Ulangi Password', 'required|matches[pass]');
            if ($this->form_validation->run()) {
                if ($this->model->create()) {
                    $this->session->set_flashdata('msgSuccess','Data berhasil disimpan');
                    redirect(site_url('admin'));
//                    $this->render("admin/list");
                    return;
                } else {
                    $this->session->set_flashdata('msgError','Insert data gagal');
                }
            } else {
                echo "validasi gagal";
            }
        }
        $this->load->model("m_role");
        $this->data['roles'] = $this->m_role->read();
        $this->render("admin/create");
    }

    public function detail() {
        $this->load->helper(array('form', 'url'));
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
        $this->render('admin/detail');
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
