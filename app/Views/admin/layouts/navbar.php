<style>
    @keyframes moveText {
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

    .moving-text {
        position: relative;
        top: 10px;
    }

    .navbar {
        background-color: #ffffff;
        /* Ubah sesuai kebutuhan */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        /* Tambahkan shadow */
        padding: 10px;
    }

    .navbar-brand-box {
        margin-right: auto;
    }

    .navbar-brand-box .logo-lg {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .navbar-brand-box .logo-lg img {
        height: 24px;
    }

    .navbar-brand-box .logo-txt {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        /* Warna teks */
    }

    .navbar-brand-box .logo-txt:hover {
        color: #FF5733;
        /* Warna teks saat dihover */
        transition: color 0.3s ease;
    }

    .navbar-brand-box .logo-txt:active {
        transform: scale(0.95);
        /* Efek saat tombol ditekan */
    }

    .header-item {
        background-color: transparent;
        border: none;
        cursor: pointer;
    }

    .header-item:hover {
        color: #FF5733;
        /* Warna ikon saat dihover */
        transition: color 0.3s ease;
    }

    /* Efek saat tombol navbar dihover */
    .header-item:hover .fa-bars {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }

    .form-group {
        margin-left: 10px;
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .judul {
        font-family: 'Roboto', sans-serif;
        font-size: 16px;
        color: black;
        font-weight: bold;
    }

    @keyframes textAnimation {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-5px);
        }
    }
</style>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="dashboard" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="24"> <span class="judul">POLSEK KAYU ARO</span>
                        </span>
                    </a>

                    <a href="dashboard" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="24">
                        </span>
                        <span class="logo-lg">
                            <img src="<?= base_url('assets/img/binmas.png') ?>" alt="" height="24"> <span class="judul">POLSEK KAYU ARO</span>
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                    <i class="fa fa-fw fa-bars"></i>
                </button>

                <div class="form-group m-2">
                    <div class="input-group">
                        <?php
                        if (session()->has('islogin')) {
                            date_default_timezone_set('Asia/Jakarta'); // Sesuaikan zona waktu

                            $hour = date('G');

                            if ($hour >= 5 && $hour < 12) {
                                $ucapan = 'Selamat Pagi';
                            } elseif ($hour >= 12 && $hour < 15) {
                                $ucapan = 'Selamat Siang';
                            } elseif ($hour >= 15 && $hour < 18) {
                                $ucapan = 'Selamat Sore';
                            } else {
                                $ucapan = 'Selamat Malam';
                            }

                            // Ambil nama lengkap pengguna dari sesi
                            $nama_lengkap = session()->get('nama_lengkap');

                            if ($nama_lengkap) {
                                echo "<h4 class='font-size-18 text-center py-3 moving-text'>Haii, $ucapan " . htmlspecialchars($nama_lengkap) . " &#128522;</h4>"; // Emotikon senyum
                            } else {
                                echo "<h4 class='font-size-18 text-center py-3 moving-text'>Haii, $ucapan Pengguna &#128522;</h4>"; // Jika nama_lengkap tidak ada
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex">


            <div class="dropdown d-none d-sm-inline-block">
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative me-2" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill"><?= $unreadCount ?></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0">Feedback</h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small text-reset text-decoration-underline">Belum Dibalas (<?= $unreadCount ?>)</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <?php if (empty($unread)) : ?>
                            <p class="text-center mt-3">Tidak ada notifikasi terbaru</p>
                        <?php else : ?>
                            <?php foreach ($unread as $feedback) : ?>
                                <?php if ($feedback->status == 'Belum dibalas') : ?>
                                    <a href="<?= base_url('/admin/feedback/cek_data/' . $feedback->id_feedback) ?>" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <img src="<?= base_url('assets/img/internalserver.gif') ?>" class="rounded-circle avatar-sm" alt="user-pic">
                                            </div>
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1"><?= esc($feedback->email) ?></h6>
                                                <div class="font-size-13 text-muted">
                                                    <p class="mb-1"><?= esc($feedback->nama) ?></p>
                                                    <p class="mb-0"><i class="mdi mdi-message-text-outline"></i> <span><?= esc($feedback->subjek) ?></span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="feedback">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>

            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-light-subtle border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= base_url(session('file_profil') ? session('file_profil') : 'assets/admin/images/user.png'); ?>" alt="<?= session()->has('nama_lengkap') ? session('nama_lengkap') : 'Profile Image'; ?>">
                    <?php if (session()->has('islogin')) : ?>
                        <span class="d-none d-xl-inline-block ms-1 fw-medium"><?= session('username') ?></span>
                    <?php endif; ?>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>

                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="profile"><i class="mdi mdi mdi-face-man font-size-16 align-middle me-1"></i> Akun</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/authentication/logout"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>

</header>

<?= $this->renderSection('content'); ?>