<?php

class Pengaduan extends MY_Controller {

    protected $module = "pengaduan";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_pengaduan", "model");
    }

    public function index() {
        $config['filter'] = array(
            array("title" => "nelayan", "type" => "input"),
            array("title" => "keterangan", "type" => "input")
        );
        $config['table'] = "fisherman_complaintment fc";
        $config['join'] = array(
            array("table" => "fisherman f", "relation" => "f.id = fc.id_fisherman"),
        );
        $config['column'] = array(
            array("title" => "nelayan", "field" => "f.name"),
            array("title" => "keterangan", "field" => "fc.description"),
            array("title" => "latitude", "field" => "fc.latitude"),
            array("title" => "longitude", "field" => "fc.longitude"),
            array("title" => "status", "field" => "fc.status"),
        );
        $config['crud'] = array('read');
        parent::reads($config);
    }

    public function detail() {
        if(empty($this->session->flashdata('id'))){
            redirect($this->title);
        }
        $this->data['id']=$this->session->flashdata('id');
        $this->subTitle = 'Detail';
        $result=  $this->model->read($this->data['id']);
        $this->data['dataLaporan'] = $result['main'];
        $this->data['dataFiles'] = $result['files'];
        $this->render('pengaduan/read');
    }

}
