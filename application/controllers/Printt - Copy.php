<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Printt extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
        $this->load->helper('url');
        $this->load->model('issueregister_model');
        $this->load->model('party_model');
        $this->load->model('printt_model');
        $this->load->library('session');
    }

    public function index() {
        $this->session->unset_userdata('pri_prefix');
        $this->session->unset_userdata('pri_partyname');
        $this->session->unset_userdata('pri_radio_check');
        $data['page_title'] = "Consignment Printing";
        $data['pri_avail_qty'] = "";
        if (isset($_POST['partyname'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('pri_prefix', $_POST['prefix']);
                $this->session->set_userdata('pri_partyname', $_POST['partyname']);

                $data['pri_avail_qty'] = $this->issueregister_model->get_qty_1($_POST['partyname'], $_POST['prefix']);
                $this->session->set_userdata('pri_avail_qty', $data['pri_avail_qty']);
            }
        }
        if (isset($_POST['issue_register'])) {
            $this->session->set_userdata('pri_radio_check', $_POST['radio_check']);
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            if ($_POST['fromissue'] && $_POST['toissue']) {
                $this->form_validation->set_rules('fromissue', 'From range', 'trim|required|max_length[15]|min_length[5]');
                $this->form_validation->set_rules('toissue', 'To range', 'trim|required|max_length[15]|min_length[5]');
            } elseif ($this->input->post('radio_check') == 2) {
                $this->form_validation->set_rules('fromissue', 'Reference from range', 'trim|required|max_length[15]|min_length[5]');
                $this->form_validation->set_rules('toissue', 'Reference to range', 'trim|required|max_length[15]|min_length[5]');
            }
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                if ($this->input->post('radio_check') == 1) {
                    $data['printt'] = $this->printt_model->printt();
                } elseif ($this->input->post('radio_check') == 2) {
                    $data['printt'] = $this->printt_model->printt_reference();
                }
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('printt/printt', $data);
        $this->load->view('include/footer', $data);
    }

    public function report() {
        $data['page_title'] = "Issue Register";

        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/issue_report', $data);
        $this->load->view('include/footer', $data);
    }

    public function barcode() {
        echo '<img alt="Coding Sips" src="http://192.168.1.93/ci_crud/assests/barcode.php?codetype=code128&size=40&text=VPL10000&print=true" />';
    }

    public function ascii() {
        echo chr(124), chr(125), chr(59), chr(99), chr(68), chr(59), chr(124), chr(125), chr(124), chr(125), chr(124), chr(125);
    }

    public function reprint() {
        $this->session->unset_userdata('repri_prefix');
        $this->session->unset_userdata('repri_partyname');
        $this->session->unset_userdata('repri_radio_check');
        $data['page_title'] = "Consignment re-Printing";
        $data['repri_avail_qty'] = "";
        if (isset($_POST['partyname'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('repri_prefix', $_POST['prefix']);
                $this->session->set_userdata('repri_partyname', $_POST['partyname']);

                $data['repri_avail_qty'] = $this->issueregister_model->get_qty_($_POST['partyname'], $_POST['prefix']);
                $this->session->set_userdata('repri_avail_qty', $data['repri_avail_qty']);
            }
        }
        if (isset($_POST['issue_register'])) {
            $this->session->set_userdata('repri_radio_check', $_POST['radio_check']);
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            if ($_POST['fromissue'] && $_POST['toissue']) {
                $this->form_validation->set_rules('fromissue', 'From range', 'trim|required|max_length[15]|min_length[5]');
                $this->form_validation->set_rules('toissue', 'To range', 'trim|required|max_length[15]|min_length[5]');
            } elseif ($this->input->post('radio_check') == 2) {
                $this->form_validation->set_rules('fromissue', 'Reference from range', 'trim|required|max_length[15]|min_length[5]');
                $this->form_validation->set_rules('toissue', 'Reference to range', 'trim|required|max_length[15]|min_length[5]');
            }

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                if ($this->input->post('radio_check') == 1) {
                    $data['printt'] = $this->printt_model->reprint();
                } elseif ($this->input->post('radio_check') == 2) {
                    $data['printt'] = $this->printt_model->reprint_reference();
                }
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('printt/reprint', $data);
        $this->load->view('include/footer', $data);
    }

}
