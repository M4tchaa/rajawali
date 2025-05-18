<body>
    <div id="page-container" class="d-flex flex-column min-vh-100">

        <!-- Header -->
        <header id="header" class="fixed-top py-2" style="background-color: #008374;">
            <div class="container d-flex justify-content-between align-items-center">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none">
                    <h1 class="m-0 fw-bold">Mat Bilding</h1><span class="fs-3">.</span>
                </a>
                <nav>
                    <?php if ($this->session->userdata('logged_in')): ?>
                        <a href="<?= base_url('dashboard'); ?>" class="btn btn-dark">Dashboard</a>
                    <?php else: ?>
                        <a href="<?= base_url('login'); ?>" class="btn btn-light">Login</a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>


        <!-- Main Content -->
        <main class="container flex-grow-1" style="margin-top: 6rem;">
            <h1 class="mb-4 text-center">Daftar Barang</h1>
            <div class="row">
                <?php if (count($barangs) > 0): ?>
                    <?php foreach ($barangs as $row): ?>
                        <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                            <div class="card h-100 shadow-sm text-center">
                                <div class="card-img-wrapper" style="height: 180px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                    <img src="<?= base_url('content/uploads/' . htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8')) ?>"
                                        class="card-img-top"
                                        alt="<?= htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') ?>"
                                        style="max-height: 100%; max-width: 100%; object-fit: cover;">
                                </div>
                                <div class="card-body p-2">
                                    <h6 class="card-title text-truncate"><?= htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') ?></h6>
                                    <p class="card-text mb-1">Stok: <strong><?= htmlspecialchars($row['stock'], ENT_QUOTES, 'UTF-8') ?></strong></p>
                                    <p class="card-text mb-1 text-success">Rp<?= number_format($row['hargaOnline'], 0, ',', '.') ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <p class="text-center">Tidak ada data.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>


        <!-- Footer -->
        <footer class="pt-4 border-top text-white" style="background-color: #008374;">
            <div class="container text-center">
                <div class="mb-3">
                    <h1 class="text-white fw-bold fs-5 text-decoration-none">MAT BILDING</h1>
                </div>
                <div class="mb-3">
                    <a href="#" class="text-white mx-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white mx-2"><i class="bi bi-linkedin"></i></a>
                </div>
                <p class="small mb-0 pb-3">
                    © <?= date('Y') ?> <strong>PT Rajawali Bahan Bangunan</strong>. All Rights Reserved.
                </p>
            </div>
        </footer>

    </div>
</body>