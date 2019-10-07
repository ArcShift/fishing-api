<?php

class M_auth extends CI_Model {

    function register($input) {
        $input['password']= md5($input['password']);
        if ($this->db->insert('fisherman', $input)) {
            echo 'Data berhasil ditambahkan';
        } else {
            echo $this->db->_error_message();
        }
    }
    function login($input) {
        $this->db->where('email', $input['email']);
        $this->db->where('password', md5($input['password']));
        if($this->db->count_all_results('fisherman',false)==1){
            echo json_encode($this->db->get()->result_array()[0]);
        }else{
            echo 'email / password salah';
        }
    }

}
