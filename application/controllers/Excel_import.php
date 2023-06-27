<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_import extends CI_Controller {

    public function __construct() {
        parent::__construct();

        Utils::no_cache();
        if (!$this->session->userdata('logged_in')) {
            redirect(base_url('auth/login'));
            exit;
        }

        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->library('session');
    }

    public function index() {
        $data['num_rows'] = $this->db->get('Place')->num_rows();

        $this->load->view('excel_import', $data);
    }

    public function import_data() {

        $config = array(
            'upload_path' => FCPATH . 'uploads/',
            'allowed_types' => 'xls|csv'
        );

        $this->load->library('upload', $config);
        if ($this->upload->do_upload('file')) {

            $data = $this->upload->data();
            @chmod($data['full_path'], 0777);

            $this->load->library('Spreadsheet_Excel_Reader');
            $this->spreadsheet_excel_reader->setOutputEncoding('CP1251');

            $this->spreadsheet_excel_reader->read($data['full_path']);
            $sheets = $this->spreadsheet_excel_reader->sheets[0];
            error_reporting(0);

            $data_excel = array();
            for ($i = 2; $i <= $sheets['numRows']; $i++) {
                if ($sheets['cells'][$i][1] == '')
                    break;

                $data_excel[$i - 1]['Place_name'] = $sheets['cells'][$i][1];
                $data_excel[$i - 1]['Place_Phone'] = $sheets['cells'][$i][2];
                $data_excel[$i - 1]['Place_off_address'] = $sheets['cells'][$i][3];
                $data_excel[$i - 1]['State_Code'] = 1;
                $data_excel[$i - 1]['Place_Type'] = $sheets['cells'][$i][3];
            }

            $this->db->insert_batch('Place', $data_excel);
            // @unlink($data['full_path']);
            redirect('Excel_import');
        }
    }

}
