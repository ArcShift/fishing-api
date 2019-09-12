<?php

class Dashboard extends MY_Controller {
    protected $title="Dashboard";

    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->render('dashboard');
    }
}
