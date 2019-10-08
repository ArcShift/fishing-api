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
        $response= array();
        if ($data=$this->model->register($input)) {
            $response['message']='Data berhasil ditambahkan';
            $response['data']=$data;
            $this->response($response, 200);
        } else {
            $response['message']=$this->db->error()['message'];
            $response['data']=null;
            $this->response($response, 400);
        }
    }

    public function login_post() {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response= array();
        if ($data = $this->model->login($input)) {
            $response['message']='success';
            $response['data']=$data;
            $response['trace']=$this->db->last_query();
            $this->response($response, 200);
        } else {
            $response['message']="user_password salah";
            $response['data']=null;
            $this->response($response, 400);
        }
    }

}
