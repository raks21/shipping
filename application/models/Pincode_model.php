<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pincode_model extends CI_Model {

    var $table = 'Place';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_pincode() {
        $this->db->from('pincode');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $query = $this->db->query('SELECT * FROM Place WHERE Place_Code = ' . $id . '');

        foreach ($query->result() as $row) {
//            echo $row->image;
        }
        return $row;
    }

    public function add() {
        $notif = array();
        $data = array(
            'Place_name' => $this->input->post('placename'),
            'Place_off_address' => $this->input->post('address'),
            'Place_Contact' => $this->input->post('contactperson'),
            'Place_Phone' => $this->input->post('phone'),
            'Place_Type' => $this->input->post('placetype'),
            'Place_Remark' => $this->input->post('placeremark'),
            'State_Code' => $this->input->post('state'),
        );
        // Insert //
        $this->db->insert('Place', $data);
        $place_id = $this->db->insert_id();
        // end Insert //
        if ($place_id) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/party'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function edit() {
        $notif = array();
        $data = array(
            'Place_name' => $this->input->post('placename'),
            'Place_off_address' => $this->input->post('address'),
            'Place_Contact' => $this->input->post('contactperson'),
            'Place_Phone' => $this->input->post('phone'),
            'Place_Type' => $this->input->post('placetype'),
            'Place_Remark' => $this->input->post('placeremark'),
            'State_Code' => $this->input->post('state'),
        );
        // Update //
        $this->db->where('Place_Code', $this->uri->segment(3));
        $this->db->update('Place', $data);
        // end Update //

        if ($this->db->affected_rows() > 0) {
            $notif['message'] = 'Saved successfully';
            $notif['type'] = 'success';
            unset($_POST);
            redirect(base_url('/place'));
        } else {
            $notif['message'] = 'Something wrong !';
            $notif['type'] = 'danger';
        }
        return $notif;
    }

    public function place_import() {

        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('place_excel')) {
            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $data_excel = array();
//            echo "<pre>";
//            print_r($sheets);
//            exit();
            for ($i = 2; $i <= $sheets['numRows']; $i++) {
                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['Place_name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Place_Phone'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Place_off_address'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['State_Code'] = 1;
                $data_excel[$i - 1]['Place_Type'] = $sheets['cells'][$i][4];
            }

            $this->db->insert_batch('Place', $data_excel);
        }
    }

    public function get_state() {
        $this->db->from('State');
        $query = $this->db->get();
        return $query->result();
    }

}
