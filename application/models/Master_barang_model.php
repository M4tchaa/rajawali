<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang_model extends CI_Model {

    public function get_all() {
        return $this->db->get('barang')->result();
    }

    public function search_barang($keyword)
{
    $this->db->like('namaBarang', $keyword);
    $this->db->limit(10);
    return $this->db->get('barang')->result();
}



}
