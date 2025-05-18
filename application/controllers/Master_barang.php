<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master_barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Master_barang_model');
        $this->load->helper(['url', 'form']);
        $this->load->library(['session', 'upload']);
    }

    public function index()
    {
        $data['title'] = 'Master Barang';
        $data['barang'] = $this->Master_barang_model->get_all();

        $this->load->view('layout/header');
        $this->load->view('layout/mainwrapper', [
            'content' => 'modules/master_barang',
            'barang' => $data['barang']
        ]);
        $this->load->view('layout/footer');
    }

    public function get($id)
    {
        $data = $this->Master_barang_model->get_by_id($id);
        echo json_encode($data);
    }

    public function store()
    {
        $post = $this->input->post();

        $data = [
            'namaBarang' => $post['namaBarang'],
            'stock' => $post['stock'],
            'min_stock' => $post['min_stock'],
            'hargaSales' => $post['hargaSales'],
            'hargaToko' => $post['hargaToko'],
            'hargaOnline' => $post['hargaOnline'],
            'hargaKompetitor' => $post['hargaKompetitor'],
            'is_deleted' => 0
        ];

        // Debugging - Pastikan Folder Ada
        $upload_path = FCPATH . 'content/uploads/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        // Handle gambar jika diupload
        if (!empty($_FILES['gambar']['name'])) {
            $target_file = $upload_path . time() . '_' . $_FILES['gambar']['name'];
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                $data['gambar'] = basename($target_file);
            }
        }

        if (empty($post['id_barang'])) {
            $insert = $this->Master_barang_model->insert($data);
            $message = $insert ? 'Barang berhasil ditambahkan.' : 'Gagal menambahkan barang.';
        } else {
            $update = $this->Master_barang_model->update($post['id_barang'], $data);
            $message = $update ? 'Barang berhasil diupdate.' : 'Gagal mengupdate barang.';
        }

        echo json_encode(['success' => isset($insert) ? $insert : $update, 'message' => $message]);
    }


    public function delete($id)
    {
        $this->Master_barang_model->soft_delete($id);
        redirect('master_barang');
    }

    // ✅ Fungsi Search - Kembali
    public function search()
    {
        $query = $this->input->get('q');

        // Query pencarian dari database hanya untuk barang yang tidak terhapus
        $this->db->like('namaBarang', $query);
        $this->db->where('is_deleted', 0);
        $result = $this->db->get('barang')->result_array();

        // Mapping ke format JSON yang sesuai untuk Select2
        $data = [];
        foreach ($result as $row) {
            $data[] = [
                'id' => $row['id_barang'],
                'text' => $row['namaBarang']
            ];
        }

        echo json_encode($data);
    }

    public function check_low_stock()
    {
        $this->load->model('Master_barang_model');
        $low_stock_items = $this->Master_barang_model->get_low_stock();
        echo json_encode($low_stock_items);
    }
}
