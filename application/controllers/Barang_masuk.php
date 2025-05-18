<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_masuk_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function index()
    {
        $data['barang_masuk'] = $this->Barang_masuk_model->get_all();
        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', [
            'content' => 'modules/barang_masuk',
            'barang_masuk' => $data['barang_masuk']
        ]);
        $this->load->view('layout/footer');
    }

    public function get($id)
    {
        $data = $this->Barang_masuk_model->get_by_id($id);
        echo json_encode($data);
    }

    public function store()
    {
        $post = $this->input->post();
        $data = [
            'id_barang' => $post['id_barang'],
            'namaBarang' => $post['namaBarang'],
            'id_supplier' => $post['id_supplier'],
            'supplier' => $post['supplier'],
            'tanggalMasuk' => $post['tanggalMasuk'],
            'jumlahMasuk' => $post['jumlahMasuk']
        ];

        $this->db->trans_start();
        $this->Barang_masuk_model->insert($data);
        $this->update_stok_barang($post['id_barang'], $post['jumlahMasuk'], $post['supplier']);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $old_data = $this->Barang_masuk_model->get_by_id($id);
        $old_quantity = (int)$old_data->jumlahMasuk;
        $new_quantity = (int)$post['jumlahMasuk'];
        $difference = $new_quantity - $old_quantity;

        $data = [
            'id_barang' => $post['id_barang'],
            'namaBarang' => $post['namaBarang'],
            'id_supplier' => $post['id_supplier'],
            'supplier' => $post['supplier'],
            'tanggalMasuk' => $post['tanggalMasuk'],
            'jumlahMasuk' => $new_quantity
        ];

        $this->db->trans_start();
        $this->Barang_masuk_model->update($id, $data);
        $this->update_stok_barang($post['id_barang'], $difference, $post['supplier']);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function delete($id)
    {
        $data = $this->Barang_masuk_model->get_by_id($id);

        $this->db->trans_start();
        $this->Barang_masuk_model->delete($id);
        $this->update_stok_barang($data->id_barang, -$data->jumlahMasuk, null);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    private function update_stok_barang($id_barang, $jumlah, $supplier = null)
    {
        $this->db->set('stock', 'stock + (' . $jumlah . ')', FALSE);
        
        // Jika ada supplier yang diberikan, update supplier juga
        if (!is_null($supplier)) {
            $this->db->set('supplier', $supplier);
        }

        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang');
    }
}
