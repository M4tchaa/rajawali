<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('Dashboard_model');
    }

    public function index() {
        // Data untuk dashboard
        $data['total_barang'] = $this->Dashboard_model->get_total_barang();
        $data['total_supplier'] = $this->Dashboard_model->get_total_supplier();
        $data['barang_masuk'] = $this->Dashboard_model->get_barang_masuk_chart();
        $data['barang_keluar'] = $this->Dashboard_model->get_barang_keluar_chart();

        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/dashboard', 'data' => $data]);
        $this->load->view('layout/footer');
    }
}
