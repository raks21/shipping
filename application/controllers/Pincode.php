<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pincode extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->load->helper('url');
        $this->load->model('place_model');
        $this->load->model('pincode_model');
        $this->load->library('session');
    }

    public function index() {
        $data['title'] = 'Place Master';
        if (isset($_POST['import_place'])) {
            $data['place_import'] = $this->place_model->place_import();
        }
        $data['pincode'] = $this->pincode_model->get_all_pincode();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('pincode/pincode', $data);
        $this->load->view('include/footer', $data);
    }

    public function add() {
        $data['title'] = 'Add Place';

        if (isset($_POST['add_place'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('placename', 'Place Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('contactperson', 'Contact Person', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('placeremark', 'Place Remark', 'trim|required|min_length[3]');
//            $this->form_validation->set_rules('pincode', 'Pincode', 'trim|required|max_length[6]|min_length[6]');
//            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->place_model->add();
            }
        }
        $data['state'] = $this->place_model->get_state();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('place/add', $data);
        $this->load->view('include/footer', $data);
    }

    public function edit() {
        $data['title'] = 'Edit Place';
        if (isset($_POST['edit_place'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('placename', 'Place Name', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('contactperson', 'Contact Person', 'trim|required|min_length[3]|max_length[30]');
            $this->form_validation->set_rules('phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('placeremark', 'Place Remark', 'trim|required|min_length[3]');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->place_model->edit();
            }
        }
        $data['get_place'] = $this->place_model->get_by_id($this->uri->segment(3));
        $data['state'] = $this->place_model->get_state();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('place/edit', $data);
        $this->load->view('include/footer', $data);
    }

    public function delete() {

        if ($this->uri->segment(1) == "place" && $this->uri->segment(2) == "delete") {
            $this->db->where('Place_Code', $this->uri->segment(3));
            $this->db->delete('place');
            redirect('/place');
        }
    }

}
