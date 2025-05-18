<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Supplier_model');
    }

    public function index() {
        $data['supplier'] = $this->Supplier_model->get_all();
        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/supplier', 'data' => $data]);
        $this->load->view('layout/footer');
    }

    public function search()
    {
        $query = $this->input->get('q');
        $this->db->like('nama', $query);
        $result = $this->db->get('data_sales')->result_array();

        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'id' => $row['id_sales'],
                'text' => $row['nama'] . ' - ' . $row['perusahaan']
            ];
        }

        echo json_encode($data);
    }
}