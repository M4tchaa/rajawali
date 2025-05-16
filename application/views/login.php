<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 1rem;">
            <h3 class="text-center mb-4">Login</h3>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger text-center py-2 mb-3" role="alert">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= base_url('login/process'); ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control form-control-lg" id="username" name="username" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-lg" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">Login</button>
            </form>
        </div>
    </div>
</body>
