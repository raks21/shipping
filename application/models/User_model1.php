<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    var $table = 'users';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

}
