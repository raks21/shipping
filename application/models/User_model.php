<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    var $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_users() {
        $this->db->from('users');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $query = $this->db->query('SELECT * FROM users WHERE users_id = ' . $id . '');

        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

    public function delete_by_id($id) {
        $this->db->where('users_id', $id);
        $this->db->delete($this->table);
    }

    public function Authentification() {
        $notif = array();
        $username = $this->input->post('username');
        $password = Utils::hash('sha1', $this->input->post('password'), AUTH_SALT);

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            $row = $query->row();
            if ($row->is_active != 1) {
                $notif['message'] = 'Your account is disabled !';
                $notif['type'] = 'warning';
            } else {
                $sess_data = array(
                    'users_id' => $row->users_id,
                    'username' => $row->username,
                    'first_name' => $row->first_name,
                    'last_name' => $row->last_name,
                    'user_type' => $row->user_type,
                    'email' => $row->email
                );
                $this->session->set_userdata('logged_in', $sess_data);
                $this->update_last_login($row->users_id);
            }
        } else {
            $notif['message'] = 'Username or password incorrect !';
            $notif['type'] = 'danger';
        }

        return $notif;
    }

    private function update_last_login($users_id) {
        $sql = "UPDATE users SET last_login = NOW() WHERE users_id=" . $this->db->escape($users_id);
        $this->db->query($sql);
    }

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
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/user'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function edit() {
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

        $this->db->where('users_id', $this->uri->segment(3));
        $this->db->update('users', $data);

        if ($this->db->affected_rows() > 0) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/user'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

}
