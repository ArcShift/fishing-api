<?php

class Profil extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
        $this->load->model('m_notifikasi');
    }

    public function edit_post() {//unfinish
        $input = $this->check_param_raw('id', 'username', 'name', 'bio', 'phone_number');
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
        $input = $this->check_param_raw('id', 'password', 'password_lama');
        $callback = $this->model->update_pass($input);
        $this->get_response($callback);
    }

    public function password_baru_post() {
        $input = $this->check_param_raw('id', 'password');
        $callback = $this->model->new_pass($input);
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
        is_array($callback)?$this->m_notifikasi->komentar($input):null;
        $this->get_response($callback);
    }

    public function search_get() {
        $input = $this->check_param_get('keyword');
        $callback = $this->model->search($input);
        $this->get_response($callback);
    }

    public function detail_search_get() {
        $input = $this->check_param_get('id_fisherman', 'id_user');
        $callback = $this->model->detail_search($input);
        $this->get_response($callback);
    }

    public function list_follow_get() {
        $input = $this->check_param_get('id_user');
        $callback = $this->model->list_follow($input);
        $this->get_response($callback);
    }

    public function fisherman_follow_get() {
        $input = $this->check_param_get('id_user', 'id_fisherman');
        $callback = $this->model->list_follow($input);
        $this->get_response($callback);
    }

    public function update_token_post() {
        $input = $this->check_param_raw('id_user', 'mobile_token');
        $callback = $this->model->update_token($input);
        $this->get_response($callback);
    }

}
