<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
        $this->load->model('issueregister_model');
        $this->load->model('party_model');
        $this->load->model('report_model');
        $this->load->model('printt_model');
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

    public function issue_register() {
        $data['page_title'] = "Issue register report";
//        $data['page_title'] = "Issue Register Report";
//        $this->session->unset_userdata('rep_prefix');
//        $this->session->unset_userdata('rep_partyname');
//
//        $data['rep_avail_qty'] = "";
//        if (isset($_POST['partyname'])) {
//            $this->load->helper('security');
//            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
//            if ($this->form_validation->run() == false) {
//                $this->session->set_flashdata('message', 'Please select Prefix');
//                $this->session->set_flashdata('type', 'danger');
//            } else {
//                $this->session->set_userdata('rep_prefix', $_POST['prefix']);
//                $this->session->set_userdata('rep_partyname', $_POST['partyname']);
//                $data['rep_avail_qty'] = $this->issueregister_model->get_qty_by_party_id($_POST['partyname'], $_POST['prefix']);
//                // $this->session->set_userdata('avail_qty', $_POST['partyname']);
//            }
//        }
//        if (isset($_POST['report_issue_register'])) {
//
//            $this->load->helper('security');
//            //    $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
//            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
//            if ($this->form_validation->run() == false) {
//                $data['notif']['message'] = validation_errors();
//                $data['notif']['type'] = 'danger';
//            } else {
//
//                $data['notif'] = $this->report_model->get_issue($_POST['prefix'], $_POST['partyname']);
//            }
//        }
        $data['get_issue_reg'] = $this->report_model->get_issue1();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('report/report_issue', $data);
        $this->load->view('include/footer', $data);
    }

    public function customer_booking() {
        $data['page_title'] = "Customer booking report";
        $data['get_issue_reg'] = $this->report_model->get_issue();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('report/report_booking', $data);
        $this->load->view('include/footer', $data);
    }

}
