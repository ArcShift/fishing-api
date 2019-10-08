<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_auth', 'model');
    }

    public function token_get() {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    public function token_post() {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function register_post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        if ($this->model->register($input)) {
            $this->response('Data berhasil ditambahkan', 200);
        } else {
            $this->response($this->db->error()['message'], 400);
        }
    }

    public function login_post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        if ($data = $this->model->login($input)) {
            $this->response($data, 200);
        } else {
            $this->response("user / password salah", 400);
        }
    }

}
