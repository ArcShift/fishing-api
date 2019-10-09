<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . "controllers/BaseAPI.php");

class Auth extends BaseAPI {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_auth', 'model');
    }

    public function register_post() {
        $input=$this->check_param('name','username','email', 'password');
        $callback=$this->model->register($input);
        $this->run_query($callback);
    }

    public function login_post() {
        $input=$this->check_param('email', 'password');
        $callback=$this->model->login($input);
        $this->run_query($callback);
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

}
