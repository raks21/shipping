<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    var $table = 'Company';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_issue() {
        $null = "Consignee_Name != ''";
        $query = $this->db->query('SELECT COUNT(Issuereg_Id) as cnt, Prefix_Id, Party_Id '
                . 'FROM Issue_Register_Master '
                . 'where ' . $null . ' '
                . 'GROUP BY Prefix_Id, Party_Id '
                . 'order by Party_Id, Prefix_Id');
        return $query->result();
    }

    public function get_issue1() {
        $query = $this->db->query('SELECT COUNT(Issuereg_Id) as cnt, Prefix_Id, Party_Id '
                . 'FROM Issue_Register_Master '
                . 'GROUP BY Prefix_Id, Party_Id '
                . 'order by Party_Id, Prefix_Id');

        return $query->result();
    }

}
