<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />


    <title>Rajawali</title>
    <!-- <link rel="icon" type="image/x-icon" href="public/rq.png"> -->

    <!-- Font Library -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- CSS Library -->
    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="public/css/sb-admin-2.min.css"> -->

    <!-- jQuery Library -->
    <script src="<?= base_url('public/js/jquery.min.js') ?>"></script>

    <!-- Custom Style -->
    <link rel="stylesheet" href="public/css/styles.css?v= . filemtime(FCPATH . public/css/styles.css));">

    <?php if (isset($css)): ?>
        <!-- CSS untuk Modul yang Aktif -->
        <link rel="stylesheet" href="<?= base_url('public/css/modules/' . $css) . '?v=' . time(); ?>">
    <?php endif; ?>

</head>