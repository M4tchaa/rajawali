<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session']);
    }

    public function index() {
        $data['supplier'] = $this->Supplier_model->get_all();
        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/supplier', 'supplier' => $data['supplier']]);
        $this->load->view('layout/footer');
    }

    public function get($id) {
        $data = $this->Supplier_model->get_by_id($id);
        echo json_encode($data);
    }

    public function store() {
        $post = $this->input->post();
        $data = [
            'nama' => $post['nama'],
            'perusahaan' => $post['perusahaan'],
            'alamat' => $post['alamat']
        ];

        if (empty($post['id_sales'])) {
            $this->Supplier_model->insert($data);
            $this->session->set_flashdata('success', 'Supplier berhasil ditambahkan.');
        } else {
            $this->Supplier_model->update($post['id_sales'], $data);
            $this->session->set_flashdata('success', 'Supplier berhasil diupdate.');
        }

        echo json_encode(['success' => true]);
    }

    public function delete($id) {
        $this->Supplier_model->delete($id);
        echo json_encode(['success' => true]);
    }

    public function search() {
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
