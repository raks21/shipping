<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /*
     * 
     */

    public function Authentification() {
        $notif = array();
        $username = $this->input->post('username');
        $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);
        $sql = $this->db->query("select * from users where password = '" . $password . "' AND username = '" . $username . "'");
        $query = $sql->result();

        if ($query) {
            if ($query[0]->is_active != 1) {
                $notif['message'] = 'Your account is disabled !';
                $notif['type'] = 'warning';
            } else {
                $sess_data = array(
                    'users_id' => $query[0]->users_id,
                    'username' => $query[0]->username,
                    'first_name' => $query[0]->first_name,
                    'last_name' => $query[0]->last_name,
                    'user_type' => $query[0]->user_type,
                    'email' => $query[0]->email
                );
                $sess_data["logged_in"] = TRUE;
                $this->session->set_userdata('logged_in', $sess_data);
                $this->update_last_login($query[0]->users_id);
            }
        } else {
            $notif['message'] = 'Username or password incorrect !';
            $notif['type'] = 'danger';
        }
       

        return $notif;
    }

    /*
     * 
     */

    private function update_last_login($users_id) {
        $sql = "UPDATE users SET last_login = GETDATE() WHERE users_id=" . $this->db->escape($users_id);
        $this->db->query($sql);
    }

    /*
     * 
     */

    public function register() {
        $notif = array();
        $data = array(
            'username' => $this->input->post('username'),
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'password' => Utils::hash('sha1', $this->input->post('password'), AUTH_SALT),
            'is_active' => $this->input->post('is_active') ?: 0
        );
        $this->db->insert('users', $data);
        $users_id = $this->db->insert_id();

        if ($users_id) {
            //$this->send_password($data['email']);
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    /*
     * 
     */

    public function check_email($email) {
        $sql = "SELECT * FROM users WHERE email = " . $this->db->escape($email);
        $res = $this->db->query($sql);
        if ($res->num_rows() > 0) {
            $row = $res->row();
            return $row;
        }
        return null;
    }

    public function send_password($email) {
        $this->load->library('email');
        $this->email->set_newline("\r\n");
        $this->email->to($email);
        $this->email->from("no-replay@rewellonline.com", "rewellonline");
        $this->email->subject("Welcome to rewellonline");
        $this->email->message("Welcome to rewellonline");
        if ($this->email->send()) {
            //  echo "Done!";
        } else {
            echo $this->email->print_debugger();
        }
    }

    public function forget_password($email) {
        $query1 = $this->db->query("SELECT * from users where email = '" . $email . "' ");
        $row = $query1->result_array();
        if ($query1->num_rows()) {
            $passwordplain = "";
            $passwordplain = rand(99999999, 999999999);
            $newpass['password'] = Utils::hash('sha1', $passwordplain, AUTH_SALT);
            $this->db->where('email', $email);
            $this->db->update('users', $newpass);
            $this->load->library('email');
            $this->email->set_newline("\r\n");
            $this->email->to($email);
            $this->email->from("no-replay@rewellonline.com", "rewellonline");
            $this->email->subject("Reset Password");
            $this->email->message("Dear Customer, \r\n Thanks for contacting regarding "
                    . "to forgot password,<br> Your <b>Password</b> is <b>" . $passwordplain . "</b>\r\n"
                    . "<br>Please Update your password."
                    . "<br>Thanks & Regards"
                    . "Rewellonline Econsult");
            if ($this->email->send()) {
                //  echo "Done!";
            } else {
                echo $this->email->print_debugger();
            }
        }
    }

}
