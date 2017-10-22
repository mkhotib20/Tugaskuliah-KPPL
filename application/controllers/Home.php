<?php

class home extends CI_Controller {
    public function __construct() {
	parent::__construct();
       if(!$this->session->has_userdata('username')){
            redirect(base_url('login'));
        }
	}

    public function index(){
			$this->load->view('header');
			$this->load->view('home');
			$this->load->view('footer');
			
	}
}