<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Printt_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->helper('download');
        $this->load->database();
    }

    public function get_all_prefix() {
        $this->db->from('Prefix_Master');
        $this->db->order_by("Prefix_Name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function add() {
        $notif = array();


        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');
        $prefix = $this->get_prefix_by_id($pre_fix_id);

        for ($i = $from; $i <= $to; $i++) {
            $consign_no = $prefix->Prefix_Name . $i;
            $data = array(
                'Party_Id' => $prtyid,
                'Consignment_No' => $consign_no,);
            $this->db->insert('Issue_Register_Master', $data);
            $ins_id[] = $this->db->insert_id();
        }
        if ($ins_id) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/issueregister'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function get_prefix_by_id($id) {
        $this->db->from('Prefix_Master');
        $this->db->where('Prefix_Id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_issue_by_consin_no($id) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Consignment_No', $id);
        $query = $this->db->get();
				return $query->row();
		
    }

    public function get_issue_by_ref_no($id) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Reference_No', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_consigndetail_by_id($id, $prtyid) {
        $query = $this->db->query('SELECT * FROM Issue_Register_Master '
                . 'inner join Party_Master on(Issue_Register_Master.Party_id = Party_Master.Party_id) '
                . 'WHERE Issuereg_Id = ' . $id . ' and '
                . 'Issue_Register_Master.Party_id = ' . $prtyid . '');

        foreach ($query->result() as $row) {
            
        }
        return $row;
    }

    public function get_consigndetail_by_id_1($id, $prtyid) {
        $query = $this->db->query('SELECT * FROM Issue_Register_Master as irm '
                . 'inner join Party_Master as pm on(irm.Party_id = pm.Party_id) '
                . 'WHERE irm.Issuereg_Id = ' . $id . ' '
                . 'and pm.Party_id = ' . $prtyid . ' '
                . 'and Consignee_Name IS not NULL and is_printed = 0');

        foreach ($query->result() as $row) {
            if ($query->num_rows() > 0) {
                $value = $row;
                return $row;
            }
        }
    }

    public function get_consigndetail_by_id_2($id, $prtyid) {
        $query = $this->db->query('SELECT * FROM Issue_Register_Master as irm '
                . 'inner join Party_Master as pm on(irm.Party_id = pm.Party_id) '
                . 'WHERE irm.Issuereg_Id = ' . $id . ' '
                . 'and pm.Party_id = ' . $prtyid . ' '
                . 'and Consignee_Name IS not NULL');

        foreach ($query->result() as $row) {
            if ($query->num_rows() > 0) {
                $value = $row;
                return $row;
            }
        }
    }

    public function printt() {
	//ECHO 	"sabyasasasa"; exit();
        $chek_barcode = $this->input->post('withbarcode');
        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');

        $prefix = $this->get_prefix_by_id($pre_fix_id)->Prefix_Name;
        $consign_rows = $this->get_consign_range($from, $to);
        $avl_qty = $this->session->userdata('pri_avail_qty');

        if ($avl_qty == 0) {
            $this->session->set_flashdata('message', 'There is no consignment quantity available to print!');
            $this->session->set_flashdata('type', 'danger');
        } elseif ($consign_rows == 0) {
            if ($from == "" && $to == "") {
				$this->session->set_flashdata('message', 'Please fill from and to range');
                $this->session->set_flashdata('type', 'danger');
            } elseif ($from == "" || $to == "") {    // for null values   
                $this->session->set_flashdata('message', 'Alternate Consignment No is null');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_flashdata('message', 'These is no consignment Nos in this range !');
                $this->session->set_flashdata('type', 'danger');
            }
        } elseif ($consign_rows >= 10001) {
            $this->session->set_flashdata('message', 'more then 10000 is not allowed');
            $this->session->set_flashdata('type', 'danger');
        } else {
			//Get the issuereg_id from consign_no//
			$frm_ir_id = $this->get_issueregId($from);
			$to_ir_id = $this->get_issueregId($to);
			
			$consign_range = $this->get_consign_range_result($frm_ir_id, $to_ir_id);
			$files = 'uploads/files/consign_print.txt';
            $f = fopen($files, "w");
            foreach ($consign_range as $range) {
				
                $consignment = $this->get_consigndetail_by_id_1($range->Issuereg_Id, $prtyid);
				if ($consignment) {
                    $this->printed_consign($range->Issuereg_Id);
                    $consign_data = date("d/m/y", strtotime($consignment->Created_date));

                    $carray = array($consignment->Party_Name, $consignment->Party_Address1, $consignment->Party_Address2, $consignment->Party_Address3,
                        $consignment->Consignee_Name, $consignment->Consignee_Address1, $consignment->Consignee_Pincode, $consignment->Consignee_Place, $consignment->Reference_No);


                    $var0 = strlen($carray[0]);

                    if ($var0 >= 25) {
                        $var0 = 25;
                    }
                    $length0 = (25 - $var0);
                    $strarr0 = $carray[0] . str_repeat(' ', $length0);
                    //////////////////
                    $var1 = strlen($carray[1]);

                    if ($var1 >= 25) {
                        $var1 = 25;
                    }
                    $length1 = (25 - $var1);
                    $strarr1 = $carray[1] . str_repeat(' ', $length1);
                    ////////////////////////////
                    $var2 = strlen($carray[2]);

                    if ($var2 >= 25) {
                        $var2 = 25;
                    }
                    $length2 = (25 - $var2);
                    $strarr2 = $carray[2] . str_repeat(' ', $length2);
                    ////////////////////////
                    $var3 = strlen($carray[3]);

                    if ($var3 >= 25) {
                        $var3 = 25;
                    }
                    $length3 = (25 - $var3);
                    $strarr3 = $carray[3] . str_repeat(' ', $length3);
                    //////////////////
                    $var4 = strlen($carray[4]);

                    if ($var4 >= 25) {
                        $var4 = 25;
                    }
                    $length4 = (25 - $var4);
                    $strarr4 = $carray[4] . str_repeat(' ', $length4);
                    //////////////////////////
                    $var5 = strlen($carray[5]);

                    if ($var5 >= 25) {
                        $var5 = 25;
                    }
                    $length5 = (25 - $var5);
                    $strarr5 = $carray[5] . str_repeat(' ', $length5);
                    ///////////////////
                    $var6 = strlen($carray[6]);

                    if ($var6 >= 25) {
                        $var6 = 25;
                    }
                    $length6 = (25 - $var6);
                    $strarr6 = $carray[6] . str_repeat(' ', $length6);
                    ////////////////////

                    $var7 = strlen($carray[7]);

                    if ($var7 >= 25) {
                        $var7 = 25;
                    }
                    $length7 = (25 - $var7);
                    $strarr7 = $carray[7] . str_repeat(' ', $length7);
                    /////////////////////
					$strarr80 = $carray[8];


                    $strarr0 = substr($strarr0, 0, 25);
                    $strarr1 = substr($strarr1, 0, 25);
                    $strarr2 = substr($strarr2, 0, 25);
                    $strarr3 = substr($strarr3, 0, 25);
                    $strarr4 = substr($strarr4, 0, 21);
                    $strarr5 = substr($strarr5, 0, 21);
                    $strarr6 = substr($strarr6, 0, 21);
                    $strarr7 = substr($strarr7, 0, 21);
                    $strarr8 = substr($consignment->Consignment_No, 0, 18);
					
					$sabya1 = substr($consignment->No_Of_Pieces, 0, 5);
					$sabya2 = substr($consignment->Consignee_Weight, 0, 5);
					
                    $strarr9 = preg_replace('/\s+/', '', $prefix . $consignment->Consignment_No);
                    $barcode = '|};cD;"' . $strarr9 . '";N0;0001;0002;H04;D';
                    $str = str_repeat(' ', 63);
                    $str6 = str_repeat(' ', 5);
                    $str3 = str_repeat(' ', 5);
                    $var = 'uploads/files/code.';
                    fwrite($f, "                     $strarr8                        $consign_data \n");
                    fwrite($f, "$str \n");
                    fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $sabya1 \n");
                    fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $sabya2 \n");
                    fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
                    fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
                    fwrite($f, " \n");
					//fwrite($f, " \n");
					fwrite($f, "      $strarr80 \n");
                    if ($chek_barcode) {
                        fwrite($f, "\n\n\n$barcode");
                    } else {
                        fwrite($f, "\n\n\n\n");
                    }
                    fwrite($f, "\n\n\n\n\n\n\n\n\n\n\n\n\n");
                    //fwrite($f, "       118IPL0084260718            520013                            \n");
                }
				//echo "<pre />";
				//print_r($consignment);
            }//exit();
         //   fclose($f);
            //  $this->export_sticker($prtyid, $pre_fix_id, $from, $to);
            force_download('uploads/files/consign_print.txt', NULL);

            //exit();
            $this->session->set_flashdata('message', 'Printted');
            $this->session->set_flashdata('type', 'success');

            redirect(base_url('/printt'));

            /////file edit end/////
        }
    }


public function printt222() {
	//ECHO 	"sabyasasasa"; exit();
        $chek_barcode = $this->input->post('withbarcode');
        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');

        $prefix = $this->get_prefix_by_id($pre_fix_id)->Prefix_Name;
        $consign_rows = $this->get_consign_range($from, $to);
        $avl_qty = $this->session->userdata('pri_avail_qty');

        if ($avl_qty == 0) {
            $this->session->set_flashdata('message', 'There is no consignment quantity available to print!');
            $this->session->set_flashdata('type', 'danger');
        } elseif ($consign_rows == 0) {
            if ($from == "" && $to == "") {
				$this->session->set_flashdata('message', 'Please fill from and to range');
                $this->session->set_flashdata('type', 'danger');
            } elseif ($from == "" || $to == "") {    // for null values   
                $this->session->set_flashdata('message', 'Alternate Consignment No is null');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_flashdata('message', 'These is no consignment Nos in this range !');
                $this->session->set_flashdata('type', 'danger');
            }
        } elseif ($consign_rows >= 10001) {
            $this->session->set_flashdata('message', 'more then 10000 is not allowed');
            $this->session->set_flashdata('type', 'danger');
        } else {
			//Get the issuereg_id from consign_no//
			$frm_ir_id = $this->get_issueregId($from);
			$to_ir_id = $this->get_issueregId($to);
			
			$consign_range = $this->get_consign_range_result($frm_ir_id, $to_ir_id);
			$files = 'uploads/files/consign_print.txt';
            $f = fopen($files, "w");
            foreach ($consign_range as $range) {
				
                $consignment = $this->get_consigndetail_by_id_1($range->Issuereg_Id, $prtyid);
				if ($consignment) {
                    $this->printed_consign($range->Issuereg_Id);
                    $consign_data = date("d/m/y", strtotime($consignment->Created_date));

                    $carray = array($consignment->Party_Name, $consignment->Party_Address1, $consignment->Party_Address2, $consignment->Party_Address3,
                        $consignment->Consignee_Name, $consignment->Consignee_Address1, $consignment->Consignee_Pincode, $consignment->Consignee_Place, $consignment->Reference_No);


                    $var0 = strlen($carray[0]);

                    if ($var0 >= 25) {
                        $var0 = 25;
                    }
                    $length0 = (25 - $var0);
                    $strarr0 = $carray[0] . str_repeat('+', $length0);
                    //////////////////
                    $var1 = strlen($carray[1]);

                    if ($var1 >= 25) {
                        $var1 = 25;
                    }
                    $length1 = (25 - $var1);
                    $strarr1 = $carray[1] . str_repeat('+', $length1);
                    ////////////////////////////
                    $var2 = strlen($carray[2]);

                    if ($var2 >= 25) {
                        $var2 = 25;
                    }
                    $length2 = (25 - $var2);
                    $strarr2 = $carray[2] . str_repeat('+', $length2);
                    ////////////////////////
                    $var3 = strlen($carray[3]);

                    if ($var3 >= 25) {
                        $var3 = 25;
                    }
                    $length3 = (25 - $var3);
                    $strarr3 = $carray[3] . str_repeat('+', $length3);
                    //////////////////
                    $var4 = strlen($carray[4]);

                    if ($var4 >= 25) {
                        $var4 = 25;
                    }
                    $length4 = (25 - $var4);
                    $strarr4 = $carray[4] . str_repeat('+', $length4);
                    //////////////////////////
                    $var5 = strlen($carray[5]);

                    if ($var5 >= 25) {
                        $var5 = 25;
                    }
                    $length5 = (25 - $var5);
                    $strarr5 = $carray[5] . str_repeat('+', $length5);
                    ///////////////////
                    $var6 = strlen($carray[6]);

                    if ($var6 >= 25) {
                        $var6 = 25;
                    }
                    $length6 = (25 - $var6);
                    $strarr6 = $carray[6] . str_repeat('+', $length6);
                    ////////////////////

                    $var7 = strlen($carray[7]);

                    if ($var7 >= 25) {
                        $var7 = 25;
                    }
                    $length7 = (25 - $var7);
                    $strarr7 = $carray[7] . str_repeat('+', $length7);
                    /////////////////////
					$strarr80 = $carray[8];


                    $strarr0 = substr($strarr0, 0, 25);
                    $strarr1 = substr($strarr1, 0, 25);
                    $strarr2 = substr($strarr2, 0, 25);
                    $strarr3 = substr($strarr3, 0, 25);
                    $strarr4 = substr($strarr4, 0, 21);
                    $strarr5 = substr($strarr5, 0, 21);
                    $strarr6 = substr($strarr6, 0, 21);
                    $strarr7 = substr($strarr7, 0, 21);
                    $strarr8 = substr($consignment->Consignment_No, 0, 18);
					
					$sabya1 = substr($consignment->No_Of_Pieces, 0, 5);
					$sabya2 = substr($consignment->Consignee_Weight, 0, 5);
					
                    $strarr9 = preg_replace('/\s+/', '', $prefix . $consignment->Consignment_No);
                    $barcode = '|};cD;"' . $strarr9 . '";N0;0001;0002;H04;D';
                    $str = str_repeat('-', 63);
                    $str6 = str_repeat('-', 5);
                    $str3 = str_repeat('-', 5);
                    $var = 'uploads/files/code.';
					
					//print_r($str6. $strarr0. $str6. $strarr4. $str6. $consignment->No_Of_Pieces );exit();
					
					
                    fwrite($f, "                     $strarr8                        $consign_data \n");
                    fwrite($f, "$str \n");
                    fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $sabya1 \n");
                    fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $sabya2 \n");
                    fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
                    fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
                    fwrite($f, " \n");
					//fwrite($f, " \n");
					fwrite($f, "      $strarr80 \n");
                    if ($chek_barcode) {
                        fwrite($f, "\n\n\n$barcode");
                    } else {
                        fwrite($f, "\n\n\n\n");
                    }
                    fwrite($f, "\n\n\n\n\n\n\n\n\n\n\n\n\n");
                    //fwrite($f, "       118IPL0084260718            520013                            \n");
                }
				//echo "<pre />";
				//print_r($consignment);
            }//exit();
         //   fclose($f);
            //  $this->export_sticker($prtyid, $pre_fix_id, $from, $to);
            force_download('uploads/files/consign_print.txt', NULL);

            //exit();
            $this->session->set_flashdata('message', 'Printted');
            $this->session->set_flashdata('type', 'success');

            redirect(base_url('/printt'));

            /////file edit end/////
        }
    }


public function reprint111() {
	//ECHO 	"sabyasasasa"; exit();
        $chek_barcode = $this->input->post('withbarcode');
        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');

        $prefix = $this->get_prefix_by_id($pre_fix_id)->Prefix_Name;
        $consign_rows = $this->get_consign_range($from, $to);
        $avl_qty = $this->session->userdata('pri_avail_qty');
		//ECHO 	"sabyasasasa"; exit();
        if ($avl_qty == 0) {
            $this->session->set_flashdata('message', 'There is no consignment quantity available to print!');
            $this->session->set_flashdata('type', 'danger');
        } elseif ($consign_rows == 0) {
            if ($from == "" && $to == "") {
				$this->session->set_flashdata('message', 'Please fill from and to range');
                $this->session->set_flashdata('type', 'danger');
            } elseif ($from == "" || $to == "") {    // for null values   
                $this->session->set_flashdata('message', 'Alternate Consignment No is null');
                $this->session->set_flashdata('type', 'danger');
            } else {
                $this->session->set_flashdata('message', 'These is no consignment Nos in this range !');
                $this->session->set_flashdata('type', 'danger');
            }
        } elseif ($consign_rows >= 10001) {
            $this->session->set_flashdata('message', 'more then 10000 is not allowed');
            $this->session->set_flashdata('type', 'danger');
        } else {
			//Get the issuereg_id from consign_no//
			$frm_ir_id = $this->get_issueregId($from);
			$to_ir_id = $this->get_issueregId($to);
			
			$consign_range = $this->get_consign_range_result($frm_ir_id, $to_ir_id);
			$files = 'uploads/files/consign_print.txt';
            $f = fopen($files, "w");
            foreach ($consign_range as $range) {
				
                $consignment = $this->get_consigndetail_by_id_1($range->Issuereg_Id, $prtyid);
				if ($consignment) {
                    $this->printed_consign($range->Issuereg_Id);
                    $consign_data = date("d/m/y", strtotime($consignment->Created_date));

                    $carray = array($consignment->Party_Name, $consignment->Party_Address1, $consignment->Party_Address2, $consignment->Party_Address3,
                        $consignment->Consignee_Name, $consignment->Consignee_Address1, $consignment->Consignee_Pincode, $consignment->Consignee_Place, $consignment->Reference_No);


                    $var0 = strlen($carray[0]);

                    if ($var0 >= 25) {
                        $var0 = 25;
                    }
                    $length0 = (25 - $var0);
                    $strarr0 = $carray[0] . str_repeat(' ', $length0);
                    //////////////////
                    $var1 = strlen($carray[1]);

                    if ($var1 >= 25) {
                        $var1 = 25;
                    }
                    $length1 = (25 - $var1);
                    $strarr1 = $carray[1] . str_repeat(' ', $length1);
                    ////////////////////////////
                    $var2 = strlen($carray[2]);

                    if ($var2 >= 25) {
                        $var2 = 25;
                    }
                    $length2 = (25 - $var2);
                    $strarr2 = $carray[2] . str_repeat(' ', $length2);
                    ////////////////////////
                    $var3 = strlen($carray[3]);

                    if ($var3 >= 25) {
                        $var3 = 25;
                    }
                    $length3 = (25 - $var3);
                    $strarr3 = $carray[3] . str_repeat(' ', $length3);
                    //////////////////
                    $var4 = strlen($carray[4]);

                    if ($var4 >= 25) {
                        $var4 = 25;
                    }
                    $length4 = (25 - $var4);
                    $strarr4 = $carray[4] . str_repeat(' ', $length4);
                    //////////////////////////
                    $var5 = strlen($carray[5]);

                    if ($var5 >= 25) {
                        $var5 = 25;
                    }
                    $length5 = (25 - $var5);
                    $strarr5 = $carray[5] . str_repeat(' ', $length5);
                    ///////////////////
                    $var6 = strlen($carray[6]);

                    if ($var6 >= 25) {
                        $var6 = 25;
                    }
                    $length6 = (25 - $var6);
                    $strarr6 = $carray[6] . str_repeat(' ', $length6);
                    ////////////////////

                    $var7 = strlen($carray[7]);

                    if ($var7 >= 25) {
                        $var7 = 25;
                    }
                    $length7 = (25 - $var7);
                    $strarr7 = $carray[7] . str_repeat(' ', $length7);
                    /////////////////////
					$strarr80 = $carray[8];


                    $strarr0 = substr($strarr0, 0, 25);
                    $strarr1 = substr($strarr1, 0, 25);
                    $strarr2 = substr($strarr2, 0, 25);
                    $strarr3 = substr($strarr3, 0, 25);
                    $strarr4 = substr($strarr4, 0, 21);
                    $strarr5 = substr($strarr5, 0, 21);
                    $strarr6 = substr($strarr6, 0, 21);
                    $strarr7 = substr($strarr7, 0, 21);
                    $strarr8 = substr($consignment->Consignment_No, 0, 18);
                    $strarr9 = preg_replace('/\s+/', '', $prefix . $consignment->Consignment_No);
                    $barcode = '|};cD;"' . $strarr9 . '";N0;0001;0002;H04;D';
                    $str = str_repeat(' ', 63);
                    $str6 = str_repeat(' ', 5);
                    $str3 = str_repeat(' ', 5);
                    $var = 'uploads/files/code.';
                    fwrite($f, "                     $strarr8                        $consign_data \n");
                    fwrite($f, "$str \n");
                    fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $consignment->No_Of_Pieces \n");
                    fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $consignment->Consignee_Weight \n");
                    fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
                    fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
                    fwrite($f, " \n");
					//fwrite($f, " \n");
					fwrite($f, "      $strarr80 \n");
                    if ($chek_barcode) {
                        fwrite($f, "\n\n\n$barcode");
                    } else {
                        fwrite($f, "\n\n\n\n");
                    }
                    fwrite($f, "\n\n\n\n\n\n\n\n\n\n\n\n\n");
                    //fwrite($f, "       118IPL0084260718            520013                            \n");
                }
				//echo "<pre />";
				//print_r($consignment);
            }//exit();
         //   fclose($f);
            //  $this->export_sticker($prtyid, $pre_fix_id, $from, $to);
            force_download('uploads/files/consign_print.txt', NULL);

            //exit();
            $this->session->set_flashdata('message', 'Printted');
            $this->session->set_flashdata('type', 'success');

            redirect(base_url('/printt'));

            /////file edit end/////
        }
    }

    public function printed_consign($i) {
        $data = array(
            'is_printed' => 1);

        // Update //
        $this->db->where('issuereg_id', $i);
        $this->db->update('Issue_register_master', $data);
        // end Update //
    }

    public function get_all_consignment() {
        //   $this->db->select('tbl_user.username,tbl_user.userid,tbl_usercategory.type');
        $this->db->from('Issue_Register_Master');
        $this->db->join('Prefix_Master', 'Prefix_Master.Prefix_Id=Issue_Register_Master.Prefix_Id', 'inner');
        $this->db->join('Party_Master', 'Party_Master.Party_id=Issue_Register_Master.Party_Id', 'inner');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_qty_by_party_id($prtid, $preid) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $prtid);
        $this->db->where('Prefix_Id', $preid);
        $this->db->where('Consignee_Name != ', NULL);
        $query = $this->db->get();
        return $query->result();
    }

    public function get_qty_($prtid, $preid) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $prtid);
        $this->db->where('Prefix_Id', $preid);
        $this->db->where('is_printed =', 0);
        $this->db->where('Consignee_Name != ', NULL);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function reprint() {
        $chek_barcode = $this->input->post('withbarcode');
        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');
        $prefix = $this->get_prefix_by_id($pre_fix_id)->Prefix_Name;

        $from_id = $this->get_issue_by_consin_no($from);
        $to_id = $this->get_issue_by_consin_no($to);
		
		
        if ($this->session->userdata('repri_avail_qty') != 0) {
            if (empty($from) || empty($to)) {
				$this->session->set_flashdata('message', 'Please fill from and to range');
                $this->session->set_flashdata('type', 'danger');
				} else {
                /////file edit  start/////
				$frm_ir_id = $this->get_issueregId($from);
			$to_ir_id = $this->get_issueregId($to);
			
			$consign_range = $this->get_consign_range_result($frm_ir_id, $to_ir_id);
			
                $files = 'uploads/files/reconsign_print.txt';

                $f = fopen($files, "w");
                foreach ($consign_range as $range) {
				
                $consignment = $this->get_consigndetail_by_id_2($range->Issuereg_Id, $prtyid);
				if ($consignment) {
                    $this->printed_consign($range->Issuereg_Id);
                    $consign_data = date("d/m/y", strtotime($consignment->Created_date));

                    $carray = array($consignment->Party_Name, $consignment->Party_Address1, $consignment->Party_Address2, $consignment->Party_Address3,
                        $consignment->Consignee_Name, $consignment->Consignee_Address1, $consignment->Consignee_Pincode, $consignment->Consignee_Place, $consignment->Reference_No);


                    $var0 = strlen($carray[0]);

                    if ($var0 >= 25) {
                        $var0 = 25;
                    }
                    $length0 = (25 - $var0);
                    $strarr0 = $carray[0] . str_repeat(' ', $length0);
                    //////////////////
                    $var1 = strlen($carray[1]);

                    if ($var1 >= 25) {
                        $var1 = 25;
                    }
                    $length1 = (25 - $var1);
                    $strarr1 = $carray[1] . str_repeat(' ', $length1);
                    ////////////////////////////
                    $var2 = strlen($carray[2]);

                    if ($var2 >= 25) {
                        $var2 = 25;
                    }
                    $length2 = (25 - $var2);
                    $strarr2 = $carray[2] . str_repeat(' ', $length2);
                    ////////////////////////
                    $var3 = strlen($carray[3]);

                    if ($var3 >= 25) {
                        $var3 = 25;
                    }
                    $length3 = (25 - $var3);
                    $strarr3 = $carray[3] . str_repeat(' ', $length3);
                    //////////////////
                    $var4 = strlen($carray[4]);

                    if ($var4 >= 25) {
                        $var4 = 25;
                    }
                    $length4 = (25 - $var4);
                    $strarr4 = $carray[4] . str_repeat(' ', $length4);
                    //////////////////////////
                    $var5 = strlen($carray[5]);

                    if ($var5 >= 25) {
                        $var5 = 25;
                    }
                    $length5 = (25 - $var5);
                    $strarr5 = $carray[5] . str_repeat(' ', $length5);
                    ///////////////////
                    $var6 = strlen($carray[6]);

                    if ($var6 >= 25) {
                        $var6 = 25;
                    }
                    $length6 = (25 - $var6);
                    $strarr6 = $carray[6] . str_repeat(' ', $length6);
                    ////////////////////

                    $var7 = strlen($carray[7]);

                    if ($var7 >= 25) {
                        $var7 = 25;
                    }
                    $length7 = (25 - $var7);
                    $strarr7 = $carray[7] . str_repeat(' ', $length7);
                    /////////////////////
					$strarr80 = $carray[8];


                    $strarr0 = substr($strarr0, 0, 25);
                    $strarr1 = substr($strarr1, 0, 25);
                    $strarr2 = substr($strarr2, 0, 25);
                    $strarr3 = substr($strarr3, 0, 25);
                    $strarr4 = substr($strarr4, 0, 21);
                    $strarr5 = substr($strarr5, 0, 21);
                    $strarr6 = substr($strarr6, 0, 21);
                    $strarr7 = substr($strarr7, 0, 21);
                    $strarr8 = substr($consignment->Consignment_No, 0, 18);
					
					$sabya1 = substr($consignment->No_Of_Pieces, 0, 5);
					$sabya2 = substr($consignment->Consignee_Weight, 0, 5);
					
                    $strarr9 = preg_replace('/\s+/', '', $prefix . $consignment->Consignment_No);
                    $barcode = '|};cD;"' . $strarr9 . '";N0;0001;0002;H04;D';
                    $str = str_repeat(' ', 63);
                    $str6 = str_repeat(' ', 5);
                    $str3 = str_repeat(' ', 5);
                    $var = 'uploads/files/code.';
                    fwrite($f, "                     $strarr8                        $consign_data \n");
                    fwrite($f, "$str \n");
                    fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $sabya1 \n");
                    fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $sabya2 \n");
                    fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
                    fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
                    fwrite($f, " \n");
					//fwrite($f, " \n");
					fwrite($f, "      $strarr80 \n");
                    if ($chek_barcode) {
                        fwrite($f, "\n\n\n$barcode");
                    } else {
                        fwrite($f, "\n\n\n\n");
                    }
                    fwrite($f, "\n\n\n\n\n\n\n\n\n\n\n\n\n");
                    //fwrite($f, "       118IPL0084260718            520013                            \n");
                }
				//echo "<pre />";
				//print_r($consignment);
            }
                fclose($f);
				////////////
                $this->session->set_flashdata('message', 'Printted');
                $this->session->set_flashdata('type', 'success');
                $this->force_download_txt('uploads/files/reconsign_print.txt');
                redirect(base_url('/printt/reprint'));
                /////file edit end/////
            }
        } else {
            $this->session->set_flashdata('message', 'No Consignments are available to print !');
            $this->session->set_flashdata('type', 'danger');
            redirect(base_url('/printt/reprint'));
        }
    }

    
    public function force_download_txt($param) {
        force_download($param, NULL);
    }

    public function get_consign_range($from, $to) {
        $this->db->from('Issue_Register_Master');
        //$this->db->where('Consignment_No', $id);
        $this->db->where('Consignment_No >=', $from);
        $this->db->where('Consignment_No <=', $to);
        $query = $this->db->get();
        //print_r($query->result());
        return $query->num_rows();
    }

    public function get_consign_range_result($from, $to) {
        $this->db->select('Issuereg_Id');
        $this->db->select('Reference_No');
        $this->db->select('Consignment_No');
        $this->db->from('Issue_Register_Master');
        //$this->db->where('Consignment_No', $id);
        $this->db->where('Issuereg_Id >=', $from);
        $this->db->where('Issuereg_Id <=', $to);
		$this->db->order_by('Issuereg_Id', 'ASC');
        $query = $this->db->get();
		  return $query->result();
    }

    public function get_sticker($party_id, $prefix_id, $from, $to) {
        $this->db->select('Consignment_No');
	//	$this->db->select("CONCAT('Consignment_No', 'Consignee_Name')");
        $this->db->from('Issue_register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
        $this->db->where('Consignment_No >=', $from);
        $this->db->where('Consignment_No <=', $to);
        $this->db->where('Consignee_Name != ', NULL);
        //  $this->db->where('is_printed =', 1);
        $query = $this->db->get();
		
        return $query->result_array();
    }

    public function export_sticker($party_id, $prefix_id, $from, $to) {
        $usersData = $this->get_sticker($party_id, $prefix_id, $from, $to);
		
		
        $filename = 'consign_sticker' . date('Ymd') . '.csv';
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        $file = fopen('php://output', 'w');
        fputcsv($file, array('Consignment_No'));
        foreach ($usersData as $key => $line) {
			
            fputcsv($file, $line);
        }
        fclose($file);
        exit();
    }

	public function get_issueregId($id){
		$this->db->select('Issuereg_Id');
        $this->db->from('Issue_Register_Master');
        $this->db->where('Consignment_No', $id);
        $query = $this->db->get();
		
		foreach($query->result() as $row){
		
		}
		 return $row->Issuereg_Id;
	}
}
