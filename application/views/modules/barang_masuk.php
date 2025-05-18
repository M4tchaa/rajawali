<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Barang Masuk</h4>
        <button id="btnAdd" class="btn btn-secondary" data-toggle="modal" data-target="#formModal">Tambah Barang Masuk</button>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped" id="barangMasukTable">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>ID Barang</th>
                    <th>Nama Barang</th>
                    <th>Supplier</th>
                    <th>Tanggal Masuk</th>
                    <th>Jumlah Masuk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($barang_masuk as $row): ?>
                    <tr data-id="<?= $row->id_barangMasuk ?>">
                        <td><?= $no++ ?></td>
                        <td><?= $row->id_barang ?></td>
                        <td><?= $row->namaBarang ?></td>
                        <td><?= $row->supplier ?></td>
                        <td><?= date('d-m-Y', strtotime($row->tanggalMasuk)) ?></td>
                        <td><?= $row->jumlahMasuk ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning btnEdit" data-id="<?= $row->id_barangMasuk ?>" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row->id_barangMasuk ?>" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Tambah/Edit Barang Masuk -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formBarangMasuk">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Barang Masuk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_barangMasuk" id="id_barangMasuk">

                    <div class="form-group row mb-3">
                        <label for="namaBarang" class="col-sm-4 col-form-label text-right">Nama Barang</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="namaBarang" name="namaBarang"></select>
                            <input type="hidden" name="id_barang" id="id_barang">
                        </div>
                    </div>

                    <div class="form-group row mb-3 ">
                        <label for="sales" class="col-sm-4 col-form-label text-right">Sales</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="sales" name="sales"></select>
                            <input type="hidden" name="id_sales" id="id_sales">
                        </div>
                    </div>


                    <div class="form-group row mb-3">
                        <label for="tanggalMasuk" class="col-sm-4 col-form-label text-right">Tanggal Masuk</label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggalMasuk" name="tanggalMasuk" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="jumlahMasuk" class="col-sm-4 col-form-label text-right">Jumlah Masuk</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlahMasuk" name="jumlahMasuk" min="1" required>
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


<!-- Script untuk mengaktifkan DataTables -->
<script type="text/javascript">
    $(document).ready(function() {
        var table = $('#barangMasukTable').DataTable();

        // Reset form modal ketika ditutup
        $('#formModal').on('hidden.bs.modal', function() {
            $('#formBarangMasuk')[0].reset();
            $('#id_barangMasuk').val('');
            $('#formModalLabel').text('Tambah Barang Masuk');
            $('#btnSave').text('Simpan');
        });

        // Tombol Add klik
        $('#btnAdd').click(function() {
            $('#formModalLabel').text('Tambah Barang Masuk');
            $('#btnSave').text('Simpan');
            $('#formModal').modal('show');
        });

        // Tombol Edit klik
        $('#barangMasukTable').on('click', '.btnEdit', function() {
            var id = $(this).data('id');

            $.ajax({
                url: 'barang_masuk/get/' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#id_barangMasuk').val(data.id_barangMasuk);
                    $('#id_barang').val(data.id_barang);
                    $('#id_sales').val(data.id_supplier);
                    var option = new Option(data.namaBarang, data.id_barang, true, true);
                    var option2 = new Option(data.supplier, data.id_supplier, true, true);
                    $('#sales').empty().append(option2).trigger('change');
                    $('#namaBarang').empty().append(option).trigger('change');
                    $('#tanggalMasuk').val(data.tanggalMasuk);
                    $('#jumlahMasuk').val(data.jumlahMasuk);
                    $('#formModal').modal('show');
                }
            });
        });

        // Submit form Add/Edit
        $('#formBarangMasuk').submit(function(e) {
            e.preventDefault();

            var url = $('#id_barangMasuk').val() ? '<?= base_url("barang_masuk/update/") ?>' + $('#id_barangMasuk').val() : '<?= base_url("barang_masuk/store") ?>';

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_barang: $('#id_barang').val(),
                    namaBarang: $('#namaBarang option:selected').text(),
                    id_supplier: $('#id_sales').val(),
                    supplier: $('#sales option:selected').text(),
                    tanggalMasuk: $('#tanggalMasuk').val(),
                    jumlahMasuk: $('#jumlahMasuk').val()
                },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $('#formModal').modal('hide');
                        location.reload();
                    } else {
                        alert(res.message);
                    }
                }
            });
        });

        // Tombol Delete dengan SweetAlert2 konfirmasi
        $('#barangMasukTable').on('click', '.btnDelete', function() {
            var id = $(this).data('id');

            Swal.fire({
                title: 'Yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'barang_masuk/delete/' + id,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success').then(() => location.reload());
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                            }
                        }
                    });
                }
            });
        });

        // Select2 untuk Nama Barang
    $('#namaBarang').select2({
        dropdownParent: $('#formModal'),
        placeholder: 'Cari nama barang...',
        minimumInputLength: 2,
        ajax: {
            url: '<?= base_url("master_barang/search") ?>',
            dataType: 'json',
            delay: 250,
            data: function(params) {
                return {
                    q: params.term
                };
            },
            processResults: function(data) {
                console.log("Data Barang (Select2):", data);
                return {
                    results: data.map(item => ({
                        id: item.id,
                        text: item.text
                    }))
                };
            },
            cache: true
        },
        width: 'resolve' // Menggunakan lebar sesuai elemen
    });

    // Memastikan Dropdown Select2 Selalu Terlihat
    $('#formModal').on('shown.bs.modal', function() {
        $('.select2-dropdown').css({
            'z-index': '2000', // Tetap di atas modal
            'width': 'auto', // Lebar sesuai konten
            'min-width': '300px' // Batas minimal lebar
        });
        console.log("Dropdown Select2 Terlihat");
    });

    // Set ID Barang otomatis dari Select2
    $('#namaBarang').on('select2:select', function(e) {
        const data = e.params.data;
        $('#id_barang').val(data.id);
        console.log("Selected Item - ID Barang:", data.id, "Nama Barang:", data.text);
    });

    $('#namaBarang').on('select2:clear', function() {
        $('#id_barang').val('');
        console.log("Select2 Cleared");
    });

        $('#sales').select2({
            dropdownParent: $('#formModal'),
            placeholder: 'Cari sales...',
            minimumInputLength: 2,
            ajax: {
                url: '<?= base_url("supplier/search") ?>',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: data.map(item => ({
                            id: item.id,
                            text: item.text
                        }))
                    };
                }
            }
        });

        // Set ID Sales otomatis dari Select2
        $('#sales').on('select2:select', function(e) {
            const data = e.params.data;
            $('#id_sales').val(data.id);
            console.log("Selected Sales - ID:", data.id, "Nama:", data.text);
        });

        $('#sales').on('select2:clear', function() {
            $('#id_sales').val('');
            console.log("Select2 Cleared");
        });


    });
</script>