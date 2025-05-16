<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('url');
        $this->load->model('App_model'); // Memuat model Barang_model
    }
    public function index() {
        $data['barangs'] = $this->App_model->get_barang(); // Ambil data barang dari model
		$data['css'] = 'app.css';
		
		$this->load->view('layout/header', $data);
        $this->load->view('index', $data); // Tampilkan ke view
        $this->load->view('layout/footer'); // Tampilkan ke view
        $this->load->view('script/index_script'); // Tampilkan ke view
    }
}