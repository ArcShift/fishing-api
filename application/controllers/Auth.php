<?php

class Auth extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_profil', 'model');
    }

    public function register_post() {
        $input = $this->check_param_raw('name', 'username', 'email', 'password');
        $callback = $this->model->register($input);
        if ($callback) {
            $this->send_mail($input['email']);
        }
        $this->get_response($callback);
    }

    public function login_post() {
        $input = $this->check_param_raw('email', 'password');
        $callback = $this->model->login($input);
        $this->get_response($callback);
    }
    public function login_google_post() {
        $input = $this->check_param_raw('email');
        $callback=$this->model->login_google($input['email']);
        $this->get_response($callback);
    }

    public function resend_mail_post() {
        $input = $this->check_param_raw('email');
        $this->send_mail($input['email']);
        $this->get_response('email_send');
    }

    function send_mail($email) {
        //GENERATE RANDOM STRING
        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        if (!$this->model->set_validation($email, $randomString)) {
            $this->get_response(false);
        }
        //SEND MAIL
        $content = "Klik <strong><a href='" . base_url() . "index.php/site/register/" . $randomString . "' target='_blank' rel='noopener'>link</a></strong> ini untuk validasi email";
        $config = [
            'mailtype' => 'html',
            'charset' => 'utf-8',
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => 'knightarcher1@gmail.com', // Email gmail
            'smtp_pass' => '3ep5c98Hyys3NmF', // Password gmail
            'smtp_crypto' => 'ssl',
//            'smtp_port' => 587,
            'smtp_port' => 465,
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ];
        $this->load->library('email', $config);
        $this->email->from('knightarcher1@gmail.com', 'google.com');
        $this->email->to($email); // Ganti dengan email tujuan
//        $this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');
        $this->email->subject('Validasi User Fisherman');
        $this->email->message($content);
        if (!$this->email->send()) {
            $this->session->set_flashdata('error', 'email_gagal');
            $this->get_response(null);
            print_r($this->email->print_debugger());
        }
    }

    public function token_get() {
        $tokenData = array();
        $tokenData['id'] = 1; //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }

    public function token_post() {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

}
