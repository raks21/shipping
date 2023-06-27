<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Party_model extends CI_Model {

    var $table = 'Party_Master';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_party() {
        $this->db->from('Party_Master');
        $this->db->order_by("Party_Name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $query = $this->db->query('SELECT * FROM Party_Master WHERE Party_id = ' . $id . '');

        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

    public function delete_by_id($id) {
        $this->db->where('Party_id', $id);
        $this->db->delete($this->table);
    }

    public function add() {
        $notif = array();
        $data = array(
            'Party_Name' => $this->input->post('partyname'),
            'Party_Address1' => $this->input->post('address1'),
            'Party_Address2' => $this->input->post('address2'),
            'City' => $this->input->post('city'),
            'State_Code' => $this->input->post('pincode'),
            'Phone' => $this->input->post('phone'),
        );
        // Insert //
        $this->db->insert('Party_Master', $data);
        $party_id = $this->db->insert_id();
        // end Insert //
        // Update //
        $party_code = "S" . $party_id;
        $dtaa = array('Party_Code' => $party_code);
        $this->db->where('Party_id', $party_id);
        $this->db->update('Party_Master', $dtaa);
        // End update           //

        if ($this->db->affected_rows() > 0) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/party'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function edit() {
        $notif = array();
        $data = array(
            'Party_Name' => $this->input->post('partyname'),
            'Party_Address1' => $this->input->post('address1'),
            'Party_Address2' => $this->input->post('address2'),
            'City' => $this->input->post('city'),
            'State_Code' => $this->input->post('pincode'),
            'Phone' => $this->input->post('phone'),
        );
        $this->db->where('Party_id', $this->uri->segment(3));
        $this->db->update('Party_Master', $data);

        if ($this->db->affected_rows() > 0) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/party'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function get_party_by_id($id) {
        $query = $this->db->query('SELECT * FROM Party_Master WHERE Party_id = ' . $id . '');

        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

    public function get_prefix_by_id($id) {
        $query = $this->db->query('SELECT * FROM Prefix_Master WHERE Prefix_Id = ' . $id . '');

        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

}
