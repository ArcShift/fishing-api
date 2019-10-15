<?php

class Ikan extends MY_Controller {

    protected $title = "ikan";

    public function __construct() {
        parent::__construct();
        $this->load->model("m_ikan", "model");
    }

    public function index() {
        $this->data['filter'] = array("nama");
        $this->data['table'] = "fish f";
        $this->data['column'] = array(
            array("title" => "nama", "field" => "name"),
            array("title" => "keterangan", "field" => "about_fish"),
        );
        $this->data['crud']=array('create','read','update','delete');
        parent::reads();
    }

    public function delete() {
        parent::delete();
    }

    public function create() {
        $this->subTitle = "Create";
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);
        $this->load->library('form_validation');
        if ($this->input->post('create')) {
            $this->form_validation->set_rules('nama', 'Nama', 'required|is_unique[fish.name]');
            $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
//            $this->form_validation->set_rules('foto', 'Foto', 'required');
            if ($this->form_validation->run()) {
                if ($this->model->create()) {
                    $this->session->set_flashdata('msgSuccess', 'Data berhasil disimpan');
                    redirect('/ikan');
                } else {
                    $this->session->set_flashdata('msgError', 'Insert data gagal');
                }
            }
        }
        $this->render("ikan/create");
    }

}
