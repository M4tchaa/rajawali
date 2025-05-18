<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_masuk_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    // Fungsi untuk mengambil data barang masuk
    public function get_barang_masuk() {
        $this->db->select('*');
        $this->db->from('barang_masuk');
        $query = $this->db->get();
        return $query->result();  // Mengembalikan hasil query sebagai array objek
    }
}
