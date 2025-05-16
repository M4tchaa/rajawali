<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Supplier</h4>
        <a href="#" class="btn btn-secondary">Tambah Supplier</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped" id="supplierTable">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Perusahaan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($data['supplier'] as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->perusahaan ?></td>
                        <td><?= $row->alamat ?></td>
                        <td>
                            <a href="<?= base_url('supplier/edit/' . $row->id_sales); ?>" 
                               class="btn btn-sm btn-warning" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="<?= base_url('supplier/delete/' . $row->id_sales); ?>" 
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

<script>
$(document).ready(function () {
    $('#supplierTable').DataTable();
});
</script>
