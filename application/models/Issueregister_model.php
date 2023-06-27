<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Issueregister_model extends CI_Model {

    public $tot_colm = null;

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        //$this->load->helper('download');
        $this->load->database();
		
    }

    public function get_all_prefix() {
        $this->db->from('Prefix_Master');
        $this->db->order_by("Prefix_Name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    public function add() {  //issue register 
        $notif = array();
        $ins_id = array();
	//	echo "Sabya";exit();
        $pre_fix_id = $this->input->post('prefix');
        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');
        $prefix = $this->get_prefix_by_id($pre_fix_id);


        $chk_consign = $this->get_consignment_no($from, $to);

        $total = $to - $from;

        if ($from >= $to) {
            $notif['message'] = 'Check the consignment range !';
            $notif['type'] = 'danger';
        } elseif (count($chk_consign) > 0) {
            $notif['message'] = 'Consignment No from ' . reset($chk_consign)['Consignment_No'] . ' to ' . end($chk_consign)['Consignment_No'] . ' are already assigned !';
            $notif['type'] = 'danger';
        } elseif ($total >= 10000) {
            $notif['message'] = 'More then 10000 issues are not allowed !';
            $notif['type'] = 'danger';
        } else {
            for ($i = $from; $i <= $to; $i++) {
                $consign_no = $i;
                $data = array(
                    'Party_Id' => $prtyid,
                    'Prefix_Id' => $pre_fix_id,
                    'Consignment_No' => $consign_no,);
                $insert = $this->db->insert('Issue_Register_Master', $data);
                $ins_id[] = $this->db->insert_id();
            }if ($ins_id) {
                //unset($_POST);
                $this->session->set_flashdata('message', 'Saved successfully');
                $this->session->set_flashdata('type', 'success');
                redirect(base_url('/issueregister'));
            } else {
                $notif['message'] = 'Something wrong !';
                $notif['type'] = 'danger';
            }
        }
        return $notif;
    }

    public function get_prefix_by_id($id) {
        $this->db->from('Prefix_Master');
        $this->db->where('Prefix_Id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function Import_excel() {
        $data_excel = array();
        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('excel_file')) {
            $filename = $_FILES['excel_file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $this->tot_colm = $sheets['numCols'];


            for ($i = 2; $i <= $sheets['numRows']; $i++) {

                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['Consignee_Name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Consignee_Address1'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Consignee_Address2'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['Consignee_Address3'] = $sheets['cells'][$i][4];
                $data_excel[$i - 1]['Consignee_Place'] = $sheets['cells'][$i][5];
                $data_excel[$i - 1]['Consignee_Pincode'] = $sheets['cells'][$i][6];
                $data_excel[$i - 1]['Consignee_Weight'] = $sheets['cells'][$i][7];
                $data_excel[$i - 1]['No_Of_Pieces'] = $sheets['cells'][$i][8];
                $data_excel[$i - 1]['Consignment_No'] = $sheets['cells'][$i][9];
            }
        }
//        echo "sabya2";
//        exit();
        return $data_excel;
    }

    public function Import_reference_excel() {

        $data_excel = array();
        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('excel_file')) {
            $filename = $_FILES['excel_file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $this->tot_colm = $sheets['numCols'];

            for ($i = 2; $i <= $sheets['numRows']; $i++) {

                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['Consignee_Name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Consignee_Address1'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Consignee_Address2'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['Consignee_Address3'] = $sheets['cells'][$i][4];
                $data_excel[$i - 1]['Consignee_Place'] = $sheets['cells'][$i][5];
                $data_excel[$i - 1]['Consignee_Pincode'] = $sheets['cells'][$i][6];
                $data_excel[$i - 1]['Consignee_Weight'] = $sheets['cells'][$i][7];
                $data_excel[$i - 1]['No_Of_Pieces'] = $sheets['cells'][$i][8];
                $data_excel[$i - 1]['Consignment_No'] = $sheets['cells'][$i][9];
                $data_excel[$i - 1]['Reference_No'] = $sheets['cells'][$i][10];
            }
        }

        return $data_excel;
    }

public function Import_reference_nos() {
	//echo "sahu...";exit();
        $data_excel = array();
        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('excel_file')) {
            $filename = $_FILES['excel_file']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $this->tot_colm = $sheets['numCols'];

            for ($i = 2; $i <= $sheets['numRows']; $i++) {

                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['Consignee_Name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Consignee_Address1'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Consignee_Address2'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['Consignee_Address3'] = $sheets['cells'][$i][4];
                $data_excel[$i - 1]['Consignee_Place'] = $sheets['cells'][$i][5];
                $data_excel[$i - 1]['Consignee_Pincode'] = $sheets['cells'][$i][6];
                $data_excel[$i - 1]['Consignee_Weight'] = $sheets['cells'][$i][7];
                $data_excel[$i - 1]['No_Of_Pieces'] = $sheets['cells'][$i][8];
                $data_excel[$i - 1]['Reference_No'] = $sheets['cells'][$i][9];
             //   $data_excel[$i - 1]['Reference_No'] = $sheets['cells'][$i][10];
            }
        }

        return $data_excel;
    }


    public function consignment_import_old() {
        $notif = array();
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('importexcel');
        $prtyid = $this->input->post('partyname');

        $data_excel = $this->Import_excel();
        $data_excel_count = count($data_excel);
        $var = $this->get_qty_by_party_id1($prtyid, $pre_fix_id);

        $avl_qty = $this->session->userdata('imp_avail_qty');

        if ($avl_qty >= $data_excel_count) {
            $j = $var->Issuereg_Id;
            for ($i = 1; $i <= $data_excel_count; $i++) {
                $data = array(
                    'Consignee_Name' => $data_excel[$i]['Consignee_Name'],
                    'Consignee_Address1' => $data_excel[$i]['Consignee_Address1'],
                    'Consignee_Address2' => $data_excel[$i]['Consignee_Address2'],
                    'Consignee_Address3' => $data_excel[$i]['Consignee_Address3'],
                    'Consignee_Place' => $data_excel[$i]['Consignee_Place'],
                    'Consignee_Pincode' => $data_excel[$i]['Consignee_Pincode'],
                    'Created_by' => $this->session->userdata['logged_in']['users_id'],
                    'Consignee_Weight' => $data_excel[$i]['Consignee_Weight'],
                    'No_Of_Pieces' => $data_excel[$i]['No_Of_Pieces'],);

                //  Update //
                $this->db->where('issuereg_id', $j);
                $this->db->update('Issue_register_master', $data);
                //   end Update //
                $j++;
            }
            $this->session->set_flashdata('message', 'Saved successfully');
            $this->session->set_flashdata('type', 'success');
            unset($_POST);
            redirect(base_url('/issueregister/import'));
        } else {
            $notif['message'] = 'Excel row count should be less then availble quantity';
            $notif['type'] = 'danger';
        }



        return $notif;
    }

    public function consignment_import_old_jan21() {
        $notif = array();
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('importexcel');
        $prtyid = $this->input->post('partyname');
        $with_consign = $this->input->post('with_consign');

        $data_excel = $this->Import_excel();

        $data_excel_count = count($data_excel);
        $var = $this->get_qty_by_party_id1($prtyid, $pre_fix_id);
        $avl_qty = $this->session->userdata('imp_avail_qty');
        if ($with_consign) {
            echo "yes";
        } else {
            echo "No";
        }
        $tot_col = $data_excel['numCols'];
        echo $this->tot_colm;
        exit();
        if ($avl_qty >= $data_excel_count) {
            $j = $var->Issuereg_Id;
            for ($i = 1; $i <= $data_excel_count; $i++) {
                $data = array(
                    'Consignee_Name' => $data_excel[$i]['Consignee_Name'],
                    'Consignee_Address1' => $data_excel[$i]['Consignee_Address1'],
                    'Consignee_Address2' => $data_excel[$i]['Consignee_Address2'],
                    'Consignee_Address3' => $data_excel[$i]['Consignee_Address3'],
                    'Consignee_Place' => $data_excel[$i]['Consignee_Place'],
                    'Consignee_Pincode' => $data_excel[$i]['Consignee_Pincode'],
                    'Created_by' => $this->session->userdata['logged_in']['users_id'],
                    'Consignee_Weight' => $data_excel[$i]['Consignee_Weight'],
                    'No_Of_Pieces' => $data_excel[$i]['No_Of_Pieces'],);

                //  Update //
                $this->db->where('issuereg_id', $j);
                $this->db->update('Issue_register_master', $data);
                //   end Update //
                $j++;
            }
            $this->session->set_flashdata('message', 'Saved successfully');
            $this->session->set_flashdata('type', 'success');
            unset($_POST);
            redirect(base_url('/issueregister/import'));
        } else {
            $notif['message'] = 'Excel row count should be less then availble quantity';
            $notif['type'] = 'danger';
        }



        return $notif;
    }

    public function consignment_range($from, $to, $pre_fix_id, $prtyid, $prfx_final) {
        $FROM_VAL = $this->get_consignment_by_id_prefix($from, $pre_fix_id, $prtyid, $prfx_final);
        $to_VAL = $this->get_consignment_by_id_prefix($to, $pre_fix_id, $prtyid, $prfx_final);

        if ($FROM_VAL->Issuereg_id && $to_VAL->Issuereg_id) {
            $range = $to_VAL->Issuereg_id - $FROM_VAL->Issuereg_id + 1;
        } else {
            $range = 0;
        }

        return $range;
    }

    public function get_consignment_by_id($id) {
		
        $this->db->from('Issue_register_Master');
        $this->db->where('Consignment_No', $id);
        $query = $this->db->get();
        return $query->row();
    }
	
	public function get_consign_no_by_insid() {
		$ins = $this->session->userdata('ref_ins_id');
		$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Issuereg_id', $ins);
        $query = $this->db->get();
        return $query->row();
    }

    public function check_duplicate_ref_no($refe_no)
    {
        
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_consignment_by_id_prefix($id, $pre_fix_id, $prtyid, $prfx_final) {
        $ids = $id;
        $this->db->select('Issuereg_id');
        $array = array('Consignment_No' => $ids, 'Party_Id' => $prtyid, 'Prefix_Id' => $pre_fix_id);
        $this->db->from('Issue_register_Master');
        $this->db->where($array);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_qty_by_party_id($id, $pid) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $id);
        $this->db->where('Prefix_Id', $pid);
        $this->db->where('Consignee_Name = ', NULL);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_qty_($id, $pid) {
		$this->db->select('issuereg_Id');
        $this->db->from('Issue_Register_Master');
      $this->db->where('Party_Id', $id);
      $this->db->where('Prefix_Id', 1);
        $this->db->where('Consignee_Name != ', NULL);
        $query = $this->db->get();
	//	print_r($query->num_rows());exit();
		return $query->num_rows();
		
    }

    public function get_qty_1($id, $pid) {
		$this->db->select('issuereg_Id');
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $id);
        $this->db->where('Prefix_Id', $pid);
        $this->db->where('Consignee_Name != ', NULL);
        $this->db->where('is_printed = ', 0);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_qty_by_party_id1($id, $pid) {
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $id);
        $this->db->where('Prefix_Id', $pid);
        $this->db->where('Consignee_Name = ', NULL);
        $query = $this->db->get();
        return $query->row();
    }

    public function consignment_import() {
		//$date_sbbbb = $this->input->post('s_date');
		
        $notif = array();
        $filename = $_FILES['excel_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('excel_file');

        $prtyid = $this->input->post('partyname');
        $from = $this->input->post('fromissue');
        $to = $this->input->post('toissue');
        $prefix = $this->get_prefix_by_id($pre_fix_id);
        $prfx_final = $prefix->Prefix_Name;

        $consign_from = $prfx_final . $from;
        $consign_to = $prfx_final . $to;

        $data_excel = $this->Import_excel();
        $data_excel_count = count($data_excel);
        $chk_consign = $this->get_consignment_no_($from, $to, $prtyid, $pre_fix_id);

        $total = $to - $from;


        if ($from >= $to) {
            $notif['message'] = 'Check your consignment no range !';
            $notif['type'] = 'danger';
        } elseif (count($chk_consign) == 0) {
            $notif['message'] = 'There is no Consignment numbers are available in database';
            $notif['type'] = 'danger';
        } elseif ($total > 10000) {
            $notif['message'] = 'More then 10000 issues are not allowed !';
            $notif['type'] = 'danger';
        } elseif ($data_excel_count > $total) {
			echo $data_excel_count."----".$total;exit();
            $notif['message'] = 'Excel row count should be less then Consignment No range !';
            $notif['type'] = 'danger';
        } elseif ($ext != "xls") {
            $notif['message'] = 'Excel extension should be .xls only';
            $notif['type'] = 'danger';
        } elseif ($this->tot_colm <> 9) {
            $notif['message'] = 'Excel format should be<br /> Consignee_Name | Consignee_Address1 | Consignee_Address2 | '
                    . 'Consignee_Address3 | Consignee_Place | Consignee_Pincode |'
                    . ' Consignee_Weight | No_Of_Pieces | Consignment_No!';
            $notif['type'] = 'danger';
        } else {
            foreach ($chk_consign as $value) {
                $avl_Consignment_No = json_decode(json_encode($value))->Consignment_No;
                $avl_Consignment_No = str_replace(" ", "", "$avl_Consignment_No");

                foreach ($data_excel as $exc_value) {


                    $excecl_consign[] = $exc_value['Consignment_No'];
                    if ($avl_Consignment_No == $exc_value['Consignment_No']) {

//                        echo $avl_Consignment_No . "-" . $exc_value['Consignment_No'] . "<br />";
                        $sabyaa = array(
                            'Consignee_Name' => $exc_value['Consignee_Name'],
                            'Consignee_Address1' => $exc_value['Consignee_Address1'],
                            'Consignee_Address2' => $exc_value['Consignee_Address2'],
                            'Consignee_Address3' => $exc_value['Consignee_Address3'],
                            'Consignee_Place' => $exc_value['Consignee_Place'],
                            'Consignee_Pincode' => $exc_value['Consignee_Pincode'],
                            'Consignee_Weight' => $exc_value['Consignee_Weight'],
                            'No_Of_Pieces' => $exc_value['No_Of_Pieces'],
						//	'Created_date' => $date_s,
                                //   'Consignment_No' => $data_excel[$j]['Consignment_No'],
                        );

                        // Update //
                        $this->db->where('Consignment_No', $exc_value['Consignment_No']);
                        $this->db->update('Issue_register_master', $sabyaa);
                        //     end Update //
                    }
                }
            }
            $notif['message'] = 'Successfully Imported';
            $notif['type'] = 'success';
        }

        return $notif;
    }

    public function consignment_import_reference() {
		$date_sbbbb = $this->input->post('s_date');
		//exit();
        $notif = array();
        $filename = $_FILES['excel_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('excel_file');

        $prtyid = $this->input->post('partyname');
        $prefix = $this->get_prefix_by_id($pre_fix_id);
        $prfx_final = $prefix->Prefix_Name;

        $data_excel = $this->Import_reference_excel();
        $data_excel_count = count($data_excel);

        if ($data_excel_count > 10000) {
            $notif['message'] = 'Excel row count should be less then Consignment No range !';
            $notif['type'] = 'danger';
        } elseif ($ext != "xls") {
            $notif['message'] = 'Excel extension should be .xls only';
            $notif['type'] = 'danger';
        } elseif ($this->tot_colm <> 10) {
            $notif['message'] = 'Excel format should be<br /> Consignee_Name | Consignee_Address1 | Consignee_Address2 | '
                    . 'Consignee_Address3 | Consignee_Place | Consignee_Pincode |'
                    . ' Consignee_Weight | No_Of_Pieces | Consignment_No | Reference_No';
            $notif['type'] = 'danger';
        } else {

            foreach ($data_excel as $exc_value) {
                //   $excecl_consign[] = $exc_value['Consignment_No'];
                $consign_chk = $this->check_consign_reference($exc_value['Consignment_No']);
//                print_r($consign_chk[0]->Issuereg_Id);
                if (empty($consign_chk)) {
                    $Ref_data = array(
                        'Consignee_Name' => $exc_value['Consignee_Name'],
                        'Consignee_Address1' => $exc_value['Consignee_Address1'],
                        'Consignee_Address2' => $exc_value['Consignee_Address2'],
                        'Consignee_Address3' => $exc_value['Consignee_Address3'],
                        'Consignee_Place' => $exc_value['Consignee_Place'],
                        'Consignee_Pincode' => $exc_value['Consignee_Pincode'],
                        'Consignee_Weight' => $exc_value['Consignee_Weight'],
                        'No_Of_Pieces' => $exc_value['No_Of_Pieces'],
                        'Consignment_No' => $exc_value['Consignment_No'],
                        'Reference_No' => $exc_value['Reference_No'],
                        'Party_Id' => $prtyid,
                        'Prefix_Id' => $pre_fix_id,
						'Created_date' => $date_sbbbb,
                    );
				//	print_r($Ref_data);exit();
                    // Update //
                    $insert = $this->db->insert('Issue_Register_Master', $Ref_data);
                    //     end Update //
                } else {
                    $refid[] = $exc_value['Reference_No'];
                }
            }
            $this->excel_export_data($refid);

            //  redirect('/issueregister/reference');
            $notif['message'] = 'Successfully Imported';
            $notif['type'] = 'success';
        }

        return $notif;
    }

    public function import_reference_no_old() {
		
        $notif = array();
        $filename = $_FILES['excel_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('excel_file');

        $prtyid = $this->input->post('partyname');
        $prefix = $this->get_prefix_by_id($pre_fix_id);
        $prfx_final = $prefix->Prefix_Name;

        $data_excel = $this->Import_reference_nos();
        $data_excel_count = count($data_excel);

        if ($data_excel_count > 10000) {
            $notif['message'] = 'Excel row count should be less then Consignment No range !';
            $notif['type'] = 'danger';
        } elseif ($ext != "xls") {
            $notif['message'] = 'Excel extension should be .xls only';
            $notif['type'] = 'danger';
        } elseif ($this->tot_colm <> 1) {
            $notif['message'] = 'Excel format should be<br /> Reference_No ';
            $notif['type'] = 'danger';
        } else {
			  foreach ($data_excel as $exc_value) {
				 
                    $Ref_data = array(
                        'reference_number' => $exc_value['Reference_Number'],
                        'party_id' => $prtyid,
                        'prefix_id' => $pre_fix_id,
                    );

                    // Update //
                    $insert = $this->db->insert('Reference_Number', $Ref_data);
                    //     end Update //
                
            }
	       //   $this->excel_export_data($refid);

            //  redirect('/issueregister/reference');
            $notif['message'] = 'Successfully Imported';
            $notif['type'] = 'success';
			
        }

        return $notif;
    }

    public function import_reference_no() {
		$date_sbbbb = $this->input->post('s_date');
		$notif = array();
        $filename = $_FILES['excel_file']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $pre_fix_id = $this->input->post('prefix');
        $excel = $this->input->post('excel_file');

        $prtyid = $this->input->post('partyname');
        $prefix = $this->get_prefix_by_id($pre_fix_id);
        $prfx_final = $prefix->Prefix_Name;

        $data_excel = $this->Import_reference_nos();
        $data_excel_count = count($data_excel);

        if ($data_excel_count > 10000) {
            $notif['message'] = 'Excel row count should be less then Consignment No range !';
            $notif['type'] = 'danger';
        } elseif ($ext != "xls") {
            $notif['message'] = 'Excel extension should be .xls only';
            $notif['type'] = 'danger';
        } elseif ($this->tot_colm <> 9) {
            $notif['message'] = 'Excel format should be<br /> Consignee_Name | Consignee_Address1 | Consignee_Address2 | '
                    . 'Consignee_Address3 | Consignee_Place | Consignee_Pincode |'
                    . ' Consignee_Weight | No_Of_Pieces | Reference_No';
            $notif['type'] = 'danger';
        } else {
			
            //$this->excel_export_data($refid);
	 foreach ($data_excel as $exc_value) {
				 
            $Ref_data = array(
                        'Consignee_Name' => $exc_value['Consignee_Name'],
                        'Consignee_Address1' => $exc_value['Consignee_Address1'],
                        'Consignee_Address2' => $exc_value['Consignee_Address2'],
                        'Consignee_Address3' => $exc_value['Consignee_Address3'],
                        'Consignee_Place' => $exc_value['Consignee_Place'],
                        'Consignee_Pincode' => $exc_value['Consignee_Pincode'],
                        'Consignee_Weight' => $exc_value['Consignee_Weight'],
                        'No_Of_Pieces' => $exc_value['No_Of_Pieces'],
                        //'Consignment_No' => $exc_value['Consignment_No'],
                        'Reference_No' => $exc_value['Reference_No'],
                        'Party_Id' => $prtyid,
                        'Prefix_Id' => $pre_fix_id,
						'Flag_Res' => 6,
						'Created_date' => $date_sbbbb,
					  );

                    // Update //
                    $insert = $this->db->insert('Reference_Master', $Ref_data);
                    //     end Update //
                
            }
 //  redirect('/issueregister/reference');
            $notif['message'] = 'Successfully Imported';
            $notif['type'] = 'success';
        }

        return $notif;
    }

    public function get_all_issue_reg() {
        $this->db->select_max('Consignment_No');
        $this->db->from('Issue_Register_Master');
        $query = $this->db->get();
        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

    public function get_min_consign_no($party_id, $prefix_id) {
        $this->db->select_min('Consignment_No');
        $this->db->from('Issue_Register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
        $this->db->where('Consignee_Name = ', NULL);
        $this->db->where('is_printed = ', 0);
        $query = $this->db->get();
        foreach ($query->result() as $row) {
            
        }
        return $row;
    }

    public function single_booking() {
		//echo "sabya";exit();
        $consign_no = $this->get_min_consign_no($_POST['partyname'], $_POST['prefix']);
        $prefix = $this->get_prefix_by_id($_POST['prefix'])->Prefix_Name;
        //print_r($var->Consignment_No);
        $party_detail = $this->get_party_by_id($_POST['partyname']);
        $date = $this->input->post('date');
        $consign_date = date("d/m/y", strtotime($date));
        $pieces = $this->input->post('pieces');
        $wet = $this->input->post('weight');
        $pname = $party_detail->Party_Name;
        $add1 = $party_detail->Party_Address1;
        $add2 = $party_detail->Party_Address2;
        $add3 = $party_detail->Party_Address3;
        $cname = $this->input->post('consignee_name');
		$refno = $this->input->post('reference_no');
        $cadd1 = $this->input->post('address1');
        $cadd2 = $this->input->post('address2');
        $cplc = $this->input->post('place');

        $data = array(
			'Reference_No' => $refno,
            'Consignee_Name' => $cname,
            'Consignee_Address1' => $cadd1,
            'Consignee_Address2' => $cadd2,
            // 'Consignee_Address3' => $data_excel[$i]['Consignee_Address3'],
            'Created_by' => $this->session->userdata['logged_in']['users_id'],
            'Consignee_Place' => $cplc,
            'Consignee_Pincode' => $this->input->post('pincode'),
            'Consignee_Weight' => $wet,
            'No_Of_Pieces' => $pieces,
            'is_printed' => 1,
        );

        //  Update //
        $this->db->where('Consignment_No', $consign_no->Consignment_No);
        $this->db->update('Issue_register_master', $data);
        if ($this->db->affected_rows() >= 0) {

            $var0 = strlen($pname);

            if ($var0 >= 25) {
                $var0 = 25;
            }
            $length0 = (25 - $var0);
            $strarr0 = $pname . str_repeat(' ', $length0);
            //////////////////
            $var1 = strlen($add1);

            if ($var1 >= 25) {
                $var1 = 25;
            }
            $length1 = (25 - $var1);
            $strarr1 = $add1 . str_repeat(' ', $length1);
            ////////////////////////////
            $var2 = strlen($add2);

            if ($var2 >= 25) {
                $var2 = 25;
            }
            $length2 = (25 - $var2);
            $strarr2 = $add2 . str_repeat(' ', $length2);
            ////////////////////////
            $var3 = strlen($add3);

            if ($var3 >= 25) {
                $var3 = 25;
            }
            $length3 = (25 - $var3);
            $strarr3 = $add3 . str_repeat(' ', $length3);
            //////////////////
            $var4 = strlen($cname);

            if ($var4 >= 25) {
                $var4 = 25;
            }
            $length4 = (25 - $var4);
            $strarr4 = $cname . str_repeat(' ', $length4);
            //////////////////////////
            $var5 = strlen($cadd1);

            if ($var5 >= 25) {
                $var5 = 25;
            }
            $length5 = (25 - $var5);
            $strarr5 = $cadd1 . str_repeat(' ', $length5);
            ///////////////////
            $var6 = strlen($cadd2);

            if ($var6 >= 25) {
                $var6 = 25;
            }
            $length6 = (25 - $var6);
            $strarr6 = $cadd2 . str_repeat(' ', $length6);
            ////////////////////

            $var7 = strlen($cplc);

            if ($var7 >= 25) {
                $var7 = 25;
            }
            $length7 = (25 - $var7);
            $strarr7 = $cplc . str_repeat(' ', $length7);
            /////////////////////


            $files = 'uploads/files/single_booking.txt';
            $f = fopen($files, "w");
            $strarr0 = substr($strarr0, 0, 25);
            $strarr1 = substr($strarr1, 0, 25);
            $strarr2 = substr($strarr2, 0, 25);
            $strarr3 = substr($strarr3, 0, 25);
            $strarr4 = substr($strarr4, 0, 21);
            $strarr5 = substr($strarr5, 0, 21);
            $strarr6 = substr($strarr6, 0, 21);
            $strarr7 = substr($strarr7, 0, 21);
            $strarr8 = substr($consign_no->Consignment_No, 0, 18);
            $strarr9 = preg_replace('/\s+/', '', $prefix . $consign_no->Consignment_No);
            $barcode = '|};cD;"' . $strarr9 . '";N0;0001;0002;H04;D';
            $str = str_repeat(' ', 63);
            $str6 = str_repeat(' ', 5);
            $str3 = str_repeat(' ', 5);
            $var = 'uploads/files/code.';
            fwrite($f, "                     $strarr8                        $date \n");
            fwrite($f, "$str \n");
            fwrite($f, "$str6 $strarr0 $str6 $strarr4 $str6 $pieces \n");
            fwrite($f, "$str6 $strarr1 $str6 $strarr5 $str6 $wet \n");
            fwrite($f, "$str6 $strarr2 $str6 $strarr6 \n");
            fwrite($f, "$str6 $strarr3 $str6 $strarr7 \n");
            fwrite($f, "\n\n\n\n\n$barcode");
            fwrite($f, "\n\n\n\n\n\n\n\n\n\n\n\n\n");
            //fwrite($f, "       118IPL0084260718            520013                            \n");
            fclose($f);

            $this->session->set_flashdata('message', 'Saved successfully');
            $this->session->set_flashdata('type', 'success');
            unset($_POST);
        } else {
            $this->session->set_flashdata('message', 'Something wrong');
            $this->session->set_flashdata('type', 'danger');
        }
    }

public function single_ref_booking() {
	
	
		$consin_nos = $this->input->post('consignment_no');
		$consin_no = substr($consin_nos, 3); 
		$refe_no = $this->input->post('reference_no');
		//$partyid = $_POST['partyname'];
		//$prefixid = $_POST['prefix'];
		$date = $this->input->post('date');
        $consign_date = date("d/m/y", strtotime($date));
        $pieces = $this->input->post('pieces');
        $wet = $this->input->post('weight');
        $cname = $this->input->post('consignee_name');
		$refno = $this->input->post('reference_no');
        $cadd1 = $this->input->post('address1');
        $cadd2 = $this->input->post('address2');
        $cplc = $this->input->post('place');
		$chk_consin = $this->check_consign_no($consin_no);
		$chk_refe = $this->check_refe_no($refe_no);
		$get_party = $this->get_party_by_refe($refe_no);
		
		if($chk_consin == 0 && $chk_refe == 1){
		 $datass = array(
			'Reference_No' => $refe_no,
			'Consignment_No'=> $consin_no,
            'Consignee_Name' => $cname,
            'Consignee_Address1' => $cadd1,
            'Consignee_Address2' => $cadd2,
            'Created_by' => $this->session->userdata['logged_in']['users_id'],
            'Consignee_Place' => $cplc,
            'Consignee_Pincode' => $this->input->post('pincode'),
            'Consignee_Weight' => $wet,
            'No_Of_Pieces' => $pieces,
			'Party_Id' => $get_party,
            'Prefix_Id' => 1,
		    'is_printed' => 1,
        );
				$insert = $this->db->insert('Issue_Register_Master', $datass);
			//	echo $this->db->last_query(); die;
                $ins_id = $this->db->insert_id();
				
				$this->session->set_userdata('ref_ins_id', $ins_id);
			
				   if ($this->db->affected_rows() >= 0) {
					   
			$this->session->set_flashdata('message', 'Saved successfully');
            $this->session->set_flashdata('type', 'success');
			  unset($_POST);
			     redirect(base_url('/issueregister/singlereferencebooking'));
			
        } else {
            $this->session->set_flashdata('message', 'Something wrong');
            $this->session->set_flashdata('type', 'danger');
        }
	
		}elseif($chk_consin == 1){
			$this->session->set_flashdata('message', 'This consignment no is already assigned');
            $this->session->set_flashdata('type', 'danger');
			
		}elseif($chk_refe == 0){
			$this->session->set_flashdata('message', 'This refenece no is not imported');
            $this->session->set_flashdata('type', 'danger');
		}elseif($get_party == 0){
			$this->session->set_flashdata('message', 'This refenece no is not imported');
            $this->session->set_flashdata('type', 'danger');
		}else{
			$this->session->set_flashdata('message', 'Consignment no is already assigned and Reference no is not imported yet..');
            $this->session->set_flashdata('type', 'danger');
		}

    }



    public function get_party_by_id($id) {
        $this->db->from('Party_Master');
        $this->db->where('Party_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_booking($party_id, $prefix_id, $imp_date_from ,$imp_date_to = null ) {
		//  $date1 = str_replace('-', '/', $imp_date_from);
        //  $imp_date_next = date('Y-m-d',strtotime($date1 . "+1 days"));

//$this->db->select('issuereg_Id, Consignment_No, Consignee_Name');
$this->db->select('Consignment_No, Reference_No, Consignee_Name, Consignee_Address1, Consignee_Address2, Consignee_Address3, Consignee_Place, Consignee_Pincode, Consignee_Weight, No_Of_Pieces, Created_date');
        $this->db->from('Issue_register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
        $this->db->where('Consignee_Name != ', NULL);
        $this->db->where('is_printed =', 1);
		$this->db->where('Created_date>=', $imp_date_from.' 00:00:00.000');
		$this->db->where('Created_date<=', $imp_date_to.' 00:00:00.000');
		$query =$this->db->order_by('Issuereg_Id', 'DESC');
		// $query =$this->db->limit(4100); 
        $query = $this->db->get();
		//echo "<pre />";
// var_dump($query);die();
        return $query->result();
    }

    public function get_booking1($party_id, $prefix_id, $imp_date) {
		$date1 = str_replace('-', '/', $imp_date);
         $imp_date_next = date('Y-m-d',strtotime($date1 . "+1 days"));
	//	$this->db->select('issuereg_Id, Consignment_No, Consignee_Name');
        $this->db->select('Consignment_No, Reference_No,Consignee_Name , Consignee_Address1, Consignee_Address2, Consignee_Address3, Consignee_Place, Consignee_Pincode, Consignee_Weight, No_Of_Pieces, Created_date');
        $this->db->from('Issue_register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
        $this->db->where('Consignee_Name != ', NULL);
        $this->db->where('is_printed =', 1);
		$this->db->where('Created_date>=', $imp_date.' 00:00:00.000');
		$this->db->where('Created_date<=', $imp_date_next.' 00:00:00.000');
		$this->db->order_by('Issuereg_Id', 'DESC');
		$this->db->limit(4100); 
        $query = $this->db->get();
		//print_r($query->result_array());
		//exit();
        return $query->result_array();
    }

    public function export_booking() {
        echo "lala kakak jajaj gaga";
//        $details = $this->get_booking($_POST['partyname'], $_POST['prefix']);
//        print_r($details);
        exit();
        $this->session->unset_userdata('imp_prefix');
        $this->session->unset_userdata('imp_partyname');
    }

    public function get_consignment_no($consign_from, $consign_to) {
        $this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        //$this->db->where('Consignment_No = ', $consign);
        $this->db->where('Consignment_No >=', $consign_from);
        $this->db->where('Consignment_No <=', $consign_to);
      //  $this->db->where("Consignment_No BETWEEN $consign_from AND $consign_to");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_consignment_no_($consign_from, $consign_to, $party_id, $prefix_id) {
        $this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Party_Id', $party_id);
        $this->db->where('Prefix_Id', $prefix_id);
//        $this->db->where('Consignment_No = ', $consign);
//        $this->db->where('Consignment_No >=', $consign_from);
//        $this->db->where('Consignment_No <=', $consign_to);
        $this->db->where("Consignment_No BETWEEN $consign_from AND $consign_to");
        $query = $this->db->get();

        return $query->result_array();
    }

    public function check_consign($cons_no) {

        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Consignment_No = ', $cons_no);
		$this->db->or_where('Reference_No = ', $cons_no);
        $query = $this->db->get();
        $query->result();
        if (!$query->result()) {
            $this->session->set_flashdata('message', 'Reference No is not available');
            $this->session->set_flashdata('type', 'danger');
        }
        return $query->result();
    }
	
	public function check_consign_no($cons_no) {
		
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Consignment_No = ', $cons_no);
		//$this->db->or_where('Reference_No = ', $cons_no);
        $query = $this->db->get();
        $query->result();
		 return $query->num_rows();
    }
	
	public function get_party_by_refe($refe_no) {
		
        $row = array();
        $this->db->select('Party_Id');
        $this->db->from('Reference_Master');
        $this->db->where('Reference_No = ', $refe_no);
		$query = $this->db->get();
        $arry = $query->result();
		if(empty($arry)){
			return 0;
		}else{
			foreach($arry as $vals){
			return $vals->Party_Id;
		}
		}
    }
	
	public function check_refe_no($refe_no) {	
		
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Reference_Master');
       // $this->db->where('Consignment_No = ', $cons_no);
		$this->db->where('Reference_No = ', $refe_no);
		$this->db->order_by('Refe_Id','desc');
		$this->db->limit(1);
        $query = $this->db->get();
        $query->result();
		 return $query->num_rows();
    }	

    public function check_refe_no_in_issue_register($refe_no) {	
		
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_master');
       // $this->db->where('Consignment_No = ', $cons_no);
		$this->db->where('Reference_No = ', $refe_no);
        $query = $this->db->get();
        // var_dump($query);die;
        $query->result();
		return $query->num_rows();
    }	
	
	
	public function check_reference($cons_no) {
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Reference_No = ', $cons_no);
		$this->db->or_where('Consignment_No = ', $cons_no);
		$this->db->order_by('Issuereg_Id','desc');
		$this->db->limit(1);
        $query = $this->db->get();
        $query->result();
        if (!$query->result()) {
            $this->session->set_flashdata('message', 'Reference No is not available');
            $this->session->set_flashdata('type', 'danger');
        }
        return $query->result();
    }

	public function check_reference1($cons_no) {
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Reference_Master');
        $this->db->where('Reference_No = ', $cons_no);
		//$this->db->or_where('Consignment_No = ', $cons_no);
		$this->db->order_by('Refe_Id','desc');
		$this->db->limit(1);
        $query = $this->db->get();
        $query->result();
        if (!$query->result()) {
            $this->session->set_flashdata('message', 'Reference No is not available');
            $this->session->set_flashdata('type', 'danger');
        }
        return $query->result();
    }


public function check_consign1($cons_no) {
	
		//echo "Sabya";exit();
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Consignment_No = ', $cons_no);
		$query = $this->db->get();
        $query->result();
        if (!$query->result()) {
            $this->session->set_flashdata('message', 'Consignment No is not available');
            $this->session->set_flashdata('type', 'danger');
        }
        return $query->result();
    }


    public function single_booking_consign() {
        $consign_no = $this->session->userdata('chk_con_no');
        $vars = $this->check_consign($consign_no);

        $prefix = $this->get_prefix_by_id($vars[0]->Prefix_Id)->Prefix_Name;
        //print_r($var->Consignment_No);
        $party_detail = $this->get_party_by_id($vars[0]->Party_Id);
        $date = $this->input->post('date');
        $consign_date = date("d/m/y", strtotime($date));
        $pieces = $this->input->post('pieces');
        $wet = $this->input->post('weight');
        $pname = $party_detail->Party_Name;
        $add1 = $party_detail->Party_Address1;
        $add2 = $party_detail->Party_Address2;
        $add3 = $party_detail->Party_Address3;
        $cname = $this->input->post('consignee_name');
        $cadd1 = $this->input->post('address1');
        $cadd2 = $this->input->post('address2');
        $cplc = $this->input->post('place');
        $data = array(
            'Consignee_Name' => $cname,
            'Consignee_Address1' => $cadd1,
            'Consignee_Address2' => $cadd2,
            // 'Consignee_Address3' => $data_excel[$i]['Consignee_Address3'],
            'Created_by' => $this->session->userdata['logged_in']['users_id'],
            'Consignee_Place' => $cplc,
            'Consignee_Pincode' => $this->input->post('pincode'),
            'Consignee_Weight' => $wet,
            'No_Of_Pieces' => $pieces,
                // 'is_printed' => 1,
        );

        //  Update //
        $this->db->where('Consignment_No', $consign_no);
        $this->db->update('Issue_register_master', $data);
        if ($this->db->affected_rows() >= 0) {
            $this->session->set_flashdata('message', 'Saved successfully');
            $this->session->set_flashdata('type', 'success');
            unset($_POST);
        } else {
            $this->session->set_flashdata('message', 'Something wrong');
            $this->session->set_flashdata('type', 'danger');
        }
    }

    public function check_consign_reference($cons_no) {
        $row = array();
        //$this->db->select('Consignment_No');
        $this->db->from('Issue_register_Master');
        $this->db->where('Consignment_No = ', $cons_no);
        $query = $this->db->get();
        $query->result();
        return $query->result();
    }

    public function downloadFile($data) {
        $this->load->helper('download');
//        $data = "Here is some text! \n";
//        $data .= 'Here is some more text in new line!';
        $name = 'Ref_imp.txt';
        force_download($name, $data, TRUE);
    }

    public function excel_export_data($param) {


        if (empty($param)) {
            $data1 = "All rows imported successfully ";
        } else {
            $data1 = "These consignment nos are already assigned : ";
        }
        $data2 = implode(", ", $param);
        $data = $data1 . $data2;
        $this->downloadFile($data);
        //   exit();
    }
	
	
    public function single_con_booking() 
    {	var_dump($_POST);die;
        $consin_no = $this->input->post('consignment_no');
        $refe_no = $this->input->post('reference_no');
        $date = $this->input->post('date');
        $consign_date = date("d/m/y", strtotime($date));
        $pieces = $this->input->post('pieces');
        $wet = $this->input->post('weight');
        $cname = $this->input->post('consignee_name');
        // $refno = $this->input->post('reference_no');
        $cadd1 = $this->input->post('address1');
        $cadd2 = $this->input->post('address2');
        $cplc = $this->input->post('place');
        $chk_consin = $this->check_consign_no($consin_no);
        $chk_refe = $this->check_refe_no_in_issue_register($refe_no);
        $get_party = $this->get_party_by_refe($refe_no);
        
        var_dump($chk_refe);die;
        
        if($chk_consin == 1)
        {
                $databhai = array(
                    'Reference_No' => $refe_no,
                    //'Consignment_No'=> $consin_no,
                    'Consignee_Name' => $cname,
                    'Consignee_Address1' => $cadd1,
                    'Consignee_Address2' => $cadd2,
                    'Created_by' => $this->session->userdata['logged_in']['users_id'],
                    'Consignee_Place' => $cplc,
                    'Consignee_Pincode' => $this->input->post('pincode'),
                    'Consignee_Weight' => $wet,
                    'No_Of_Pieces' => $pieces,
                    //'Party_Id' => $get_party,
                // 'Prefix_Id' => $partyid11,
                    'is_printed' => 1,
                );
                //  Update //
                
                $this->db->where('Consignment_No', $consin_no);
                $this->db->update('Issue_register_master', $databhai);		
            
                if ($this->db->affected_rows() >= 0) 
                {
                    $this->session->set_userdata('con_upd_id', $consin_no);
                    $this->session->set_flashdata('message', 'Saved successfully');
                    $this->session->set_flashdata('type', 'success');
                    unset($_POST);
                        
                } 
                else 
                {
                    $this->session->set_flashdata('message', 'Something wrong');
                    $this->session->set_flashdata('type', 'danger');
                }	
            
        }
        else
        {
            $this->session->set_flashdata('message', 'Consignment no is already assigned and Reference no is not imported yet..');
            $this->session->set_flashdata('type', 'danger');
        }

    }
	
	public function get_all_place() {
		$this->db->select('Place_name');
        $this->db->from('Place');
        $this->db->order_by("Place_name", "asc");
        $query = $this->db->get();
        return $query->result();
    }
	
	function getPlace($postData){
 
    $response = array();
  
    $this->db->select('*');

    if($postData['search'] ){
 
      // Select record
      $this->db->where("Place_name like '%".$postData['search']."%' ");
      
      $records = $this->db->get('Place')->result();

      foreach($records as $row ){
        $response[] = array("value"=>$row->Place_Code,"label"=>$row->Place_name);
      }
 
    }
    
    return $response;
  }
	
	

}
