<?php

class Admin extends MY_Controller {

    protected $title = "Admin";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_admin", "model");
        $this->load->model("m_role");
        $this->data['roles'] = $this->m_role->read();
        $this->load->library('form_validation');
    }

    public function index() {
        if ($this->input->post('initDelete')) {
            $this->session->set_flashdata('id', $this->input->post('initDelete'));
            redirect('/admin/delete');
        }
        $this->data['data1'] = $this->model->read();
        $this->render('admin/list');
    }

    public function create() {
        $this->title = "Admin - Create";
        if ($this->input->post('create')) {
            $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.nama]');
            $this->form_validation->set_rules('pass', 'Password', 'required');
            $this->form_validation->set_rules('passConfirm', 'Ulangi Password', 'required|matches[pass]');
            if ($this->form_validation->run()) {
                if ($this->model->create()) {
                    $this->session->set_flashdata('msgSuccess', 'Data berhasil disimpan');
                    redirect('/admin');
                    return;
                } else {
                    $this->session->set_flashdata('msgError', 'Insert data gagal');
                }
            } else {
                $this->session->set_flashdata('msgError', 'Validasi gagal');
            }
        }
        $this->render("admin/create");
    }

    public function profile() {
        $this->load->helper(array('form', 'url'));
        if ($this->input->post("changePass")) {
            $this->form_validation->set_rules('pass', 'Password Lama', 'required|callback_check_pass');
            $this->form_validation->set_rules('newPass', 'Password Baru', 'required');
            $this->form_validation->set_rules('confirmPass', 'Konfirmasi Password', 'required|matches[newPass]');
            if ($this->form_validation->run()) {
                if ($this->model->gantiPassword()) {
                    $this->session->set_flashdata('msgSuccess', 'Password berhasil diganti');
                } else {
                    $this->session->set_flashdata('msgError', 'Gagal mengganti password');
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
                        $this->session->set_flashdata('msgSuccess', 'Data berhasil diupdate');
                    }
                }
            }
        }
        $this->title = "Admin - Profil";
        $this->data['data1'] = $this->model->detail($this->session->userId);
        $this->render('admin/detail');
    }

    public function delete() {
        $this->title = "Admin - Delete";
        if (!empty($this->session->flashdata('id'))) {
            $this->data['data'] = $this->model->detail($this->session->flashdata('id'));
        } elseif ($this->input->post('delete')) {
            $id = $this->input->post('delete');
            if ($id == $this->session->userId) {
                $this->session->set_flashdata('msgError', 'Tidak bisa menghapus data anda sendiri');
            } elseif ($this->model->delete($id)) {
                $this->session->set_flashdata('msgSuccess', 'Berhasil menghapus data');
                redirect('admin');
            } else {
                $this->session->set_flashdata('msgError', 'Gagal menghapus data');
                $this->data['data'] = $this->model->detail($id);
            }
        } else {
            redirect('/admin');
        }
        $this->render("admin/delete");
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
