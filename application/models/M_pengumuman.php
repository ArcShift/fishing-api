<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pengaduan
 *
 * @author Jelajah Tekno Indone
 */
class M_pengumuman extends MY_Model {

    function all() {
        $this->db->select('id, title');
        return $this->db->get('announcement')->result_array();
    }

}
