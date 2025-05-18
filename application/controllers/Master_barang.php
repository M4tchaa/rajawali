<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Master_barang_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload']);
    }
public function index() {
    $data['title'] = 'Master Barang';
    $data['barang'] = $this->Master_barang_model->get_all();

    $this->load->view('layout/header');
    // Passing variabel langsung, bukan array di dalam array
    $this->load->view('layout/mainwrapper', ['content' => 'modules/master_barang', 'barang' => $data['barang']]);
    $this->load->view('layout/footer');
}

// Controller: Master_barang.php
public function search()
{
    $query = $this->input->get('q');
    
    // Query pencarian dari database
    $this->db->like('namaBarang', $query);
    $result = $this->db->get('barang')->result_array();

    // Mapping ke format JSON yang sesuai untuk Select2
    $data = [];
    foreach ($result as $row) {
        $data[] = [
            'id' => $row['id_barang'],
            'text' => $row['namaBarang']
        ];
    }

    echo json_encode($data);
}


}