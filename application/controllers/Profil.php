<?php

class Profil extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
    }

    public function edit_post() {//unfinish
        $input = $this->check_param_raw('id', 'name', 'bio', 'phone_number');
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
        $input = $this->check_param_raw('id', 'email');
        $callback = $this->model->update_email($input);
        $this->get_response($callback);
    }

    public function ubah_password_post() {
        $input = $this->check_param_raw('id', 'password');
        $callback = $this->model->update_pass($input);
        $this->get_response($callback);
    }

    public function postinganku_get() {
        $input = $this->check_param_get('id');
        $callback = $this->model->postinganku($input);
        $this->get_response($callback);
    }

    public function komentar_post() {
        $input = $this->check_param_raw('id_fisherman', 'id_post', 'komentar');
        $callback = $this->model->komentar($input);
        $this->get_response($callback);
    }

    public function search_get() {
        $input = $this->check_param_get('keyword');
        $callback = $this->model->search($input);
        $this->get_response($callback);
    }

}
