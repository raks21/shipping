<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
        $this->load->helper('url');
        $this->load->model('user_model');
    }

    public function index() {

        $data['user'] = $this->user_model->get_all_users();
        $this->load->view('user/user_view', $data);
    }

    public function ajax_edit($id) {
        $data = $this->user_model->get_by_id($id);
        echo json_encode($data);
    }

    public function user_update() {
        $data = array(
            'User_Name' => $this->input->post('user_name'),
            'User_Password' => $this->input->post('user_password'),
            'User_Status' => $this->input->post('user_status'),
        );
        $this->user_model->book_update(array('User_Code' => $this->input->post('user_code')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function user_delete($id) {
        $this->user_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    public function register() {
        $data['title'] = 'Register';

        if (count($_POST)) {
            $this->load->helper('security');
            $this->form_validation->set_rules('username', 'User Name', 'trim|required|alpha_numeric|min_length[3]|max_length[15]|is_unique[users.username]');
            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('mobile', 'Mobile', 'trim|required|max_length[10]|min_length[10]');
            //$this->form_validation->set_rules('mobile', 'Mobile', 'required||matches[repassword]|max_length[10]|min_length[10]|xss_clean|callback_isphoneExist');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]|max_length[12]|alpha_numeric');
            $this->form_validation->set_rules('confirm_password', 'Password', 'trim|required|matches[password]|min_length[6]');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['notif'] = $this->user_model->register();
            }
        }

        /*
         * Load view
         */
        $this->load->view('auth/includes/header', $data);
        //$this->load->view('auth/includes/navbar');
        $this->load->view('auth/register');
        $this->load->view('auth/includes/footer');
    }

}
