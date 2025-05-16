<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->model('Login_model');
                $this->load->library('session');
    }

    public function index() {
        $data['error'] = '';
        
        $this->load->view('layout/header');
        $this->load->view('login', $data);
        $this->load->view('layout/footer');
        // $this->load->view('script/login_script');
    }

    public function process() {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        $user = $this->Login_model->get_user_by_username($username);

        if ($user && $password ) {
            // Simpan session
            $this->session->set_userdata([
                'id_user' => $user->id_user,
                'username' => $user->username,
                'logged_in' => true
            ]);
            redirect('dashboard'); // Ganti ke halaman dashboard kamu
        } else {
            $data['error'] = 'Username atau password salah.';
            $this->load->view('login', $data);
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('app');
    }
}
