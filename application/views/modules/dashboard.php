<div class="container mt-4">
    <h2>Dashboard</h2>
    <div class="row mt-3">
        <!-- Total Barang -->
        <div class="col-md-4">
            <div class="card border-left-primary shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Barang</h5>
                    <p class="card-text display-4"><?= $data['total_barang'] ?></p>
                </div>
            </div>
        </div>
        
        <!-- Total Supplier -->
        <div class="col-md-4">
            <div class="card border-left-success shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Total Supplier</h5>
                    <p class="card-text display-4"><?= $data['total_supplier'] ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <canvas id="barangMasukChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="barangKeluarChart"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Barang Masuk Chart
        var ctxMasuk = document.getElementById('barangMasukChart').getContext('2d');
        var barangMasukChart = new Chart(ctxMasuk, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($data['barang_masuk'], 'date')) ?>,
                datasets: [{
                    label: 'Barang Masuk',
                    data: <?= json_encode(array_column($data['barang_masuk'], 'total')) ?>,
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Tanggal' } },
                    y: { title: { display: true, text: 'Jumlah Barang Masuk' } }
                }
            }
        });

        // Barang Keluar Chart
        var ctxKeluar = document.getElementById('barangKeluarChart').getContext('2d');
        var barangKeluarChart = new Chart(ctxKeluar, {
            type: 'line',
            data: {
                labels: <?= json_encode(array_column($data['barang_keluar'], 'date')) ?>,
                datasets: [{
                    label: 'Barang Keluar',
                    data: <?= json_encode(array_column($data['barang_keluar'], 'total')) ?>,
                    borderColor: '#e74a3b',
                    backgroundColor: 'rgba(231, 74, 59, 0.1)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { title: { display: true, text: 'Tanggal' } },
                    y: { title: { display: true, text: 'Jumlah Barang Keluar' } }
                }
            }
        });
    });
</script>
