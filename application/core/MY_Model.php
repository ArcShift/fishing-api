<?php

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    protected function db_get($data) {
        if ($this->db->error()['code'] == 0) {
            return false;
        }
        $data = $data->result_array();
        if (empty($data)) {
            return 'no_data';
        } else {
            return $data;
        }
    }

    protected function checkQuery() {
        $error = $this->db->error()['message'];
        if (!empty($error)) {
            $data= array();
            $data['message'] = "error";
            $data['data'] = null;
            $data['error'] = $error;
            $this->db->trans_complete();
            die(json_encode($data));
        }else{
            return true;
        }
    }

}
