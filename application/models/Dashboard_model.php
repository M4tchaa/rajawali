<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    
    // Total Barang
    public function get_total_barang() {
        $this->db->where('is_deleted', 0);
        return $this->db->count_all_results('barang');
    }

    // Total Supplier
    public function get_total_supplier() {
        return $this->db->count_all('data_sales');
    }

    // Data Barang Masuk untuk Chart
    public function get_barang_masuk_chart() {
        $this->db->select('DATE(tanggalMasuk) as date, SUM(jumlahMasuk) as total');
        $this->db->from('barang_masuk');
        $this->db->group_by('DATE(tanggalMasuk)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }

    // Data Barang Keluar untuk Chart
    public function get_barang_keluar_chart() {
        $this->db->select('DATE(tanggalKeluar) as date, SUM(jumlahKeluar) as total');
        $this->db->from('barang_keluar');
        $this->db->group_by('DATE(tanggalKeluar)');
        $this->db->order_by('date', 'ASC');
        return $this->db->get()->result_array();
    }
}
