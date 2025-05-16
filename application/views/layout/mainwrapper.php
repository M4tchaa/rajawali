<div class="d-flex" style="height: 100vh;">
    <!-- Sidebar -->
    <div class="bg-dark text-white p-3" style="width: 250px;">
        <?php $this->load->view('layout/sidebar'); ?>
    </div>

    <!-- Right section (Navbar + Content) -->
    <div class="flex-grow-1 d-flex flex-column">
        <!-- Navbar -->
        <div>
            <?php $this->load->view('layout/adminav'); ?>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 overflow-auto p-2 bg-light">
            <?php $this->load->view($content); ?>
        </div>
    </div>
</div>
