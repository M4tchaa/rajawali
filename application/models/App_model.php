<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Pastikan database di-load secara otomatis
        $this->load->database();
    }

    public function get_barang()
    {
        // Menggunakan $this->db untuk mengambil data barang yang belum dihapus (is_deleted = 0)
        $this->db->select('namaBarang, stock, hargaOnline, gambar');
        $this->db->where('is_deleted', 0); // Kondisi hanya data yang tidak terhapus
        $query = $this->db->get('barang');
        return $query->result_array(); // Mengembalikan data sebagai array
    }
}
