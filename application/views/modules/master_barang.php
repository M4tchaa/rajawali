<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Master Barang</h4>
        <button id="btnAdd" class="btn btn-secondary">Tambah Barang</button>
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
                                    <span class="text-muted">Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning btnEdit" data-id="<?= $row->id_barang ?>" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row->id_barang ?>" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="10" class="text-center">Data tidak tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Form Tambah/Edit Barang -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formBarang" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Barang</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_barang" id="id_barang">
                    
                    <div class="form-group row mb-3">
                        <label for="namaBarang" class="col-sm-4 col-form-label text-right">Nama Barang</label>
                        <div class="col-sm-8">
                            <input type="text" name="namaBarang" id="namaBarang" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="stock" class="col-sm-4 col-form-label text-right">Stok</label>
                        <div class="col-sm-8">
                            <input type="number" name="stock" id="stock" class="form-control" value="0" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hargaSales" class="col-sm-4 col-form-label text-right">Harga Sales</label>
                        <div class="col-sm-8">
                            <input type="text" name="hargaSales" id="hargaSales" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hargaToko" class="col-sm-4 col-form-label text-right">Harga Toko</label>
                        <div class="col-sm-8">
                            <input type="text" name="hargaToko" id="hargaToko" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hargaOnline" class="col-sm-4 col-form-label text-right">Harga Online</label>
                        <div class="col-sm-8">
                            <input type="text" name="hargaOnline" id="hargaOnline" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="hargaKompetitor" class="col-sm-4 col-form-label text-right">Harga Kompetitor</label>
                        <div class="col-sm-8">
                            <input type="text" name="hargaKompetitor" id="hargaKompetitor" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="gambar" class="col-sm-4 col-form-label text-right">Gambar</label>
                        <div class="col-sm-8">
                            <input type="file" name="gambar" id="gambar" class="form-control">
                            <small class="text-muted">Format: JPG, JPEG, PNG (Max: 2MB)</small>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnSave">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DataTables & JS -->
<script>
    $(document).ready(function() {
        $('#masterBarangTable').DataTable();

        $('#btnAdd').click(function() {
            $('#formModalLabel').text('Tambah Barang');
            $('#formBarang')[0].reset();
            $('#id_barang').val('');
            $('#formModal').modal('show');
        });

        // Tombol Edit
        $('.btnEdit').click(function() {
            let id = $(this).data('id');
            $.get('<?= base_url("master_barang/get/") ?>' + id, function(data) {
                $('#formModalLabel').text('Edit Barang');
                $('#id_barang').val(data.id_barang);
                $('#namaBarang').val(data.namaBarang);
                $('#stock').val(data.stock);
                $('#hargaSales').val(data.hargaSales);
                $('#hargaToko').val(data.hargaToko);
                $('#hargaOnline').val(data.hargaOnline);
                $('#hargaKompetitor').val(data.hargaKompetitor);
                $('#formModal').modal('show');
            }, 'json');
        });
    

        // Tombol Hapus
        $('.btnDelete').click(function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                text: "Data akan dihapus secara soft delete.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url("master_barang/delete/") ?>' + id,
                        method: 'GET',
                        success: function() {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        }
                    });
                }
            });
        });

            $('#btnAdd').click(function() {
        $('#formModalLabel').text('Tambah Barang');
        $('#formBarang')[0].reset();
        $('#id_barang').val('');
        $('#formModal').modal('show');
    });

    $('#btnSave').click(function() {
        var formData = new FormData($('#formBarang')[0]);

        $.ajax({
            url: '<?= base_url("master_barang/store") ?>',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            dataType: 'json',
            success: function(response) {
                console.log("Response:", response);
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: response.message,
                    }).then(() => {
                        $('#formModal').modal('hide');
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: response.message || 'Terjadi kesalahan.',
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: 'Terjadi kesalahan koneksi.',
                });
            }
        });
    });
    });
</script>
