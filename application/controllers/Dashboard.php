<?php

class Dashboard extends MY_Controller {
    protected $title="Dashboard";

    public function __construct() {
        parent::__construct();
        $this->load->model('M_dashboard','model');
    }
    public function index() {
        $this->data['countAdmin']= $this->model->countAdmin();
        $this->data['countFisherman']= $this->model->countFisherman();
        $this->data['countFish']= $this->model->countFish();
        $this->data['countPengaduan']= $this->model->countPengaduan();
        $this->render('dashboard');
    }
}
