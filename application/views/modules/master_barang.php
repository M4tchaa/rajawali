<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Master Barang</h4>
        <a href="#" class="btn btn-secondary">Tambah Barang</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="masterBarangTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Stok</th>
                    <th>Harga Sales</th>
                    <th>Harga Toko</th>
                    <th>Harga Online</th>
                    <th>Harga Kompetitor</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barang)): ?>
                    <?php $no = 1;
                    foreach ($barang as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $row->namaBarang ?></td>
                            <td><?= $row->supplier ?></td>
                            <td><?= $row->stock ?></td>
                            <td><?= $row->hargaSales ?></td>
                            <td><?= $row->hargaToko ?></td>
                            <td><?= $row->hargaOnline ?></td>
                            <td><?= $row->hargaKompetitor ?></td>
                            <td>
                                <?php if ($row->gambar): ?>
                                    <img src="<?= base_url('content/uploads/' . $row->gambar) ?>" width="50">
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?= base_url('master_barang/edit/' . $row->id_barang); ?>"
                                    class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('master_barang/delete/' . $row->id_barang); ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="11" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>
    </div>
</div>

<!-- DataTables -->
<script>
    $(document).ready(function() {
        $('#masterBarangTable').DataTable();
    });
</script>