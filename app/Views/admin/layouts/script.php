<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= base_url('assets/img/binmas.png') ?>">
    <!-- DataTables -->
    <link href="<?= base_url('assets/admin/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="<?= base_url('assets/admin/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- preloader css -->
    <link rel="stylesheet" href="<?= base_url('assets/admin/css/preloader.min.css') ?>" type="text/css" />
    <!-- SweetAlert -->
    <link href="<?= base_url('assets/admin/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/admin/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/admin/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= base_url('assets/admin/css/app.min.css') ?>" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://cdn.ckeditor.com/4.22.1/full-all/ckeditor.js"></script>
    <!-- Maps -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <title><?= $title ?></title>

    <!-- SEO untuk Admin Polsek Kayu Aro -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="keywords" content="admin, polsek, kabupaten kerinci, kayu aro, kerinci">
    <meta http-equiv="Accept-CH" content="Sec-CH-UA-Platform-Version, Sec-CH-UA-Model" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('path/to/icon.ico'); ?>" />
    <link rel="amphtml" href="<?= base_url('amp/' . uri_string()); ?>">
    <link rel="canonical" href="<?= current_url(); ?>" />
    <meta property="og:site_name" content="Admin Polsek Kayu Aro" />
    <meta property="og:title" content="Admin Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Admin Polsek Kayu Aro adalah halaman untuk mengelola Pelayanan Masyarakat dari website Polsek Kayu Aro." />
    <meta property="og:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" />
    <meta itemprop="name" content="Admin Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta itemprop="url" content="<?= current_url(); ?>" />
    <meta itemprop="description" content="Admin Polsek Kayu Aro menyediakan layanan Pelayanan Masyarakat dari website Polsek Kayu Aro." />
    <meta itemprop="thumbnailUrl" content="<?= base_url('path/to/image.jpg'); ?>" />
    <link rel="image_src" href="<?= base_url('path/to/image.jpg'); ?>" />
    <meta itemprop="image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta name="twitter:title" content="Admin Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta name="twitter:image" content="<?= base_url('path/to/image.jpg'); ?>" />
    <meta name="twitter:url" content="<?= current_url(); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Admin Polsek Kayu Aro adalah halaman untuk mengelola Pelayanan Masyarakat dari website Polsek Kayu Aro." />
    <meta name="description" content="Admin Polsek Kayu Aro menyediakan layanan Pelayanan Masyarakat dari website Polsek Kayu Aro." />
    <!-- End SEO untuk Admin Polsek Kayu Aro -->

    <!-- Tag untuk mencegah indeks oleh mesin pencari -->
    <meta name="robots" content="noindex, nofollow, noarchive">
    <meta name="googlebot" content="noindex, nofollow, noarchive">

    <!-- Keamanan dan Aksesibilitas Lanjutan -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval'; style-src 'self' 'unsafe-inline'; img-src 'self' data:; frame-src 'self' https://www.youtube.com;"> -->
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; 
    script-src 'self' 'unsafe-inline' 'unsafe-eval' cdn.ckeditor.com;
    style-src 'self' 'unsafe-inline' cdn.ckeditor.com;
    img-src 'self' data: cdn.ckeditor.com;
    frame-src 'self' https://www.youtube.com;
    connect-src https://pdf-converter.cke-cs.com;
    form-action 'self';"> -->
    <meta http-equiv="Permissions-Policy" content="geolocation=(), microphone=(), camera=()">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta name="referrer" content="no-referrer">
    <!-- End SEO -->