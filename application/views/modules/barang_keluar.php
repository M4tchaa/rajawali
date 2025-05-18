<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Data Barang Keluar</h4>
        <button id="btnAdd" class="btn btn-secondary" data-toggle="modal" data-target="#formModal">Tambah Barang Keluar</button>
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
                <?php $no = 1;
                foreach ($barang_keluar as $row): ?>
                    <tr data-id="<?= $row->id_barangKeluar ?>">
                        <td><?= $no++ ?></td>
                        <td><?= $row->id_barang ?></td>
                        <td><?= $row->namaBarang ?></td>
                        <td><?= date('d-m-Y', strtotime($row->tanggalKeluar)) ?></td>
                        <td><?= $row->jumlahKeluar ?></td>
                        <td>
                            <button class="btn btn-sm btn-warning btnEdit" data-id="<?= $row->id_barangKeluar ?>" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger btnDelete" data-id="<?= $row->id_barangKeluar ?>" title="Hapus">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal untuk Tambah/Edit Barang Keluar -->
<div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formBarangKeluar">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModalLabel">Tambah Barang Keluar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_barangKeluar" id="id_barangKeluar">

                    <!-- <div class="form-group row mb-3">
                        <label for="id_barang" class="col-sm-4 col-form-label text-right">
                            ID Barang <span class="text-danger"></span>
                        </label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="id_barang" name="id_barang" readonly>
                        </div>
                    </div> -->

                    <div class="form-group row mb-3">
                        <label for="namaBarang" class="col-sm-4 col-form-label text-right">
                            Nama Barang <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <select class="form-control" id="namaBarang" name="namaBarang"></select>
                            <input type="hidden" name="id_barang" id="id_barang">
                            <input type="hidden" name="namaBarangText" id="namaBarangText">
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="tanggalKeluar" class="col-sm-4 col-form-label text-right">
                            Tanggal Keluar <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="date" class="form-control" id="tanggalKeluar" name="tanggalKeluar" required>
                        </div>
                    </div>

                    <div class="form-group row mb-3">
                        <label for="jumlahKeluar" class="col-sm-4 col-form-label text-right">
                            Jumlah Keluar <span class="text-danger">*</span>
                        </label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="jumlahKeluar" name="jumlahKeluar" min="1" required>
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
    $(document).ready(function() {
        var table = $('#barangKeluarTable').DataTable();

        // Reset form modal ketika ditutup
        $('#formModal').on('hidden.bs.modal', function() {
            $('#formBarangKeluar')[0].reset();
            $('#id_barangKeluar').val('');
            $('#formModalLabel').text('Tambah Barang Keluar');
            $('#btnSave').text('Simpan');
        });

        // Tombol Add klik
        $('#btnAdd').click(function() {
            $('#formModalLabel').text('Tambah Barang Keluar');
            $('#btnSave').text('Simpan');
            $('#formModal').modal('show');
        });

        // Tombol Edit klik
        $('#barangKeluarTable').on('click', '.btnEdit', function() {
            var id = $(this).data('id');
            console.log("Edit Button Clicked - ID:", id);

            $.ajax({
                url: '<?= base_url('barang_keluar/get/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("Data Retrieved for Edit:", data);

                    $('#id_barangKeluar').val(data.id_barangKeluar);
                    $('#id_barang').val(data.id_barang);

                    // Set select2 dengan option baru dan select langsung
                    var option = new Option(data.namaBarang, data.id_barang, true, true);
                    $('#namaBarang').empty().append(option).trigger('change');

                    console.log("Nama Barang:", data.namaBarang);
                    console.log("ID Barang:", data.id_barang);

                    $('#tanggalKeluar').val(data.tanggalKeluar);
                    $('#jumlahKeluar').val(data.jumlahKeluar);

                    $('#formModalLabel').text('Edit Barang Keluar');
                    $('#btnSave').text('Update');
                    $('#formModal').modal('show');
                }
            });
        });

        // Submit form Add/Edit
        $('#formBarangKeluar').submit(function(e) {
            e.preventDefault();

            var id = $('#id_barangKeluar').val();
            var url = id ? '<?= base_url('barang_keluar/update/') ?>' + id : '<?= base_url('barang_keluar/store') ?>';

            console.log("Form Submit - URL:", url);

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    id_barang: $('#id_barang').val(),
                    namaBarang: $('#namaBarangText').val(),
                    tanggalKeluar: $('#tanggalKeluar').val(),
                    jumlahKeluar: $('#jumlahKeluar').val()
                },
                dataType: 'json',
                success: function(res) {
                    if (res.success) {
                        $('#formModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: id ? 'Data berhasil diupdate' : 'Data berhasil ditambahkan',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: res.message,
                        });
                    }
                },
                error: function() {
                    Swal.fire('Error', 'Terjadi kesalahan koneksi.', 'error');
                }
            });
        });


        // Tombol Delete dengan SweetAlert2 konfirmasi
        $('#barangKeluarTable').on('click', '.btnDelete', function() {
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
                        url: '<?= base_url('barang_keluar/delete/') ?>' + id,
                        method: 'POST',
                        dataType: 'json',
                        success: function(res) {
                            if (res.success) {
                                Swal.fire('Terhapus!', 'Data berhasil dihapus.', 'success').then(() => location.reload());
                            } else {
                                Swal.fire('Gagal', 'Gagal menghapus data.', 'error');
                            }
                        },
                        error: function() {
                            Swal.fire('Error', 'Terjadi kesalahan koneksi.', 'error');
                        }
                    });
                }
            });
        });
    });

    $(document).ready(function() {
        $('#namaBarang').select2({
            dropdownParent: $('#formModal'),
            placeholder: 'Cari nama barang...',
            allowClear: true,
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
                    console.log("Search Results:", data);
                    return {
                        results: data.map(function(item) {
                            return {
                                id: item.id, // ID barang
                                text: item.text // Nama barang
                            };
                        })
                    };
                }
            }
        });

        // Set ID Barang otomatis
        $('#namaBarang').on('select2:select', function(e) {
            const data = e.params.data;
            $('#id_barang').val(data.id);
            $('#namaBarangText').val(data.text); // Nama barang text
            console.log("Selected Item - ID Barang:", data.id, "Nama Barang:", data.text);
        });

        $('#namaBarang').on('select2:clear', function() {
            $('#id_barang').val('');
            $('#namaBarangText').val('');
            console.log("Select2 Cleared");
        });

        // Tombol Edit klik
        $('#barangKeluarTable').on('click', '.btnEdit', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '<?= base_url('barang_keluar/get/') ?>' + id,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#id_barangKeluar').val(data.id_barangKeluar);
                    $('#id_barang').val(data.id_barang);

                    // Gunakan Select2 untuk menampilkan nama barang
                    var option = new Option(data.namaBarang, data.id_barang, true, true);
                    $('#namaBarang').append(option).trigger('change');
                    console.log(data.namaBarang);
                    $('#id_barang').val(data.id_barang);

                    $('#tanggalKeluar').val(data.tanggalKeluar);
                    $('#jumlahKeluar').val(data.jumlahKeluar);

                    $('#formModalLabel').text('Edit Barang Keluar');
                    $('#btnSave').text('Update');
                    $('#formModal').modal('show');
                }
            });
        });
    });
</script>