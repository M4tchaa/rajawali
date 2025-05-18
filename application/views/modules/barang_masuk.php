<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Barang Masuk</h4>
        <a href="#" class="btn btn-secondary">Tambah Barang Masuk</a>
    </div>
    <div class="table-responsive mt-3">
        <table id="barangMasukTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Tanggal Masuk</th>
                    <th>Jumlah Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['barang_masuk'])): ?>
                    <?php $no = 1;
                    foreach ($data['barang_masuk'] as $barang): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $barang->namaBarang; ?></td>
                            <td><?= $barang->supplier; ?></td>
                            <td><?= date('d-m-Y', strtotime($barang->tanggalMasuk)); ?></td>
                            <td><?= $barang->jumlahMasuk; ?></td>
                            <td>
                                <a href="<?= base_url('barang_masuk/edit/' . $barang->id_barangMasuk); ?>"
                                    class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="<?= base_url('barang_masuk/delete/' . $barang->id_barangMasuk); ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Script untuk mengaktifkan DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#barangMasukTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    });
</script>