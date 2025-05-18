<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Supplier</h4>
        <button id="btnAdd" class="btn btn-secondary">Tambah Supplier</button>
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
                <?php $no = 1; foreach ($supplier as $row): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $row->nama ?></td>
                        <td><?= $row->perusahaan ?></td>
                        <td><?= $row->alamat ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning btnEdit" data-id="<?= $row->id_sales ?>" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row->id_sales ?>" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form Tambah/Edit Supplier -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formSupplier">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_sales" id="id_sales">
                    
                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label text-right">Nama Supplier</label>
                        <div class="col-sm-8">
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label text-right">Perusahaan</label>
                        <div class="col-sm-8">
                            <input type="text" name="perusahaan" id="perusahaan" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label class="col-sm-4 col-form-label text-right">Alamat</label>
                        <div class="col-sm-8">
                            <textarea name="alamat" id="alamat" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#supplierTable').DataTable();

    // Show Modal Add
    $('#btnAdd').click(function() {
        $('#formModalLabel').text('Tambah Supplier');
        $('#formSupplier')[0].reset();
        $('#id_sales').val('');
        $('#formModal').modal('show');
    });

    // Show Modal Edit
    $('.btnEdit').click(function() {
        let id = $(this).data('id');
        $.get('<?= base_url("supplier/get/") ?>' + id, function(data) {
            $('#formModalLabel').text('Edit Supplier');
            $('#id_sales').val(data.id_sales);
            $('#nama').val(data.nama);
            $('#perusahaan').val(data.perusahaan);
            $('#alamat').val(data.alamat);
            $('#formModal').modal('show');
        }, 'json');
    });

    // Form Submit
    $('#formSupplier').submit(function(e) {
        e.preventDefault();
        $.post('<?= base_url("supplier/store") ?>', $(this).serialize(), function() {
            Swal.fire('Sukses', 'Data berhasil disimpan.', 'success').then(() => location.reload());
        });
    });

    // Delete Supplier
    $('.btnDelete').click(function() {
        Swal.fire({
            title: 'Yakin ingin menghapus data ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $.get('<?= base_url("supplier/delete/") ?>' + $(this).data('id'), function() {
                    location.reload();
                });
            }
        });
    });
});
</script>
