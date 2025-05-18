<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_barang_model extends CI_Model
{
    public function get_all()
    {
        // Hanya menampilkan barang yang belum dihapus (is_deleted = 0)
        $this->db->where('is_deleted', 0);
        return $this->db->get('barang')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('barang', ['id_barang' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('barang', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('barang', $data);
    }

    // Soft delete (hanya mengubah is_deleted menjadi 1)
    public function soft_delete($id)
    {
        $this->db->where('id_barang', $id);
        return $this->db->update('barang', ['is_deleted' => 1]);
    }

    // Fungsi Pencarian Barang (Select2)
    public function search_barang($keyword)
    {
        $this->db->like('namaBarang', $keyword);
        $this->db->where('is_deleted', 0);
        $this->db->limit(10);
        return $this->db->get('barang')->result();
    }
}
