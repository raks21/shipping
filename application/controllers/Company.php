<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
        $this->load->helper('url');
        $this->load->model('company_model');
        $this->load->library('session');
    }

    public function index() {
        $data['page_title'] = "Organisation Detail";
        $data['company'] = $this->company_model->get_company();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('company/company', $data);
        $this->load->view('include/footer', $data);
    }

    public function form() {

        $data['company'] = $this->company_model->get_company();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('form/form', $data);
        $this->load->view('include/footer', $data);
    }

}
