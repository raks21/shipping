<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sabya extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
        $this->load->helper('url');
        $this->load->model('sabya_model');
        $this->load->library('session');
    }

    public function index() {
        //$data['page_title'] = "Consignment Printing";
        //  $data['cities'] = $this->sabya_model->getParty();
        $this->load->view('sabya/sabya');
    }

    public function getCityDepartment() {
        // POST data
        $postData = $this->input->post();
        print_r($postData);
        //load model
        $this->load->model('sabya_model');

        // get data
        $data = $this->sabya_model->getCityDepartment($postData);

        echo json_encode($data);
    }

    public function getDepartmentUsers() {
        // POST data
        $postData = $this->input->post();

        //load model
        $this->load->model('Main_model');

        // get data
        $data = $this->Main_model->getDepartmentUsers($postData);

        echo json_encode($data);
    }

}
