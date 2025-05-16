<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_by_username($username) {
        return $this->db->get_where('user', ['username' => $username])->row_array();
    }
}
