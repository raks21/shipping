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
        Utils::no_cache();

        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('user_model');
        $this->load->library('session');
    }

    public function index() {
        $data['page_title'] = "User Details";
        $data['title'] = 'User Grid';
        $data['user'] = $this->user_model->get_all_users();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('user/user', $data);
        $this->load->view('include/footer', $data);
    }

    public function register() {
        $data['title'] = 'Register';

        if (isset($_POST['user_register'])) {
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

        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('user/register', $data);
        $this->load->view('include/footer', $data);
    }

    public function edit() {
        $data['title'] = 'Edit';
        $data['get_user'] = $this->user_model->get_by_id($this->uri->segment(3));
        if (isset($_POST['edit_register'])) {
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
                $data['notif'] = $this->user_model->edit();
            }
        }

        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('user/edit', $data);
        $this->load->view('include/footer', $data);
    }

    public function delete() {

        if ($this->uri->segment(1) == "user" && $this->uri->segment(2) == "delete") {
            $this->db->where('users_id', $this->uri->segment(3));
            $this->db->delete('users');
            redirect('/user');
        }
    }

}
