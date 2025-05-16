<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Barang Keluar</h4>
        <a href="#" class="btn btn-secondary">Tambah Barang Keluar</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped" id="barangKeluarTable">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Tanggal Keluar</th>
                    <th>Jumlah Keluar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data['barang_keluar'] as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->id_barang ?></td>
                        <td><?= $row->namaBarang ?></td>
                        <td><?= date('d-m-Y', strtotime($row->tanggalKeluar)) ?></td>
                        <td><?= $row->jumlahKeluar ?></td>
                        <td>
                            <a href="<?= base_url('barang_keluar/edit/' . $row->id_barangKeluar); ?>" 
                               class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="<?= base_url('barang_keluar/delete/' . $row->id_barangKeluar); ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- DataTables Init -->
<script>
$(document).ready(function () {
    $('#barangKeluarTable').DataTable();
});
</script>
