<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "controllers/BaseAPI.php");

class Profil extends BaseAPI {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
    }

    public function edit_post() {//unfinish
        $input = $this->check_param('id', 'name', 'bio', 'phone_number');
        $callback = $this->model->edit($input);
        $this->get_response($callback);
    }

    public function ubah_foto_post() {
        $input = $this->check_param_form('id');
        $data = $this->upload_media('profil', 'image', $input['id']);
        $callback = $this->model->update_foto($input, $data);
        $this->get_response($callback);
    }

    public function edit_email_post() {
        $input = $this->check_param('id', 'email');
        $callback = $this->model->update_email($input);
        $this->get_response($callback);
    }

    public function ubah_password_post() {
        $input = $this->check_param('id', 'password');
        $callback = $this->model->update_pass($input);
        $this->get_response($callback);
    }

    public function postinganku_get() {
        $input = $this->check_param('id');
        $callback = $this->model->postinganku($input);
        $this->get_response($callback);
    }

}
