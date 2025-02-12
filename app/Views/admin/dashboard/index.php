<?= $this->include('admin/layouts/script') ?>

</head>
<style>
    .greeting-card {
        position: relative;
        background-color: #28527a;
        border-radius: 15px;
        padding: 20px;
        color: #f4d160;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: smoothBounce 2s infinite ease-in-out;
    }

    .greeting-title {
        color: #FFF;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
    }

    .greeting-message {
        font-size: 18px;
        line-height: 1.5;
        font-weight: bold;
    }

    .greeting-card img {
        max-width: 100px;
        transition: transform 0.3s;
    }

    .greeting-card img:hover {
        transform: scale(1.1);
    }

    @keyframes smoothBounce {

        0% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }

        100% {
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .greeting-title {
            font-size: 24px;
        }

        .greeting-message {
            font-size: 16px;
        }
    }
</style>

<body>
    <?= $this->include('admin/layouts/navbar') ?>
    <?= $this->include('admin/layouts/sidebar') ?>
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Dashboard</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <!-- Greeting Card -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="greeting-card">
                            <div class="row align-items-center">
                                <div class="col-md-10">
                                    <h2 class="greeting-title mb-2">Selamat Datang Di Halaman Admin Babinsa Polsek Kayu Aro</h2>
                                    <p class="greeting-message">"Setiap Langkah Kecil Membawa Kita Lebih Dekat Pada Tujuan Besar! &#128521"</p>
                                </div>
                                <div class="col-md-1 text-end">
                                    <img src="<?= base_url('assets/img/binmas.png') ?>" height="100px" alt="Welcome">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Desa -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalDesaCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-university fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Data Desa</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- Babin -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalBabinCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-address-card fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Anggota Bhabin</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">feedback Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- Laporan -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalLaporanCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-book fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Data Laporan</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">feedback Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- Total Foto -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalFotoCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-camera-retro fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Data Galeri</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">feedback Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- Total Informasi -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalInformasiCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-certificate fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Data Informasi-Edukasi</span>
                                    <!-- <span class="ms-0 text-muted font-size-16 d-block text-truncate" style="color: #f4d160 !important;">feedback Informasi</span> -->
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <!-- Total Feedback -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="totalCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-comments fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-4">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Jumlah Semua Feedback</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <!-- End Total Feedback -->

                    <!-- Total Belum Dibalas dan Sudah Ditanggapi -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="belumDibalasCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-hourglass-start fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Feedback Belum Dibalas</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100" style="background-color: #28527a;">
                            <div style="background-color: #28527a;"></div>
                            <ul class="bg-bubbles">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block"></span>
                                        <h4 class="mb-3">
                                            <span class="counter-value ms-3" id="sudahDiTanggapiCounter" data-target="0" style="color: #f4d160; font-size: 32px;">0</span>
                                        </h4>
                                    </div>

                                    <div class="col-6">
                                        <i class="fas fa-check-circle fa-4x text-muted" style="color: #f4d160 !important;"></i>
                                    </div>
                                </div>
                                <div class="text-nowrap mt-3">
                                    <span class="ms-0 text-muted d-block text-truncate fw-bold" style="color: #f4d160 !important; font-size: 16px;">Feedback Sudah Ditanggapi</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <!-- End Total Belum Dibalas dan Sudah Ditanggapi -->

                </div><!-- end row-->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->
    <?= $this->include('admin/layouts/footer') ?>

    </div>
    <!-- END layout-wrapper -->
    <?= $this->include('admin/layouts/script2') ?>

    <!-- Script Total Data Per Fitur -->
    <!-- Total Desa -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                $.ajax({
                    url: "<?= site_url('admin/desa/totalData'); ?>",
                    type: "GET",
                    success: function(responseInformasi) {
                        // Hitung total gabungan
                        var total = parseInt(responseInformasi.total);
                        // Update nilai total pada elemen dengan id "totalDesaCounter"
                        $("#totalDesaCounter").attr("data-target", total);
                        $("#totalDesaCounter").text(total);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Anggota Bhabin -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/babin/totalData", function(responsePemohon) {
                    // Update nilai total pada elemen dengan id "totalCounter"
                    var total = parseInt(responsePemohon.total);
                    $("#totalBabinCounter").attr("data-target", total);
                    $("#totalBabinCounter").text(total);
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url, // URL untuk total Desa
                    type: "GET",
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Laporan -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/laporan/totalData", function(responsePemohon) {
                    // Update nilai total pada elemen dengan id "totalCounter"
                    var total = parseInt(responsePemohon.total);
                    $("#totalLaporanCounter").attr("data-target", total);
                    $("#totalLaporanCounter").text(total);
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url, // URL untuk total Desa
                    type: "GET",
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Galeri Foto -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/galeri/totalData", function(responsePemohon) {
                    // Update nilai total pada elemen dengan id "totalCounter"
                    var total = parseInt(responsePemohon.total);
                    $("#totalFotoCounter").attr("data-target", total);
                    $("#totalFotoCounter").text(total);
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url, // URL untuk total Desa
                    type: "GET",
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Informasi-Edukasi -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/informasi/totalData", function(responsePemohon) {
                    // Update nilai total pada elemen dengan id "totalCounter"
                    var total = parseInt(responsePemohon.total);
                    $("#totalInformasiCounter").attr("data-target", total);
                    $("#totalInformasiCounter").text(total);
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url, // URL untuk total Desa
                    type: "GET",
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Feedback -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/feedback/totalData", function(responsePemohon) {
                    // Update nilai total pada elemen dengan id "totalCounter"
                    var total = parseInt(responsePemohon.total);
                    $("#totalCounter").attr("data-target", total);
                    $("#totalCounter").text(total);
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url, // URL untuk total feedback
                    type: "GET",
                    success: function(response) {
                        callback(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- Total Belum Dibalas dan Sudah Ditanggapi -->
    <script>
        $(document).ready(function() {
            updateCounts();

            function updateCounts() {
                // Update count for "Belum dibalas"
                updateCounter("Belum dibalas", "belumDibalasCounter");

                // Update count for "Sudah Ditanggapi"
                updateCounter("Sudah Ditanggapi", "sudahDiTanggapiCounter");
            }

            function updateCounter(status, counterId) {
                // Ajax request untuk tb_pemohon
                $.ajax({
                    url: "/admin/feedback/totalByStatus/" + status,
                    type: "GET",
                    success: function(responsePemohon) {
                        // Menghitung total dari response
                        var total = parseInt(responsePemohon.total);

                        // Update nilai pada elemen dengan id sesuai counterId
                        $("#" + counterId).attr("data-target", total);
                        $("#" + counterId).text(total);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            }
        });
    </script>

    <!-- End Script Total Data Per Fitur -->
</body>

</html>