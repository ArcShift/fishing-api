<?php

class Base_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    protected function db_get($data) {
        if($this->db->error()['code']==0){
            return false;
        }        
        $data=$data->result_array();
        if (empty($data)) {
            return 'no_data';
        }else{
            return $data;
        }
        
    }

}
