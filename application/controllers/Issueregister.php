<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Issueregister extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }
        $this->session_user = $this->session->userdata('logged_in');
        $this->load->helper('url');
        $this->load->model('issueregister_model');
        $this->load->model('party_model');
        $this->load->model('printt_model');
        $this->load->library('session');
    }

    public function index() {
        $this->session->unset_userdata('prefix');
        $this->session->unset_userdata('partyname');

        $data['page_title'] = "Issue Register";
        $data['avail_qty'] = "";
        if (isset($_POST['partyname'])) {
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('prefix', $_POST['prefix']);
                $this->session->set_userdata('partyname', $_POST['partyname']);
                $data['avail_qty'] = $this->issueregister_model->get_qty_by_party_id($_POST['partyname'], $_POST['prefix']);
                // $this->session->set_userdata('avail_qty', $_POST['partyname']);
            }
        }
        if (isset($_POST['issue_register'])) {
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('fromissue', 'From range', 'trim|required|max_length[15]|min_length[5]');
            $this->form_validation->set_rules('toissue', 'To range', 'trim|required|max_length[15]|min_length[5]');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->issueregister_model->add();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/register', $data);
        $this->load->view('include/footer', $data);
    }

    public function index123() {    // Issue register with quantity //
        $this->session->unset_userdata('prefix');
        $this->session->unset_userdata('partyname');

        $data['page_title'] = "Issue Register";
        $data['avail_qty'] = "";
        if (isset($_POST['partyname'])) {
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('prefix', $_POST['prefix']);
                $this->session->set_userdata('partyname', $_POST['partyname']);
                $data['avail_qty'] = $this->issueregister_model->get_qty_by_party_id($_POST['partyname'], $_POST['prefix']);
                // $this->session->set_userdata('avail_qty', $_POST['partyname']);
            }
        }
        if (isset($_POST['issue_register'])) {
            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            // $this->form_validation->set_rules('consignment_qty', 'Quantity', 'trim|required|max_length[15]|min_length[1]');
            $this->form_validation->set_rules('consignment_from', 'Quantity', 'trim|required|max_length[15]|min_length[1]');
            $this->form_validation->set_rules('consignment_to', 'Quantity', 'trim|required|max_length[15]|min_length[1]');
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['notif'] = $this->issueregister_model->add();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/register', $data);
        $this->load->view('include/footer', $data);
    }

    public function report() {


        $data['page_title'] = "Issue Report";
//        if (isset($_POST['import_consignment'])) {
//            $data['consignment_import'] = $this->issueregister_model->consignment_import();
//        }
        $data['get_print_list'] = $this->printt_model->get_all_consignment();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/issue_report', $data);
        $this->load->view('include/footer', $data);
    }

    public function import() {
        $this->session->unset_userdata('imp_prefix');
        $this->session->unset_userdata('imp_partyname');
        $data['page_title'] = "Import Booking Details";
        $data['imp_avail_qty'] = "";
        if (isset($_POST['partyname'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('imp_prefix', $_POST['prefix']);
                $this->session->set_userdata('imp_partyname', $_POST['partyname']);
                $data['imp_avail_qty'] = $this->issueregister_model->get_qty_by_party_id($_POST['partyname'], $_POST['prefix']);
                $this->session->set_userdata('imp_avail_qty', $data['imp_avail_qty']);
            }
        }
        if (isset($_POST['import_consignment'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            $this->form_validation->set_rules('fromissue', 'From range', 'trim|required|max_length[15]|min_length[5]');
            $this->form_validation->set_rules('toissue', 'To range', 'trim|required|max_length[15]|min_length[5]');
            if (empty($_FILES['excel_file']['name'])) {
                $this->form_validation->set_rules('excel_file', 'Excel File', 'trim|required');
            }


            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->issueregister_model->consignment_import();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/import', $data);
        $this->load->view('include/footer', $data);
    }

    public function reference() {
        $this->session->unset_userdata('impref_prefix');
        $this->session->unset_userdata('impref_partyname');
        $data['page_title'] = "Import Reference Booking Details";
        $data['imp_avail_qty'] = "";

        if (isset($_POST['import_consignment'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');

            $this->session->set_userdata('impref_prefix', $_POST['prefix']);
            $this->session->set_userdata('impref_partyname', $_POST['partyname']);
            if (empty($_FILES['excel_file']['name'])) {
                $this->form_validation->set_rules('excel_file', 'Excel File', 'trim|required');
            }
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['notif'] = $this->issueregister_model->consignment_import_reference();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/import_reference', $data);
        $this->load->view('include/footer', $data);
    }

    public function import_old() {   //import with only prefix and party id //
        $this->session->unset_userdata('imp_prefix');
        $this->session->unset_userdata('imp_partyname');
        $data['page_title'] = "Import Booking Details";
        $data['imp_avail_qty'] = "";
        if (isset($_POST['partyname'])) {

            $this->load->helper('security');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata('message', 'Please select Prefix');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('imp_prefix', $_POST['prefix']);
                $this->session->set_userdata('imp_partyname', $_POST['partyname']);
                $data['imp_avail_qty'] = $this->issueregister_model->get_qty_by_party_id($_POST['partyname'], $_POST['prefix']);
                $this->session->set_userdata('imp_avail_qty', $data['imp_avail_qty']);
            }
        }
        if (isset($_POST['import_consignment'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            if (empty($_FILES['excel_file']['name'])) {
                $this->form_validation->set_rules('excel_file', 'Excel File', 'trim|required');
            }
//            $this->form_validation->set_rules('fromissue', 'From range', 'trim|max_length[15]|min_length[5]');
//            $this->form_validation->set_rules('toissue', 'To range', 'trim|max_length[15]|min_length[5]');


            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {

                $data['notif'] = $this->issueregister_model->consignment_import();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/import', $data);
        $this->load->view('include/footer', $data);
    }

    public function sabya() {
        for ($i = 2; $i <= 4; $i++) {

            $data = array(
                'Consignee_Name' => 'name' . $i . '',
                'Consignee_Address1' => 'address 1 ' . $i . '',
                'Consignee_Address2' => 'address 2 ' . $i . '',
                'Consignee_Address3' => 'address 3 ' . $i . '',
                'Consignee_Place' => 'place ' . $i . '',
                'Consignee_Pincode' => '400708',
                'Consignee_Weight' => '15',
                'No_Of_Pieces' => '8',);
            $this->db->where('Issuereg_Id', $i);
            $this->db->update('Issue_register_master', $data);
        }
    }

    public function singlebooking() {
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
            unset($_SESSION['type']);
        }

        //$this->session->unset_userdata('single_prefix');
        //$this->session->unset_userdata('single_partyname');

        $data['page_title'] = "Issue Register";
        $data['single_avail_qty'] = "";
        if (isset($_POST['partyname'])) {
            $this->session->unset_userdata('chk_con_no');
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            $this->load->helper('security');

            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');

            if ($this->form_validation->run() == false) {
//                $this->session->set_flashdata('message', 'Please select Prefix');
//                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_userdata('single_prefix', $_POST['prefix']);
                $this->session->set_userdata('single_partyname', $_POST['partyname']);
                $data['single_avail_qty'] = $this->issueregister_model->get_qty_by_party_id($this->session->userdata('single_partyname'), $this->session->userdata('single_prefix'));
                if ($data['single_avail_qty'] == 0) {
                    $this->session->set_flashdata('message', 'Can not book a consignment');
                    $this->session->set_flashdata('type', 'danger');
                }
                // $this->session->set_userdata('avail_qty', $_POST['partyname']);
            }
        }
        if (isset($_POST['single_booking'])) {
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            if ($this->session->userdata('chk_con_no')) {
                $this->load->helper('security');
                //$this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
                //$this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
                $this->form_validation->set_rules('consignee_name', 'Consignee Name', 'trim|required|max_length[25]|min_length[3]');
				$this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address1', 'Address Lane 1', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address2', 'Address Lane 2', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('Phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
                $this->form_validation->set_rules('place', 'place', 'trim|required|max_length[25]|min_length[3]');
                $this->form_validation->set_rules('pincode', 'pincode', 'trim|required|max_length[6]|min_length[6]');
                // $this->form_validation->set_rules('service', 'Service', 'trim|required|max_length[15]|min_length[1]');
                //$this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('weight', 'weight', 'trim|required|max_length[10]|min_length[1]');
                $this->form_validation->set_rules('pieces', 'pieces', 'trim|required|max_length[10]|min_length[1]');
                if ($this->form_validation->run() == false) {
                    $data['notif']['message'] = validation_errors();
                    $data['notif']['type'] = 'danger';
                } else {
                    $data['notif'] = $this->issueregister_model->single_booking_consign();
                }
            } else {
                $this->load->helper('security');
                $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
                $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
                $this->form_validation->set_rules('consignee_name', 'Consignee Name', 'trim|required|max_length[25]|min_length[3]');
				$this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address1', 'Address Lane 1', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address2', 'Address Lane 2', 'trim|required|max_length[25]|min_length[3]');
                // $this->form_validation->set_rules('Phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
                $this->form_validation->set_rules('place', 'place', 'trim|required|max_length[25]|min_length[3]');
                $this->form_validation->set_rules('pincode', 'pincode', 'trim|required|max_length[6]|min_length[6]');
                //  $this->form_validation->set_rules('service', 'Service', 'trim|required|max_length[15]|min_length[1]');
                // $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('weight', 'weight', 'trim|required|max_length[10]|min_length[1]');
                $this->form_validation->set_rules('pieces', 'pieces', 'trim|required|max_length[10]|min_length[1]');
                if ($this->form_validation->run() == false) {
                    $data['notif']['message'] = validation_errors();
                    $data['notif']['type'] = 'danger';
                } else {

                    $data['notif'] = $this->issueregister_model->single_booking();
                }
            }
        }
        $data['consign_data'] = "";
        if (isset($_POST['check_booking'])) {
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            $this->load->helper('security');

            $this->form_validation->set_rules('consignee_no', 'Consignment No', 'trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $this->session->set_userdata('chk_con_no', $_POST['consignee_no']);

                $data['consign_data'] = $this->issueregister_model->check_consign($this->session->userdata('chk_con_no'));
            }
        }
        $data['page_title'] = "Global Search";
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/single_booking', $data);
        $this->load->view('include/footer', $data);
    }


public function singlereferencebooking() 
{
        //$this->session->unset_userdata('single_prefix');
        //$this->session->unset_userdata('single_partyname');
		if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
        $data['page_title'] = "Issue Register";
        $data['single_avail_qty'] = "";
		//$this->session->set_userdata('single_prefix', $_POST['prefix']);
        //$this->session->set_userdata('single_partyname', $_POST['partyname']);
        $data['last_consin_no'] = $this->issueregister_model->get_consign_no_by_insid();
        
		if (isset($_POST['single_booking'])) 
        {
			
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
			//echo "SABBYASAAAAA";exit();
            $this->session->unset_userdata('chk_con_no');
            $this->load->helper('security');
            // $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
            // $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('consignment_no', 'Consignee No', 'trim|required|max_length[25]|min_length[3]|alpha_numeric_spaces');
            $this->form_validation->set_rules('consignee_name', 'Consignee Name', 'trim|required|max_length[50]|min_length[3]');
            $this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[3]');
            //$this->form_validation->set_rules('address1', 'Address Lane 1', 'trim|required|max_length[25]|min_length[3]');
            //$this->form_validation->set_rules('address2', 'Address Lane 2', 'trim|required|max_length[25]|min_length[3]');
            // $this->form_validation->set_rules('Phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
            $this->form_validation->set_rules('place', 'place', 'trim|required|max_length[25]|min_length[3]');
            $this->form_validation->set_rules('pincode', 'pincode', 'trim|required|max_length[6]|min_length[6]|numeric');
            //  $this->form_validation->set_rules('service', 'Service', 'trim|required|max_length[15]|min_length[1]');
            // $this->form_validation->set_rules('date', 'Date', 'trim|required');
            $this->form_validation->set_rules('weight', 'weight', 'trim|required|max_length[10]|min_length[1]|numeric');
            $this->form_validation->set_rules('pieces', 'pieces', 'trim|required|max_length[10]|min_length[1]|numeric');
            if ($this->form_validation->run() == false) 
            {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            }
            else 
            {
                //changes by Raksha to check reference id is unique
                $chk_refe = $this->issueregister_model->check_refe_no_in_issue_register($_POST['reference_no']);
                if($chk_refe > 0)
                {                     
                    $this->session->set_flashdata('message', 'Reference number already exists');
                    $this->session->set_flashdata('type', 'danger');
                }
                else
                {
                    $data['notif'] = $this->issueregister_model->single_ref_booking();
                }
            }            
        }
		
		
        $data['consign_data'] = "";
        if (isset($_POST['check_booking'])) 
        {
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            $this->load->helper('security');

            $this->form_validation->set_rules('consignee_no', 'Consignment No', 'trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $this->session->set_userdata('chk_con_no', $_POST['consignee_no']);

                $data['consign_data'] = $this->issueregister_model->check_reference1($this->session->userdata('chk_con_no'));
			  }
        }
        $data['page_title'] = "Single Reference Booking";
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/single_ref_booking', $data);
        $this->load->view('include/footer', $data);
    }


public function singlereferencebooking_old() {
        if (isset($_SESSION['message'])) {
            unset($_SESSION['message']);
            unset($_SESSION['type']);
        }

        //$this->session->unset_userdata('single_prefix');
        //$this->session->unset_userdata('single_partyname');

        $data['page_title'] = "Single Reference Booking";
        $data['single_avail_qty'] = "";
			$data['last_consin_no'] = $this->issueregister_model->get_consign_no_by_insid();
        if (isset($_POST['single_booking'])) {
			
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
			//echo "SABBYASAAAAA";exit();
            
                $this->load->helper('security');
               // $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
               // $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
				$this->form_validation->set_rules('consignment_no', 'Consignee No', 'trim|required|max_length[25]|min_length[3]|numeric');
                $this->form_validation->set_rules('consignee_name', 'Consignee Name', 'trim|required|max_length[50]|min_length[3]');
				$this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address1', 'Address Lane 1', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address2', 'Address Lane 2', 'trim|required|max_length[25]|min_length[3]');
                // $this->form_validation->set_rules('Phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
                $this->form_validation->set_rules('place', 'place', 'trim|required|max_length[25]|min_length[3]');
                $this->form_validation->set_rules('pincode', 'pincode', 'trim|required|max_length[6]|min_length[6]|numeric');
                //  $this->form_validation->set_rules('service', 'Service', 'trim|required|max_length[15]|min_length[1]');
                // $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('weight', 'weight', 'trim|required|max_length[10]|min_length[1]|numeric');
                $this->form_validation->set_rules('pieces', 'pieces', 'trim|required|max_length[10]|min_length[1]|numeric');
                if ($this->form_validation->run() == false) {
                    $data['notif']['message'] = validation_errors();
                    $data['notif']['type'] = 'danger';
                } else {
				   $data['notif'] = $this->issueregister_model->single_ref_booking();
                }
            
        }
        $data['consign_data'] = "";
        if (isset($_POST['check_booking'])) {
			
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            $this->load->helper('security');

            $this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $this->session->set_userdata('chk_con_no', $_POST['reference_no']);

                $data['consign_data'] = $this->issueregister_model->check_reference($this->session->userdata('chk_con_no'));
            }
        }
        $data['page_title'] = "Single Reference Booking";
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/single_ref_booking', $data);
        $this->load->view('include/footer', $data);
    }




    public function export_booking() {

        $data['page_title'] = "Export Booking Details";
        $data['get_booking'] = "";
        if (isset($_POST['export_booking'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
			$this->form_validation->set_rules('Import_date_from', 'Date', 'trim|required');
            $this->form_validation->set_rules('Import_date_to', 'Date', 'trim|required');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $this->session->set_userdata('exp_prefix', $_POST['prefix']);
                $this->session->set_userdata('exp_partyname', $_POST['partyname']);
				$this->session->set_userdata('exp_impdate', $_POST['Import_date_from']);
                $this->session->set_userdata('exp_impdate', $_POST['Import_date_to']);
				//echo $_POST['Import_date'];exit();
                $data['get_booking'] = $this->issueregister_model->get_booking($_POST['partyname'], $_POST['prefix'], $_POST['Import_date_from'],$_POST['Import_date_to']);
                //$data['notif'] = $this->issueregister_model->export_booking();
            }
        } else {
            $data['get_booking'] = $this->issueregister_model->get_booking(1, 1, '2019-06-10');
        }

        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/export_booking', $data);
        $this->load->view('include/footer', $data);
    }

    public function exportCSV() {
        $usersData = $this->issueregister_model->get_booking1($this->session->userdata('exp_partyname'), $this->session->userdata('exp_prefix'), $this->session->userdata('exp_impdate'));
		
		$filename = 'Export_consign' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        $file = fopen('php://output', 'w');
        fputcsv($file, array('Consignment_No','Reference_No', 'Consignee_Name', 'Consignee_Address1',
            'Consignee_Address2', 'Consignee_Address3', 'Consignee_Place',
            'Consignee_Pincode', 'Consignee_Weight', 'No_Of_Pieces', 'Date'));
        foreach ($usersData as $key => $line) {
						$var = array($line['Consignment_No'],
						$line['Reference_No'],
						$line['Consignee_Name'],
						$line['Consignee_Address1'],
						$line['Consignee_Address2'],
						$line['Consignee_Address3'],
						$line['Consignee_Place'],
						$line['Consignee_Pincode'],
						$line['Consignee_Weight'],
						$line['No_Of_Pieces'],
						substr($line['Created_date'], 0, 10));
		    fputcsv($file, $var);
        }
        fclose($file);
        exit;
    }
	
	public function get_sabya($party_id, $prefix_id) {
	//	$this->db->select('issuereg_Id, Consignment_No, Consignee_Name');
        $this->db->select('Consignment_No, Consignee_Name, Consignee_Address1, Consignee_Address2, Consignee_Address3, Consignee_Place, Consignee_Pincode, Consignee_Weight, No_Of_Pieces');
        $this->db->from('Issue_register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
        $this->db->where('Consignee_Name != ', NULL);
        $this->db->where('is_printed =', 1);
		$this->db->order_by('Issuereg_Id', 'DESC');
		$this->db->limit(4100); 
        $query = $this->db->get();

        return $query->result_array();
    }
	
	public function referencenumber123(){
		
        $this->session->unset_userdata('impref_prefix');
        $this->session->unset_userdata('impref_partyname');
        $data['page_title'] = "Import Reference Numbers";
        $data['imp_avail_qty'] = "";

        if (isset($_POST['import_consignment'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');

            $this->session->set_userdata('impref_prefix', $_POST['prefix']);
            $this->session->set_userdata('impref_partyname', $_POST['partyname']);
            if (empty($_FILES['excel_file']['name'])) {
                $this->form_validation->set_rules('excel_file', 'Excel File', 'trim|required');
            }
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['notif'] = $this->issueregister_model->import_reference_no();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/import_reference_number', $data);
        $this->load->view('include/footer', $data);
	}
	
	public function referencenumber() {
        $this->session->unset_userdata('impref_prefix');
        $this->session->unset_userdata('impref_partyname');
        $data['page_title'] = "Import Reference Booking Details";
        $data['imp_avail_qty'] = "";

        if (isset($_POST['import_consignment'])) {

            $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
            $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');

            $this->session->set_userdata('impref_prefix', $_POST['prefix']);
            $this->session->set_userdata('impref_partyname', $_POST['partyname']);
            if (empty($_FILES['excel_file']['name'])) {
                $this->form_validation->set_rules('excel_file', 'Excel File', 'trim|required');
            }
            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            } else {
                $data['notif'] = $this->issueregister_model->import_reference_no();
            }
        }
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/import_reference_number', $data);
        $this->load->view('include/footer', $data);
    }
	
	public function singleconsignmentbooking() 
    {
        //$this->session->unset_userdata('single_prefix');
        //$this->session->unset_userdata('single_partyname');
		if (isset($_SESSION['message'])) 
        {
            unset($_SESSION['message']);
            unset($_SESSION['type']);
        }
        $data['page_title'] = "Issue Register";
        $data['single_avail_qty'] = "";
		//$this->session->set_userdata('single_prefix', $_POST['prefix']);
        //$this->session->set_userdata('single_partyname', $_POST['partyname']);
        $data['last_consin_no'] = $this->issueregister_model->get_consign_no_by_insid();
        $data['get_place'] =  $this->issueregister_model->get_all_place();
		if(isset($_POST['single_booking'])) {
			
            if (isset($_SESSION['message'])) {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
			//echo "SABBYASAAAAA";exit();
        $this->session->unset_userdata('chk_con_no');  
                $this->load->helper('security');
               // $this->form_validation->set_rules('prefix', 'Prefix', 'trim|required');
               // $this->form_validation->set_rules('partyname', 'Party Name', 'trim|required');
				$this->form_validation->set_rules('consignment_no', 'Consignee No', 'trim|required|max_length[25]|min_length[3]|alpha_numeric_spaces');
                $this->form_validation->set_rules('consignee_name', 'Consignee Name', 'trim|required|max_length[50]|min_length[3]');
				//$this->form_validation->set_rules('reference_no', 'Reference No', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address1', 'Address Lane 1', 'trim|required|max_length[25]|min_length[3]');
                //$this->form_validation->set_rules('address2', 'Address Lane 2', 'trim|required|max_length[25]|min_length[3]');
                // $this->form_validation->set_rules('Phone', 'Phone', 'trim|required|max_length[10]|min_length[10]');
                $this->form_validation->set_rules('place', 'place', 'trim|required|max_length[25]|min_length[3]');
                $this->form_validation->set_rules('pincode', 'pincode', 'trim|required|max_length[6]|min_length[6]|numeric');
                //  $this->form_validation->set_rules('service', 'Service', 'trim|required|max_length[15]|min_length[1]');
                // $this->form_validation->set_rules('date', 'Date', 'trim|required');
                $this->form_validation->set_rules('weight', 'weight', 'trim|required|max_length[10]|min_length[1]|numeric');
                $this->form_validation->set_rules('pieces', 'pieces', 'trim|required|max_length[10]|min_length[1]|numeric');
                if ($this->form_validation->run() == false) {
                    $data['notif']['message'] = validation_errors();
                    $data['notif']['type'] = 'danger';
                } else {
					 $data['notif'] = $this->issueregister_model->single_con_booking();
                }
            
        }
		
		
        $data['consign_data'] = "";
        if (isset($_POST['check_booking']))
        {
            if (isset($_SESSION['message'])) 
            {
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            }
            $this->load->helper('security');

            $this->form_validation->set_rules('consignee_no', 'Consignment No', 'trim|required|max_length[25]|min_length[5]|alpha_numeric_spaces');

            if ($this->form_validation->run() == false) {
                $data['notif']['message'] = validation_errors();
                $data['notif']['type'] = 'danger';
            }
            else 
            {
                $consignee_no = substr($_POST['consignee_no'], 3);
                $this->session->set_userdata('chk_con_no', $consignee_no);
                $data['consign_data'] = $this->issueregister_model->check_consign1($this->session->userdata('chk_con_no'));				
			}
        }
        $data['page_title'] = "Single Consignment Booking";
        $data['get_party'] = $this->party_model->get_all_party();
        $data['get_prefix'] = $this->issueregister_model->get_all_prefix();
        $this->load->view('include/header', $data);
        $this->load->view('include/nav', $data);
        $this->load->view('issueregister/single_con_booking', $data);
       // $this->load->view('include/footer', $data);
    }
	
	public function pintu(){
		$this->load->view('issueregister/user_view');
	}
	
	public function placeList(){
    // POST data
    $postData = $this->input->post();

    // get data
    $data = $this->issueregister_model->getPlace($postData);

    echo json_encode($data);
  }

}
