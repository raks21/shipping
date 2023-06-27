<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Party extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->load->helper('url');
        $this->load->model('party_model');
        $this->load->library('session');
    }

    public function index() {
        $data['page_title'] = 'Party Details';
        $data['party'] = $this->party_model->get_all_party();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('party/party', $data);
        $this->load->view('include/footer', $data);
    }

    public function add() {
        $data['page_title'] = 'Add Party';

        if (isset($_POST['add_party'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('address1', 'Lane 1', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('address2', 'Lane 2', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required|max_length[6]|min_length[6]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->party_model->add();
            }
        }

        $data['party'] = $this->party_model->get_all_party();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('party/add', $data);
        $this->load->view('include/footer', $data);
    }

    public function edit() {
        $data['page_title'] = 'Edit Party';

        if (isset($_POST['edit_party'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('address1', 'Lane 1', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('address2', 'Lane 2', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required|max_length[6]|min_length[6]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->party_model->edit();
            }
        }
        $data['get_party'] = $this->party_model->get_by_id($this->uri->segment(3));
        $data['party'] = $this->party_model->get_all_party();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('party/edit', $data);
        $this->load->view('include/footer', $data);
    }

    public function delete() {

        if ($this->uri->segment(1) == "party" && $this->uri->segment(2) == "delete") {
            $this->db->where('party_id', $this->uri->segment(3));
            $this->db->delete('party_master');
            redirect('/party');
        }
    }

}
