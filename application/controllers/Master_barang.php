<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Memuat model Master_barang_model
        $this->load->model('Master_barang_model');
    }

    // Fungsi untuk menampilkan halaman master_barang
    public function index() {
        // Mengambil data barang masuk dari model
        $data['barang_masuk'] = $this->Master_barang_model->get_barang_masuk();

        // Memuat tampilan
        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/master_barang', 'data' => $data]);
        $this->load->view('layout/footer');
    }
}
