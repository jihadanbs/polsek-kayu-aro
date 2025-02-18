<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= $title ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= base_url('assets/img/binmas.png') ?>" rel="icon">
    <link href="<?= base_url('assets/img/binmas.png') ?>" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Glightbox CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <!-- Glightbox JS -->
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
    <!-- Sweet Alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js"></script>
    <link href="<?= base_url('assets/admin/libs/sweetalert2/sweetalert2.min.css') ?>" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@srexi/purecounterjs@1.1.4/dist/purecounter_vanilla.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= base_url('assets/admin/css/bootstrap.min.css') ?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= base_url('assets/admin/css/icons.min.css') ?>" rel="stylesheet" type="text/css" />
    <!-- Rater -->
    <link href="https://cdn.jsdelivr.net/npm/rater-js/lib/style.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/rater-js/index.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/rater-jquery@1.0.0/rater.min.js"></script> -->

    <!-- Chart -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/offline-exporting.js"></script>

    <!-- SEO untuk Polsek Kayu Aro -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <meta name="keywords" content="polsek, kabupaten kerinci, kayu aro, kerinci, polsek kayu aro">
    <meta http-equiv="Accept-CH" content="Sec-CH-UA-Platform-Version, Sec-CH-UA-Model" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/binmas.png'); ?>" />
    <link rel="amphtml" href="<?= base_url('amp/' . uri_string()); ?>">
    <link rel="canonical" href="<?= current_url(); ?>" />
    <meta property="og:site_name" content="Polsek Kayu Aro" />
    <meta property="og:title" content="Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta property="og:url" content="<?= current_url(); ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:description" content="Polsek Kayu Aro Siap Melayani Masyarakat " />
    <meta property="og:image" content="<?= base_url('assets/img/binmas.png'); ?>" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="600" />
    <meta itemprop="name" content="Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta itemprop="url" content="<?= current_url(); ?>" />
    <meta itemprop="description" content="Polsek Kayu Aro menyediakan layanan Pelayanan Masyarakat melalui website Polsek Kayu Aro." />
    <meta itemprop="thumbnailUrl" content="<?= base_url('assets/img/binmas.png'); ?>" />
    <link rel="image_src" href="<?= base_url('assets/img/binmas.png'); ?>" />
    <meta itemprop="image" content="<?= base_url('assets/img/binmas.png'); ?>" />
    <meta name="twitter:title" content="Polsek Kayu Aro - Pengelolaan Pelayanan Polsek Kayu Aro" />
    <meta name="twitter:image" content="<?= base_url('assets/img/binmas.png'); ?>" />
    <meta name="twitter:url" content="<?= current_url(); ?>" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="Polsek Kayu Aro Siap Melayani Masyarakat " />
    <meta name="description" content="Polsek Kayu Aro menyediakan layanan Pelayanan Masyarakat melalui website Polsek Kayu Aro." />
    <!-- End SEO untuk Polsek Kayu Aro -->

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
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta name="referrer" content="no-referrer">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/aos/aos.css" rel="stylesheet') ?>">
    <link href="<?= base_url('assets/vendor/glightbox/css/glightbox.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/vendor/swiper/swiper-bundle.min.css') ?>" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= base_url('assets/css/main.css') ?>" rel="stylesheet">

    <!-- Script Form Review -->
    <script>
        $(document).ready(function() {
            $("#formReview").submit(function(event) {
                event.preventDefault(); // Mencegah form dari submit default

                // Mengambil nilai dari input field
                var namaLengkap = $("#nama_lengkap").val();
                var pekerjaan = $("#pekerjaan").val();
                var pesanReview = $("#pesan_review").val();
                var rating = myRater.getRating(); // Mendapatkan nilai rating
                var fileFoto = $("#file_foto").val();

                // console.log("Rating before validation: ", rating); // Debugging
                // console.log("Nama Lengkap: ", namaLengkap);
                // console.log("Pekerjaan: ", pekerjaan);
                // console.log("Pesan Review: ", pesanReview);
                // console.log("File Foto: ", fileFoto); // Debugging

                // Array untuk menyimpan field-field yang belum diisi
                var fieldsKosong = [];

                // Validasi setiap input, jika kosong tambahkan ke fieldsKosong
                if (namaLengkap === "") {
                    fieldsKosong.push("Nama Lengkap");
                }
                if (pekerjaan === "") {
                    fieldsKosong.push("Pekerjaan");
                }
                if (pesanReview === "") {
                    fieldsKosong.push("Text Review");
                }

                // Validasi Rating
                if (rating === null || rating === 0) { // Memastikan rating tidak null atau 0
                    fieldsKosong.push("Rating");
                }
                if (fileFoto === "") {
                    fieldsKosong.push("Unggah Foto");
                }

                // Jika ada field yang belum diisi, tampilkan pesan peringatan
                if (fieldsKosong.length > 0) {
                    var pesanPeringatan = "Kolom " + fieldsKosong.join(", ") + " Belum diisi, Mohon isi terlebih dahulu !";
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: pesanPeringatan,
                    });
                    return; // Keluar dari fungsi jika ada field yang kosong
                }

                // Proses pengiriman form
                var formData = new FormData(this);
                formData.append("rating", rating); // Menyisipkan rating ke form data

                // Kirim data formulir ke server menggunakan AJAX
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Tampilkan pesan sukses jika berhasil
                        Swal.fire({
                            html: '<img src="<?= base_url('assets/img/validation.gif') ?>" style="width: 200px;">' +
                                '<p style="margin-top: 20px;">Review berhasil disimpan ! Terima kasih atas Review Yang Anda Berikan.</p>',
                            showCloseButton: true,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });

                        // Merefresh halaman setelah 3 detik
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                    },
                    error: function(xhr, status, error) {
                        // Tampilkan pesan error jika ada kesalahan
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan dalam mengirim data. Silakan coba lagi.',
                        });
                    }
                });
            });
        });
    </script>
</head>