<?= $this->include('admin/layouts/script') ?>
<style>
    .custom-alert {
        font-size: 12px;
    }

    .form-control-lg {
        height: 50px;
        /* Sesuaikan tinggi sesuai kebutuhan */
        font-size: 1.5rem;
        /* Besarkan ukuran font jika perlu */
    }

    .form-control {
        padding: 10px;
        /* Sesuaikan nilai padding sesuai kebutuhan */
    }

    .invalid-feedback {
        font-size: 0.9rem;
        /* Sesuaikan ukuran font alert */
        margin-top: 5px;
        /* Tambahkan jarak antara input dan alert */
    }
</style>

<body>

    <!-- <body data-layout="horizontal"> -->
    <div class="auth-page">
        <div class="container-fluid p-0">
            <div class="row g-0">
                <div class="col-xxl-3 col-lg-4 col-md-5">
                    <div class="auth-full-page-content d-flex p-sm-5 p-4">
                        <div class="w-100">
                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5 text-center">
                                    <a href="<?= site_url('/') ?>" class="d-block auth-logo" target="_blank">
                                        <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="28"> <span class="logo-txt">Polsek Kayu Aro</span>
                                    </a>
                                </div>
                                <div class="auth-content my-auto">
                                    <div class="text-center">

                                        <div class="avatar-lg mx-auto">
                                            <div class="avatar-title rounded-circle bg-light">
                                                <i class="bx bxs-user h2 mb-0 text-primary"></i>
                                            </div>
                                        </div>
                                        <div class="p-2 mt-4">

                                            <h4>Verifikasi Kode</h4>
                                            <p class="mb-5">Masukkan 4 Kode Digit yang telah kami kirimkan ke <span class="fw-bold"><?= $userEmail ?? 'email tidak ditemukan' ?></span></p>
                                            <?php $session = \Config\Services::session(); ?>
                                            <?php if (session()->getFlashdata('pesan')) : ?>
                                                <div class="alert alert-success alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                                    <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                                    <?= session()->getFlashdata('pesan') ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (session()->getFlashdata('success')) : ?>
                                                <div class="alert alert-success alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                                    <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                                    <?= session()->getFlashdata('success') ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>

                                            <?php if (session()->getFlashdata('gagal')) : ?>
                                                <div class="alert alert-danger alert-border-left alert-dismissible fade show custom-alert" role="alert">
                                                    <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                                    <?= session()->getFlashdata('gagal') ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            <?php endif; ?>

                                            <form action="" method="POST" class="mt-4 pt-2" autocomplete="off">
                                                <?= csrf_field() ?>
                                                <div class="row">
                                                    <!-- Digit 1 -->
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit1-input" class="visually-hidden">Digit 1</label>
                                                            <input type="text" class="form-control form-control-lg text-center two-step" maxLength="1" name="digit1" value="<?= old('digit1') ?>" id="digit1-input" required>
                                                        </div>
                                                    </div>
                                                    <!-- Digit 2 -->
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit2-input" class="visually-hidden">Digit 2</label>
                                                            <input type="text" class="form-control form-control-lg text-center two-step <?= (isset($validation['digit2'])) ? 'is-invalid' : ''; ?>" maxLength="1" name="digit2" value="<?= old('digit2') ?>" id="digit2-input" required>

                                                        </div>
                                                    </div>
                                                    <!-- Digit 3 -->
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit3-input" class="visually-hidden">Digit 3</label>
                                                            <input type="text" class="form-control form-control-lg text-center two-step <?= (isset($validation['digit3'])) ? 'is-invalid' : ''; ?>" maxLength="1" name="digit3" value="<?= old('digit3') ?>" id="digit3-input" required>

                                                        </div>
                                                    </div>
                                                    <!-- Digit 4 -->
                                                    <div class="col-3">
                                                        <div class="mb-3">
                                                            <label for="digit4-input" class="visually-hidden">Digit 4</label>
                                                            <input type="text" class="form-control form-control-lg text-center two-step <?= (isset($validation['digit4'])) ? 'is-invalid' : ''; ?>" maxLength="1" name="digit4" value="<?= old('digit4') ?>" id="digit4-input" required>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <button class="btn w-100 waves-effect waves-light" type="submit" style="background-color: #dc3545; color: #fff;">Submit</button>
                                                </div>
                                            </form>

                                        </div>

                                    </div>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Tidak Menerima Email ? <a href="<?= site_url('/authentication/tidakBisaLogin'); ?>"
                                                class="text-danger fw-semibold"> Kirim Ulang </a> </p>
                                    </div>
                                </div>
                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">© <script>
                                            document.write(new Date().getFullYear())
                                        </script> Polsek Kayu Aro . Dibuat Dengan <i class="mdi mdi-heart text-danger"></i> Oleh Reissa Giana Azaria</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end auth full page content -->
                </div>
                <!-- end col -->
                <?= $this->include('admin/layouts/animasiAuth') ?>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container fluid -->
    </div>

    <?= $this->include('admin/layouts/script2') ?>

</body>

</html>