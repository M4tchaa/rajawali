<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Barang_keluar_model');
    }

    public function index() {
        $data['barang_keluar'] = $this->Barang_keluar_model->get_all();

        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/barang_keluar', 'data' => $data]);
        $this->load->view('layout/footer');
    }

    // Tambahkan fungsi create, edit, delete jika diperlukan
}
