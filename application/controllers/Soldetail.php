<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soldetail extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->load->helper('url');
        $this->load->model('party_model');
        $this->load->model('place_model');
        $this->load->model('sol_model');
        $this->load->library('session');
    }

    public function index() {
        $this->session->unset_userdata('sol_partyname');
        $data['page_title'] = 'Import Sol Details';
        if (isset($_POST['import_sol'])) {
            $this->load->helper('security');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['sol_import'] = $this->sol_model->sol_import();
            }
        }
        $data['sol_details'] = $this->sol_model->get_all_sol();
        $data['get_party'] = $this->party_model->get_all_party();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('sol/sol', $data);
        $this->load->view('include/footer', $data);
    }

    public function sollist() {
        $data['page_title'] = 'Sol Details';

        $data['sol_details'] = $this->sol_model->get_all_sol();
        $data['get_party'] = $this->party_model->get_all_party();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('sol/sollist', $data);
        $this->load->view('include/footer', $data);
    }

}
