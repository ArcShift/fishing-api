<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Profil extends REST_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function edit_post() {
        echo 'edit';
    }

}
