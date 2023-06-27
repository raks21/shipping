<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sabya_model extends CI_Model {

    var $table = 'Company';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get cities
    function getParty() {

        $response = array();

        // Select record
        $this->db->select('*');
        $q = $this->db->get('Party_Master');
        $response = $q->result_array();

        return $response;
    }

    // Get City departments
    function getCityDepartment($postData) {
        $response = array();

        // Select record
        $this->db->select('Issuereg_Id,Party_Id');
        $this->db->where('Party_Id', 1);
        $q = $this->db->get('Issue_Register_Master');
        $response = $q->result_array();

        return $response;
    }

    // Get Department user
    function getDepartmentUsers($postData) {
        $response = array();

        // Select record
        $this->db->select('id,name,email');
        $this->db->where('department', $postData['department']);
        $q = $this->db->get('user_depart');
        $response = $q->result_array();

        return $response;
    }

}
