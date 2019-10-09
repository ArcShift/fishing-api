<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class BaseAPI extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    protected function check_param(...$param) {
        $input = json_decode(file_get_contents('php://input'), TRUE);
        $response = array();
        foreach ($param as $p) {
            if (!isset($input[$p])) {
                $response['message'] = 'error';
                $response['data'] = null;
                $response['error'] = 'wrong_parameter';
                $this->response($response, 200);
            }
        }
        return $input;
    }

    protected function run_query($callback) {
        $response = array();
        if ($callback) {
            if ($callback === "no_data") {
                $response['message'] = $callback;
                $response['data'] = null;
                $response['error'] = null;
            } else {
                $response['message'] = 'success';
                $response['data'] = $callback;
                $response['error'] = null;
            }
        } else {
            $response['message'] = "error";
            $response['data'] = null;
            $response['error'] = $this->db->error()['message'];
        }
        $this->response($response, 200);
    }

}
