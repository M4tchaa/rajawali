<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Supplier_model extends CI_Model {
    public function get_all() {
        return $this->db->get('data_sales')->result();
    }

    public function get_by_id($id) {
        return $this->db->get_where('data_sales', ['id_sales' => $id])->row();
    }

    public function insert($data) {
        return $this->db->insert('data_sales', $data);
    }

    public function update($id, $data) {
        $this->db->where('id_sales', $id);
        return $this->db->update('data_sales', $data);
    }

    public function delete($id) {
        $this->db->where('id_sales', $id);
        return $this->db->delete('data_sales');
    }
}
