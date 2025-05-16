<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Pastikan database di-load secara otomatis
        $this->load->database();
    }

    public function get_barang() {
        // Menggunakan $this->db untuk mengambil data barang
        $this->db->select('namaBarang, stock, hargaOnline, gambar');
        $query = $this->db->get('barang');
        return $query->result_array(); // Mengembalikan data sebagai array
    }
}
