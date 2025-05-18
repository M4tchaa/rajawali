<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container-fluid d-flex justify-content-between align-items-center px-4">
        <span class="navbar-brand mb-0 h5"></span>

        <div class="d-flex align-items-center py-2 pr-4">
            <!-- Icon Notifikasi -->
            <a href="javascript:void(0);" class="text-dark position-relative" onclick="showLowStockAlert()" style="margin-right: 20px;">
                <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
                <span id="notifBadge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="display: none;">
                    0
                </span>
            </a>
        </div>
    </div>
</nav>



<script>
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
