<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sol_model extends CI_Model {

    var $table = 'Party_Master';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_sol() {
        $this->db->from('Sol_Details');
        $query = $this->db->get();
        return $query->result();
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

    public function sol_import() {

        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('sol_excel')) {

            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);
            $tot_col = $sheets['numCols'];   // should be 10
            $data_excel = array();
            if ($tot_col <= 7) {
                $this->session->set_flashdata('message', 'Excel column should be equal to 9 ');
                $this->session->set_flashdata('type', 'danger');
                redirect(base_url('/soldetail'));
            }

            for ($i = 2; $i <= $sheets['numRows']; $i++) {
                if ($sheets['cells'][$i][1] == '')
                    break;
                $p_name = $this->get_party_by_id($_POST['partyname']);
                $data_excel[$i - 1]['Sol_No'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Party_Id'] = $_POST['partyname'];
                $data_excel[$i - 1]['Party_Name'] = $p_name->Party_Name;
                $data_excel[$i - 1]['Address1'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Address2'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['Address3'] = $sheets['cells'][$i][4];
                $data_excel[$i - 1]['City'] = $sheets['cells'][$i][5];
                $data_excel[$i - 1]['PinCode'] = $sheets['cells'][$i][6];
                $data_excel[$i - 1]['Remark1'] = $sheets['cells'][$i][7];
                $data_excel[$i - 1]['Remark2'] = $sheets['cells'][$i][8];
            }

            $this->db->insert_batch('Sol_Details', $data_excel);
            //print_r($this->db->_error_message());
            $ins_id = $this->db->insert_id();
            if ($ins_id) {
                $this->session->set_flashdata('message', 'Saved successfully');
                $this->session->set_flashdata('type', 'success');
                unset($_POST);
                redirect(base_url('/soldetail'));
            } else {
                $this->session->set_flashdata('message', 'Duplicate Entry !');
                $this->session->set_flashdata('type', 'danger');
                redirect(base_url('/soldetail'));
            }
        } else {
            $this->session->set_flashdata('message', 'Please upload your excel file ');
            $this->session->set_flashdata('type', 'danger');
        }
    }

}
