<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipprint_model extends CI_Model {

    var $table = 'Company';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function Consignment_master() {
        //$row = array();
        $query = $this->db->query('SELECT * FROM Consignment_TRANSACTION inner join Party_Master
                                   on(Consignment_TRANSACTION.Party_id = Party_Master.Party_id)
                                   WHERE Consignment_No = 500001');
        foreach ($query->result() as $row) {
            
        }
        return $row;
    }

}
