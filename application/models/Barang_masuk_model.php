<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk_model extends CI_Model
{
    public function get_all()
    {
        $this->db->select('bm.*, b.namaBarang, s.nama');
        $this->db->from('barang_masuk bm');
        $this->db->join('barang b', 'b.id_barang = bm.id_barang');
        $this->db->join('data_sales s', 's.id_sales = bm.id_supplier');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('barang_masuk', ['id_barangMasuk' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('barang_masuk', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_barangMasuk', $id);
        return $this->db->update('barang_masuk', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_barangMasuk', $id);
        return $this->db->delete('barang_masuk');
    }
}
