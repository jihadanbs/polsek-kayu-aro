<?= $this->include('admin/layouts/script') ?>
<style>
    .custom-alert {
        font-size: 12px;
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
                                        <h5 class="mb-0">Tidak Dapat Login ?</h5>
                                        <p class="text-muted mt-2">Silahkan Isi Data Dibawah !</p>
                                    </div>
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

                                    <?php if (session()->getFlashdata('warning')) : ?>
                                        <div class="alert alert-warning alert-border-left alert-dismissible fade show" role="alert">
                                            <i class="mdi mdi-alert-outline align-middle me-3"></i><strong>Peringatan</strong> -
                                            <?= session()->getFlashdata('warning') ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>

                                    <form action="" method="POST" class="mt-4 pt-2" autocomplete="off">
                                        <?= csrf_field() ?>

                                        <div class="mb-3">
                                            <label class="form-label">Akun Pengguna</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder=" Username/Email Terdaftar" value="<?= old('username') ?>">
                                            <?php if (isset(session()->getFlashdata('validation')['username'])) : ?>
                                                <div class="text-danger">
                                                    <?= session()->getFlashdata('validation')['username'] ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="row mb-4"></div>
                                        <div class="mb-3">
                                            <button class="btn w-100 waves-effect waves-light" type="submit" style="background-color: #dc3545; color: #fff;">Submit</button>
                                        </div>
                                    </form>

                                    <div class="mt-5 text-center">
                                        <p class="text-muted mb-0">Kembali ke Halaman <a href="<?= site_url('/authentication/login'); ?>" class="text-danger fw-semibold">Login</a> </p>
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