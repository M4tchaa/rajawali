<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang_keluar_model extends CI_Model {

    public function get_all() {
        return $this->db->get('barang_keluar')->result();
    }

    public function insert($data) {
        return $this->db->insert('barang_keluar', $data);
    }

    public function get_by_id($id) {
        return $this->db->get_where('barang_keluar', ['id_barangKeluar' => $id])->row();
    }

    public function update($id, $data) {
        return $this->db->where('id_barangKeluar', $id)->update('barang_keluar', $data);
    }

    public function delete($id) {
        return $this->db->delete('barang_keluar', ['id_barangKeluar' => $id]);
    }
}
