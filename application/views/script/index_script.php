<script>
    $(document).ready(function() {
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            const title = $(this).data('title');
            const date = $(this).data('date');
            const image = $(this).data('image');

            $('#agendaModalLabel').text('Edit Agenda');
            $('#form-agenda').attr('action', '<?= base_url('Agenda/update') ?>');
            $('#id_agenda').val(id);
            $('#title').val(title);
            $('#date').val(date);
            $('#old_image').val(image);

            // Tampilkan preview gambar lama
            const imageUrl = '<?= base_url('uploads/agenda/') ?>' + image;
            $('#preview-old-image').attr('src', imageUrl).show();
        });

        $('#agendaModal').on('hidden.bs.modal', function() {
            $('#form-agenda')[0].reset();
            $('#form-agenda').attr('action', '<?= base_url('Agenda/save') ?>');
            $('#agendaModalLabel').text('Tambah Agenda');
            $('#id_agenda').val('');
            $('#old_image').val('');
            $('#preview-old-image').attr('src', '').hide();
        });
    });

        function showLowStockAlert() {
        $.ajax({
            url: '<?= base_url("master_barang/check_low_stock") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.length > 0) {
                    // Siapkan list notifikasi
                    let notifList = '';
                    response.forEach((item, index) => {
                        notifList += `<li class="list-group-item">
                            <strong>${index + 1}. ${item.namaBarang}</strong> - Stok: ${item.stock} (Min: ${item.min_stock})
                        </li>`;
                    });

                    // Tampilkan notifikasi SweetAlert
                    Swal.fire({
                        title: 'Peringatan Stok Rendah',
                        html: `<ul class="list-group">${notifList}</ul>`,
                        icon: 'warning',
                        confirmButtonText: 'Tutup'
                    });
                } else {
                    Swal.fire({
                        title: 'Semua Aman!',
                        text: 'Tidak ada barang dengan stok rendah.',
                        icon: 'success',
                        confirmButtonText: 'Tutup'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data stok rendah:", error);
                Swal.fire({
                    title: 'Error',
                    text: 'Gagal mengambil data stok rendah.',
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    }

        // Fungsi untuk mengambil jumlah stok rendah (untuk badge notifikasi)
    function updateLowStockBadge() {
        $.ajax({
            url: '<?= base_url("master_barang/check_low_stock") ?>',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                let notifBadge = $('#notifBadge');
                if (response.length > 0) {
                    notifBadge.text(response.length);
                    notifBadge.show();
                } else {
                    notifBadge.hide();
                }
            },
            error: function(xhr, status, error) {
                console.error("Gagal mengambil data stok rendah:", error);
            }
        });
    }

    // Jalankan saat halaman dimuat
    $(document).ready(function() {
        updateLowStockBadge();
    });
</script>