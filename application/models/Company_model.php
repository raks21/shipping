<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {

    var $table = 'Company';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_company() {
        $this->db->from('company');
        $query = $this->db->get();
        return $query->result();
    }

}
