<style>
    #side-menu li {
        transition: all 0.3s ease;
    }

    #side-menu li:hover {
        transform: scale(1.1);
        /* Efek scaling saat dihover */
    }

    #side-menu li a {
        transition: all 0.3s ease;
    }

    #side-menu li a:hover {
        background-color: #f8f9fa;
        /* Warna latar belakang saat dihover */
        color: #495057;
        /* Warna teks saat dihover */
    }

    #side-menu li a.active {
        position: relative;
        background-color: white;
        /* Warna latar belakang saat aktif */
        color: #fff;
        /* Warna teks saat aktif */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Efek animasi saat aktif */
        border-top-right-radius: 50px;
        /* Lengkungan sudut kanan atas */
        border-bottom-right-radius: 50px;
        /* Lengkungan sudut kanan bawah */
        overflow: hidden;
    }

    #side-menu li a.active {
        position: relative;
        background-color: white;
        /* Warna latar belakang saat aktif */
        color: #fff;
        /* Warna teks saat aktif */
        transition: background-color 0.3s ease, color 0.3s ease;
        /* Efek animasi saat aktif */
        border-top-right-radius: 50px;
        border-top-left-radius: 50px;
        /* Lengkungan sudut kanan atas */
        border-bottom-right-radius: 50px;
        border-bottom-left-radius: 50px;
        /* Lengkungan sudut kanan bawah */
        overflow: hidden;
    }

    #side-menu li a.active::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: white;
        /* Warna latar belakang overlay */
        top: 0;
        left: 0;
        border-bottom-left-radius: 50px;
        /* Lengkungan sudut kiri bawah */
        z-index: -1;
        /* Letakkan di bawah konten utama */
        box-shadow: 5px 5px 0 0 #ccc;
        /* Efek shadow untuk garis */
    }
</style>

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">Menu</li>

                <li>
                    <a href="dashboard">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="desa">
                        <i data-feather="map"></i>
                        <span data-key="t-dashboard">Data Desa</span>
                    </a>
                </li>
                <li>
                    <a href="babin">
                        <i data-feather="user-check"></i>
                        <span data-key="t-dashboard">Data Bhabin</span>
                    </a>
                </li>

                <li>
                    <a href="laporan">
                        <i data-feather="book-open"></i>
                        <span data-key="t-dashboard">Laporan Babin</span>
                    </a>
                </li>

                <li>
                    <a href="galeri">
                        <i data-feather="image"></i>
                        <span data-key="t-dashboard">Galeri</span>
                    </a>
                </li>

                <li>
                    <a href="informasi">
                        <i data-feather="award"></i>
                        <span data-key="t-dashboard">Informasi Edukasi</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Menu Umum</li>

                <li>
                    <a href="faq">
                        <i data-feather="help-circle"></i>
                        <span data-key="t-dashboard">FAQ</span>
                    </a>
                </li>

                <li>
                    <a href="feedback">
                        <i data-feather="phone-call"></i>
                        <span data-key="t-dashboard">Feedback Pengunjung</span>
                    </a>
                </li>

                <li class="menu-title mt-2" data-key="t-components">Data Master</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="archive"></i>
                        <span data-key="t-components">Master Informasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="kategori" data-key="t-apps">Kategori Informasi-Edukasi</a></li>
                    </ul>
                </li>
            </ul>

            <!-- peringatan logout -->
            <div class="card sidebar-alert border-0 text-center mx-4 mb-0 mt-3">
                <div class="card-body">
                    <img src="<?= base_url('assets/img/like.gif') ?>" alt="" style="width: 100px; height: 100px;">
                    <div class="mt-4">
                        <h5 class="alertcard-title font-size-16">PERINGATAN !</h5>
                        <p class="font-size-13">Jangan Lupa Untuk Logout Ketika Selesai Melakukan Pekerjaan Anda</p>
                        <a href="<?= esc(site_url('/authentication/logout'), 'attr') ?>" class="btn btn-primary mt-2">Logout</a>
                    </div>
                </div>
            </div>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<?= $this->renderSection('content'); ?>