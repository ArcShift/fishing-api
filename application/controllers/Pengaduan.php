<?php

class Pengaduan extends MY_Controller {

    protected $title = "pengaduan";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_pengaduan", "model");
    }

    public function index() {
        $this->data['filter'] = array("nelayan", 'keterangan');
        $this->data['table'] = "fisherman_complaintment fc";
        $this->data['join'] = array(
            array("table" => "fisherman f", "relation" => "f.id = fc.id_fisherman"),
        );
        $this->data['column'] = array(
            array("title" => "nelayan", "field" => "f.name"),
            array("title" => "keterangan", "field" => "fc.description"),
            array("title" => "latitude", "field" => "fc.latitude"),
        );
        $this->data['crud']=array('create','read','update','delete');
        parent::reads();
    }
    public function detail() {
        $this->subTitle='Detail';
        $this->data['data']= $this->model->read();
        $this->render('pengaduan/read');
    }

}
