<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shipprint extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->model('shipprint_model');
        $this->load->library('session');
    }

    public function index() {

        $consignment = $this->shipprint_model->Consignment_master();

//        echo "<pre />";
//        print_r($consignment);

        $consign_data = date("d/m/y", strtotime($consignment->Consignment_Date));

        $carray = array($consignment->Party_Name, $consignment->Party_Address1, $consignment->Party_Address2, $consignment->Party_Address3,
            $consignment->Consignee_Name, $consignment->Consignee_Address1, $consignment->Consignee_Address2, $consignment->Consignee_Place);
        for ($i = 0; $i <= 7; $i++) {
            $var1 = strlen($carray[$i]);

            if ($var1 >= 25) {
                $var1 = 25;
            }
            $length = (25 - $var1);
            $strarr[] = $carray[$i] . str_repeat(' ', $length);
        }
        $strarr0 = substr($strarr[0], 0, 25);
        $strarr1 = substr($strarr[1], 0, 25);
        $strarr2 = substr($strarr[2], 0, 25);
        $strarr3 = substr($strarr[3], 0, 25);
        $strarr4 = substr($strarr[4], 0, 21);
        $strarr5 = substr($strarr[5], 0, 21);
        $strarr6 = substr($strarr[6], 0, 21);
        $strarr7 = substr($strarr[7], 0, 21);


        $files = 'uploads/files/sabya.txt';
        $f = fopen($files, "w");
        $str = str_repeat(' ', 63);
        $str6 = str_repeat(' ', 5);
        $str3 = str_repeat(' ', 5);
        fwrite($f, "                          1111111111                          $consign_data \n");
        fwrite($f, "$str \n");
        fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $consignment->No_of_pieces \n");
        fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $consignment->Consignment_Weight \n");
        fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
        fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
        //fwrite($f, "       118IPL0084260718            520013                            \n");
        fclose($f);

        $this->load->view('print_view');
    }

}
