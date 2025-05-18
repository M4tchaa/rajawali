<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_keluar_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('session');
    }

    public function index()
    {
        $data['barang_keluar'] = $this->Barang_keluar_model->get_all();
        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', ['content' => 'modules/barang_keluar', 'barang_keluar' => $data['barang_keluar']]);
        $this->load->view('layout/footer');
    }

    public function get($id)
    {
        $data = $this->Barang_keluar_model->get_by_id($id);
        echo json_encode($data);
    }

    public function store()
    {
        $post = $this->input->post();
        $jumlah_keluar = (int)$post['jumlahKeluar'];
        
        // Validasi stok cukup
        if (!$this->is_stok_cukup($post['id_barang'], $jumlah_keluar)) {
            echo json_encode(['success' => false, 'message' => 'Stok tidak mencukupi.']);
            return;
        }

        $data = [
            'id_barang' => $post['id_barang'],
            'namaBarang' => $post['namaBarang'],
            'tanggalKeluar' => $post['tanggalKeluar'],
            'jumlahKeluar' => $jumlah_keluar
        ];

        $this->db->trans_start();
        $insert = $this->Barang_keluar_model->insert($data);
        $this->update_stok_barang($post['id_barang'], -$jumlah_keluar);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function update($id)
    {
        $post = $this->input->post();
        $old_data = $this->Barang_keluar_model->get_by_id($id);
        $old_quantity = (int)$old_data->jumlahKeluar;
        $new_quantity = (int)$post['jumlahKeluar'];
        $difference = $new_quantity - $old_quantity;

        // Validasi stok cukup
        if ($difference > 0 && !$this->is_stok_cukup($post['id_barang'], $difference)) {
            echo json_encode(['success' => false, 'message' => 'Stok tidak mencukupi.']);
            return;
        }

        $data = [
            'id_barang' => $post['id_barang'],
            'namaBarang' => $post['namaBarang'],
            'tanggalKeluar' => $post['tanggalKeluar'],
            'jumlahKeluar' => $new_quantity
        ];

        $this->db->trans_start();
        $update = $this->Barang_keluar_model->update($id, $data);
        $this->update_stok_barang($post['id_barang'], -$difference);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    public function delete($id)
    {
        $data = $this->Barang_keluar_model->get_by_id($id);

        $this->db->trans_start();
        $delete = $this->Barang_keluar_model->delete($id);
        $this->update_stok_barang($data->id_barang, $data->jumlahKeluar);
        $this->db->trans_complete();

        echo json_encode(['success' => $this->db->trans_status()]);
    }

    private function update_stok_barang($id_barang, $jumlah)
    {
        $this->db->set('stock', 'stock + (' . $jumlah . ')', FALSE);
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang');
    }

    // Fungsi Validasi Stok
    private function is_stok_cukup($id_barang, $jumlah)
    {
        $stok = $this->db->select('stock')
                         ->from('barang')
                         ->where('id_barang', $id_barang)
                         ->get()
                         ->row()->stock;

        return ($stok >= $jumlah);
    }
}
