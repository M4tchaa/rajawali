<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
    }

public function index() {
    $this->load->view('layout/header'); // Bootstrap CSS, meta, dll
    $this->load->view('layout/mainwrapper', ['content' => 'modules/dashboard']);
    $this->load->view('layout/footer'); // JS, closing tag, dll
}


}