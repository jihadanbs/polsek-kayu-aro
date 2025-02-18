<?= $this->include('layouts/script') ?>
<style>
    .custom-small-text {
        font-size: 0.70rem;
    }

    .post-img img {
        width: 100%;
        height: auto;
        object-fit: cover;
        /* Atur agar gambar memenuhi area tanpa distorsi */
    }

    .article {
        flex: 1;
    }

    .post-author-img {
        width: 50px;
        /* Atur ukuran gambar penulis */
        height: 50px;
        border-radius: 50%;
        /* Membuat gambar penulis bulat */
    }

    /* pagination */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        color: #333;
        padding: 8px 16px;
        text-decoration: none;
        margin: 0 4px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .pagination a.active {
        background-color: #28527A;
        color: white;
        border: 1px solid #28527A;
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>

<body class="index-page">
    <?= $this->include('layouts/navbar') ?>
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero">

            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row gy-5 justify-content-between">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                        <h2><span style="color: #ffffff;">Selamat Datang di </span><span style="color: #ffffff;">Polsek Kayu Aro</span></h2>
                        <p style="color: #ffffff;">Dedikasi kami adalah memberikan pelayanan prima untuk keamanan dan kenyamanan masyarakat.</p>
                        <div class="d-flex">
                            <a href="#tentang-kami" class="btn-get-started">Mulai</a>
                            <a href="https://youtu.be/O7q2ed2uZE4?feature=shared" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Lihat Video</span></a>
                        </div>
                    </div>
                    <div class="col-lg-4 order-1 order-lg-2">
                        <img src="assets/img/police.png" class="img-fluid" alt="">
                    </div>
                </div>
            </div>

            <div class="icon-boxes position-relative" data-aos="fade-up" data-aos-delay="200">
                <div class="container position-relative">
                    <div class="row gy-4 mt-5">

                        <div class="col-xl-3 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i class="bi bi-clipboard-data"></i></div>
                                <h4 class="title">
                                    <a href=<?= esc(site_url('statistik'), 'attr') ?> class="stretched-link">Statistik</a>
                                </h4>
                            </div>
                        </div>
                        <!--End Icon Box -->

                        <div class="col-xl-3 col-md-6">
                            <div class="icon-box">
                                <div class="icon"><i class="bi bi-star-half"></i></div>
                                <h4 class="title">
                                    <a href="<?= esc(site_url('review'), 'attr') ?>" class="stretched-link">Review</a>
                                </h4>
                            </div>
                        </div>
                        <!--End Icon Box -->

                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="tentang-kami" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Kami</h2>
                <p>Selamat datang di Polsek Kayu Aro. Kami adalah institusi kepolisian yang berdedikasi untuk menjaga keamanan dan ketertiban masyarakat di wilayah Kecamatan Kayu Aro, Kabupaten Kerinci.</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3>Visi dan Misi</h3>
                        <img src="assets/img/img2.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p>Visi kami adalah mewujudkan wilayah yang aman, tertib, dan bebas dari ancaman kejahatan. Misi kami meliputi pencegahan kejahatan, penegakan hukum, serta pelayanan prima kepada masyarakat.</p>
                        <p>Kami berkomitmen untuk memberikan pelayanan terbaik dan transparan dalam menjaga kepercayaan masyarakat. Dengan dedikasi dan integritas, kami terus berupaya meningkatkan kualitas kinerja demi tercapainya keamanan dan ketertiban.</p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                Kami percaya bahwa kerjasama dengan masyarakat adalah kunci utama dalam menjaga keamanan dan ketertiban di wilayah kami.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Pelayanan 24 jam untuk respons cepat terhadap setiap aduan dan kejadian.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Patroli rutin dan kegiatan preventif untuk mencegah tindak kejahatan.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Program edukasi dan sosialisasi kepada masyarakat mengenai pentingnya menjaga keamanan.</span></li>
                            </ul>
                            <p>
                                Kami selalu siap mendengar dan membantu masyarakat dalam setiap situasi yang memerlukan intervensi kepolisian. Keamanan dan kenyamanan Anda adalah prioritas kami.
                            </p>
                            <div class="position-relative mt-4">
                                <img src="assets/img/img1.jpg" class="img-fluid rounded-4" alt="">
                                <a href="https://youtu.be/tfXA35wsGr8?feature=shared" class="glightbox pulsating-play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /About Section -->

        <!-- Clients Section -->
        <section id="clients" class="clients section">

            <div class="container">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 2,
                                    "spaceBetween": 40
                                },
                                "480": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 60
                                },
                                "640": {
                                    "slidesPerView": 4,
                                    "spaceBetween": 80
                                },
                                "992": {
                                    "slidesPerView": 6,
                                    "spaceBetween": 120
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper align-items-center">
                        <!-- Cek apakah slider kosong -->
                        <?php if (empty($tb_slider_beranda)) : ?>
                            <!-- Jika slider kosong, tampilkan gambar 404 -->
                            <div class="col-12 text-center">
                                <img src="assets/img/404.gif" alt="slider Kosong" class="img-fluid" style="max-width: 300px;">
                                <p class="fw-bold">Tidak ada foto di slider saat ini</p>
                            </div>
                        <?php else : ?>
                        <?php endif; ?>

                        <?php foreach ($tb_slider_beranda as $row) : ?>
                            <div class="swiper-slide">
                                <img src="<?= base_url($row['gambar_slider']); ?>" class="img-fluid" alt="Gambar Slider">
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>

        </section><!-- /Clients Section -->

        <!-- Stats Section -->
        <section id="stats" class="stats section">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4 align-items-center">

                    <div class="col-lg-5">
                        <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-7">

                        <div class="row gy-4">

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-house-check"></i>
                                    <div>
                                        <span id="totalDesaCounter" data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Total Desa</strong> <span>Kami melayani berbagai desa di wilayah kami dengan komitmen penuh.</span></p>
                                    </div>
                                </div>
                            </div>
                            <!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-journal-bookmark"></i>
                                    <div>
                                        <span id="totalLaporanCounter" data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Jumlah Laporan</strong> <span>Laporan yang terdapat pada data kami mencakup aspek segala hal.</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-headset flex-shrink-0"></i>
                                    <div>
                                        <span id="totalFeedbackCounter" data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Aduan Masyarakat</strong> <span>Kami menerima banyak pengaduan dari masyarakat untuk terus meningkatkan pelayanan kami.</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->

                            <div class="col-lg-6">
                                <div class="stats-item d-flex">
                                    <i class="bi bi-people flex-shrink-0"></i>
                                    <div>
                                        <span id="totalBabinCounter" data-purecounter-start="0" data-purecounter-end="0" data-purecounter-duration="1" class="purecounter"></span>
                                        <p><strong>Anggota Bhabin</strong> <span>Kami memiliki sejumlah anggota Bhabinkamtibmas yang siap melayani dan membantu masyarakat.</span></p>
                                    </div>
                                </div>
                            </div><!-- End Stats Item -->
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Stats Section -->

        <!-- Call To Action Section -->
        <section id="call-to-action" class="call-to-action section dark-background">

            <div class="container">
                <img src="assets/img/img3.jpg" alt="">
                <div class="content row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                    <div class="col-xl-10">
                        <div class="text-center">
                            <a href="https://youtu.be/aL9UFOQHhL4?feature=shared" class="glightbox play-btn"></a>
                            <h3>Keindahan Wisata Kerinci, Jambi</h3>
                            <p>Temukan pesona alam yang memukau di Kerinci, Jambi. Dengan keindahan pegunungan yang hijau, air terjun yang mempesona, dan danau yang tenang, Kerinci menawarkan pengalaman liburan yang tak terlupakan. Jelajahi keanekaragaman flora dan fauna di Taman Nasional Kerinci Seblat, atau nikmati keindahan Danau Gunung Tujuh yang menakjubkan. Kerinci adalah surga tersembunyi yang menanti untuk dijelajahi.</p>
                            <a class="cta-btn" href="#">Jelajahi Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Call To Action Section -->

        <!-- Services Section -->
        <section id="layanan" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Polsek menyediakan berbagai layanan untuk memastikan keamanan dan kenyamanan masyarakat</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            <h3>Pengamanan Lingkungan</h3>
                            <p>Kami menyediakan layanan pengamanan 24/7 untuk menjaga keamanan dan kenyamanan lingkungan Anda.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-person-lines-fill"></i>
                            </div>
                            <h3>Pelaporan Kriminal</h3>
                            <p>Kami siap menerima dan menangani laporan kriminal dengan cepat dan efisien untuk menjaga ketertiban.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-hand-thumbs-up"></i>
                            </div>
                            <h3>Penyuluhan Keamanan</h3>
                            <p>Kami mengadakan penyuluhan untuk meningkatkan kesadaran masyarakat akan pentingnya keamanan dan ketertiban.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-telephone-inbound"></i>
                            </div>
                            <h3>Layanan Darurat 24/7</h3>
                            <p>Tim kami siap merespon situasi darurat kapan pun untuk memberikan bantuan cepat dan efektif.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-card-checklist"></i>
                            </div>
                            <h3>Pengurusan Surat Keterangan</h3>
                            <p>Kami membantu pengurusan surat keterangan seperti SKCK, surat kehilangan, dan lainnya dengan cepat dan mudah.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-headset"></i>
                            </div>
                            <h3>Konsultasi dan Pengaduan</h3>
                            <p>Kami menyediakan layanan konsultasi dan menerima pengaduan masyarakat terkait isu keamanan dan ketertiban.</p>
                            <!-- <a href="service-details.html" class="readmore stretched-link">Selengkapnya <i class="bi bi-arrow-right"></i></a> -->
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>


        </section><!-- /Services Section -->

        <!-- Testimonials Section -->
        <section id="testimonials" class="testimonials section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Testimoni</h2>
                <p>Apa kata mereka tentang layanan kami? Dengarkan cerita dari masyarakat yang telah merasakan dampak positif layanan kami.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            },
                            "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 40
                                },
                                "1200": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 10
                                }
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">

                        <!-- Cek apakah review kosong -->
                        <?php if (empty($tb_review)) : ?>
                            <!-- Jika review kosong, tampilkan gambar 404 -->
                            <div class="col-12 text-center">
                                <img src="assets/img/404.gif" alt="review Kosong" class="img-fluid" style="max-width: 300px;">
                                <p class="fw-bold">Tidak ada review pengunjung untuk saat ini</p>
                            </div>
                        <?php else : ?>
                        <?php endif; ?>

                        <!-- Loop Data -->
                        <?php foreach ($tb_review as $row) : ?>
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <img src="<?= $row['file_foto'] ?>" class="testimonial-img" alt="">
                                    <h3><?= strip_tags($row['nama_lengkap']); ?></h3>
                                    <h4><?= strip_tags($row['pekerjaan']); ?></h4>
                                    <div class="stars">
                                        <?php
                                        $rating = (float) $row['rating']; // Mengkonversi rating menjadi float
                                        $fullStars = floor($rating); // Menghitung bintang penuh
                                        $halfStars = ($rating - $fullStars >= 0.5) ? 1 : 0; // Menghitung setengah bintang
                                        $emptyStars = 5 - ($fullStars + $halfStars); // Menghitung bintang kosong
                                        ?>

                                        <!-- Menampilkan bintang penuh -->
                                        <?php for ($i = 0; $i < $fullStars; $i++): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>

                                        <!-- Menampilkan setengah bintang -->
                                        <?php if ($halfStars): ?>
                                            <i class="bi bi-star-half"></i>
                                        <?php endif; ?>

                                        <!-- Menampilkan bintang kosong -->
                                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                                            <i class="bi bi-star"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span><?= strip_tags($row['pesan_review']); ?></span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div><!-- End testimonial item -->
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>


        </section><!-- /Testimonials Section -->

        <!-- galeri Section -->
        <section id="galeri" class="galeri section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Galeri Polsek</h2>
                <p>Temukan berbagai foto yang menggambarkan aktivitas, acara, dan layanan kami. Galeri ini menyajikan momen berharga dan usaha kami dalam menjaga keamanan dan ketertiban di masyarakat.</p>
                <!-- Cek apakah galeri kosong -->
                <?php if (empty($tb_foto)) : ?>
                    <!-- Jika galeri kosong, tampilkan gambar 404 -->
                    <div class="col-12 text-center">
                        <img src="assets/img/404.gif" alt="Galeri Kosong" class="img-fluid" style="max-width: 300px;">
                        <p class="fw-bold">Tidak ada foto di galeri saat ini</p>
                    </div>
                <?php else : ?>
                <?php endif; ?>
            </div>
            <!-- End Section Title -->

            <?php
            // Jumlah item per halaman
            $itemsPerPage = 6;

            // Total jumlah item
            $totalItems = count($tb_foto);

            // Hitung total halaman
            $totalPages = ceil($totalItems / $itemsPerPage);

            // Dapatkan halaman saat ini dari parameter URL
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page = max(1, min($totalPages, $page));

            // Tentukan offset untuk query
            $offset = ($page - 1) * $itemsPerPage;

            // Ambil data untuk halaman saat ini
            $currentItems = array_slice($tb_foto, $offset, $itemsPerPage);
            ?>

            <div class="container">
                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">
                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
                        <!-- galeri Item with multiple images in a carousel -->
                        <?php foreach ($currentItems as $index => $row) : ?>
                            <div class="col-lg-4 col-md-6 galeri-item isotope-item filter-app">
                                <div class="galeri-content h-100">
                                    <div id="carouselExampleControls<?= $index ?>" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php
                                            $files = explode(', ', $row['file_foto']);
                                            $isActive = true;
                                            ?>
                                            <?php foreach ($files as $file) : ?>
                                                <div class="carousel-item <?= $isActive ? 'active' : '' ?>">
                                                    <a href="<?= esc(base_url($file), 'attr') ?>" data-fancybox="title: <?= esc($row['judul_foto'], 'html') ?> - Image <?= $index ?>">
                                                        <img src="<?= esc(base_url($file), 'attr') ?>" class="d-block w-100 carousel-image img-fluid" alt="...">
                                                    </a>
                                                </div>
                                                <?php $isActive = false; ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= $index ?>" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: #FF204E; border-radius: 50px;"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= $index ?>" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: #FF204E; border-radius: 50px;"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <div class="galeri-info">
                                        <h4 class="text-center fw-bold"><?= esc($row['judul_foto'], 'html') ?></h4>
                                        <p class="post-date">
                                            <time datetime="<?= esc($row['tanggal_foto'], 'html'); ?>"><?= esc(formatTanggalIndo($row['tanggal_foto']), 'html'); ?></time>
                                        </p>
                                        <p><?= esc($row['deskripsi'], 'html') ?></p>
                                    </div>
                                </div>
                            </div><!-- End galeri item -->
                        <?php endforeach; ?>
                        <!-- End galeri Item -->

                    </div><!-- End galeri Container -->

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php if ($page > 1) : ?>
                            <a href="?page=<?= $page - 1 ?>">&laquo; Previous</a>
                        <?php endif; ?>
                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                            <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>
                        <?php if ($page < $totalPages) : ?>
                            <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('[data-fancybox="gallery"]').fancybox({
                        buttons: [
                            'download',
                            'thumbs',
                            'close'
                        ]
                    });
                });
            </script>
        </section><!-- /galeri Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="content px-xl-5">
                            <h3><span>Frequently Asked </span><strong>Questions</strong></h3>
                            <p>
                                Berikut adalah beberapa pertanyaan yang sering diajukan oleh masyarakat terkait layanan dan kegiatan Polsek Kayu Aro. Jika Anda memiliki pertanyaan lain, jangan ragu untuk menghubungi kami.
                            </p>
                        </div>
                    </div>

                    <div class="col-lg-8" data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-container">
                            <!-- Cek apakah faq kosong -->
                            <?php if (empty($tb_faq)) : ?>
                                <!-- Jika faq kosong, tampilkan gambar 404 -->
                                <div class="col-12 text-center">
                                    <img src="<?= base_url('assets/img/404.gif'); ?>" alt="faq Kosong" class="img-fluid" style="max-width: 300px;">
                                    <p class="fw-bold">Tidak ada faq saat ini</p>
                                </div>
                            <?php else : ?>
                            <?php endif; ?>
                            <!-- looping data -->
                            <?php $i = 1; ?>
                            <?php foreach ($tb_faq as $row) : ?>
                                <div class="faq-item">
                                    <h3><span class="num"><?= $i++; ?>.</span> <span><?= strip_tags($row['pertanyaan']); ?></span></h3>
                                    <div class="faq-content">
                                        <p><?= strip_tags($row['jawaban']); ?></p>
                                    </div>
                                    <i class="faq-toggle bi bi-chevron-right"></i>
                                </div><!-- End Faq item-->
                            <?php endforeach; ?>
                        </div>

                    </div>
                </div>
            </div>
        </section><!-- /Faq Section -->

        <!-- Informasi-Edukasi -->
        <section id="informasi-edukasi" class="recent-posts section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Informasi-Edukasi</h2>
                <p>Konten Informasi dan Edukasi Untuk Masyarakat</p>
                <!-- Cek apakah informasi-edukasi kosong -->
                <?php if (empty($tb_informasi_edukasi)) : ?>
                    <!-- Jika informasi-edukasi kosong, tampilkan gambar 404 -->
                    <div class="col-12 text-center">
                        <img src="<?= base_url('assets/img/404.gif'); ?>" alt="informasi-edukasi Kosong" class="img-fluid" style="max-width: 300px;">
                        <p class="fw-bold">Tidak ada informasi-edukasi saat ini</p>
                    </div>
                <?php else : ?>
                <?php endif; ?>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">

                    <?php
                    // Urutkan data berdasarkan 'tanggal_diterbitkan' dari yang terbaru
                    usort($tb_informasi_edukasi, function ($a, $b) {
                        return strtotime($b['tanggal_diterbitkan']) - strtotime($a['tanggal_diterbitkan']);
                    });

                    // Jumlah item per halaman
                    $itemsPerPage = 6;

                    // Total jumlah item
                    $totalItems = count($tb_informasi_edukasi);

                    // Hitung total halaman
                    $totalPages = ceil($totalItems / $itemsPerPage);

                    // Dapatkan halaman saat ini dari parameter URL
                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $page = max(1, min($totalPages, $page));

                    // Tentukan offset untuk query
                    $offset = ($page - 1) * $itemsPerPage;

                    // Ambil data untuk halaman saat ini
                    $currentItems = array_slice($tb_informasi_edukasi, $offset, $itemsPerPage);
                    ?>

                    <?php foreach ($currentItems as $row) : ?>
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <article>

                                <div class="post-img">
                                    <img src="<?= esc($row['gambar'], 'html'); ?>" alt="" class="img-fluid">
                                </div>

                                <p class="post-category"><?= esc($row['nama_kategori'], 'html'); ?></p>

                                <h2 class="title">
                                    <a href="<?= esc(site_url('detail-informasi/' . urlencode($row['slug'])), 'attr') ?>"><?= esc($row['judul'], 'html'); ?></a>
                                </h2>

                                <div class="d-flex align-items-center">
                                    <img src="<?= esc($row['profile_penulis'], 'html'); ?>" alt="" class="img-fluid post-author-img flex-shrink-0">
                                    <div class="post-meta">
                                        <p class="post-author"><?= esc($row['penulis'], 'html'); ?></p>
                                        <p class="post-date">
                                            <time datetime="<?= esc($row['tanggal_diterbitkan'], 'html'); ?>"><?= esc(formatTanggalIndo($row['tanggal_diterbitkan']), 'html'); ?></time>
                                        </p>
                                    </div>
                                </div>

                            </article>
                        </div><!-- End post list item -->
                    <?php endforeach; ?>

                </div><!-- End recent posts list -->

                <div class="pagination">
                    <?php if ($page > 1) : ?>
                        <a href="?page=<?= $page - 1 ?>">&laquo; Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages) : ?>
                        <a href="?page=<?= $page + 1 ?>">Next &raquo;</a>
                    <?php endif; ?>
                </div>

            </div>
        </section>
        <!-- /Informasi-Edukasi -->

        <!-- Contact Section -->
        <section id="pengaduan" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pengaduan</h2>
                <p>Silakan hubungi kami untuk pengaduan, laporan, atau informasi lebih lanjut. Kami siap melayani Anda dengan sebaik mungkin.</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gx-lg-0 gy-4">

                    <div class="col-lg-4">
                        <div class="info-container d-flex flex-column align-items-center justify-content-center">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Alamat</h3>
                                    <p>Jl. Raya Kayu Aro, Lindung Jaya, Kec. Kayu Aro, Kabupaten Kerinci, Jambi 37163</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>Telepon</h3>
                                    <p>+62 822 8206 1449</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email</h3>
                                    <p>polsekkayuaro@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
                                <i class="bi bi-clock flex-shrink-0"></i>
                                <div>
                                    <h3>Jam Operasional</h3>
                                    <p>Senin-Sabtu: 08.00 - 18.00</p>
                                </div>
                            </div><!-- End Info Item -->

                        </div>

                    </div>

                    <div class="col-lg-8">
                        <form id="contactForm" action="<?= site_url('/admin/pengaduan/send');  ?>" method="post" class="php-email-form needs-validation" novalidate data-aos="fade" data-aos-delay="100" autocomplete="off">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label class="col-form-label">Nama Lengkap</label><span style="color: red;">*</span>
                                    <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                                    <div class="invalid-feedback">
                                        Silakan isi nama Anda !
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Email</label><span style="color: red;">*</span>
                                    <input type="email" class="form-control" name="email" placeholder="Email Anda" required>
                                    <small class="text-muted custom-small-text">Pastikan Email Anda Aktif Untuk Memudahkan Pengiriman Tanggapan</small>
                                    <div class="invalid-feedback">
                                        Silakan isi email Anda yang valid !
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                    <select class="form-select custom-border <?= ($validation->hasError('id_desa')) ? 'is-invalid' : ''; ?>" id="id_desa" name="id_desa" aria-label="Default select example" style="background-color: white;" required>
                                        <option value="" selected disabled>~ Silahkan Pilih Nama Desa ~</option>
                                        <?php foreach ($tb_desa as $value) : ?>
                                            <option value="<?= esc($value['id_desa'], 'attr') ?>" <?= old('id_desa') == $value['id_desa'] ? 'selected' : ''; ?>>
                                                <?= esc($value['nama_desa'], 'html') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih nama desa anda !
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label">Nama Babin</label><span style="color: red;">*</span>
                                    <select class="form-select custom-border <?= ($validation->hasError('id_babin')) ? 'is-invalid' : ''; ?>" id="id_babin" name="id_babin" aria-label="Default select example" style="background-color: white;" required>
                                        <option value="" selected disabled>~ Silahkan Pilih Nama Babin ~</option>
                                        <?php foreach ($tb_babin as $value) : ?>
                                            <option value="<?= esc($value['id_babin'], 'attr') ?>" <?= old('id_babin') == $value['id_babin'] ? 'selected' : ''; ?>>
                                                <?= esc($value['nama_lengkap'], 'html') ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Silakan pilih nama babin !
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="col-form-label">No Telepon</label><span style="color: red;">*</span>
                                    <input type="text" class="form-control" name="no_telepon" placeholder="Nomor Telepon" required>
                                    <small class="text-muted custom-small-text">Pastikan Nomor Telepon Anda Aktif Untuk Memudahkan Pengiriman Tanggapan</small>
                                    <div class="invalid-feedback">
                                        Silakan isi nomor telepon !
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">Subjek</label><span style="color: red;">*</span>
                                    <input type="text" class="form-control" name="subjek" placeholder="Subjek" required>
                                    <div class="invalid-feedback">
                                        Silakan isi subjek !
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">Pesan Pengaduan</label><span style="color: red;">*</span>
                                    <textarea class="form-control" name="pesan" rows="8" placeholder="Pesan" required></textarea>
                                    <div class="invalid-feedback">
                                        Silakan isi pesan Anda !
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label">Dokumentasi</label><span style="color: red;">*</span>
                                    <input type="file" accept="image/*" class="form-control" name="dokumentasi" placeholder="dokumentasi" required>
                                    <div class="invalid-feedback">
                                        Silakan masukkan dokumentasi !
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="sent-message">Pesan Anda telah terkirim. Terima kasih!</div>
                                    <button type="submit">Kirim Pesan</button>
                                </div>
                            </div>
                        </form>

                    </div><!-- End kontak Form -->

                </div>

            </div>

        </section>
        <!-- Script Form  -->
        <script>
            document.getElementById('contactForm').addEventListener('submit', function(event) {
                event.preventDefault(); // Mencegah form dari pengiriman default

                // Kirim data form dengan AJAX
                var formData = new FormData(this);
                var xhr = new XMLHttpRequest();
                xhr.open('POST', this.action, true);

                xhr.onload = function() {
                    if (xhr.status === 200) {
                        try {
                            // Parse JSON response
                            const response = JSON.parse(xhr.responseText);

                            if (response.status === 'success') {
                                // Jika berhasil
                                Swal.fire({
                                    title: 'Pesan Terkirim!',
                                    html: `Pesan berhasil dikirim. Terima kasih atas pengaduan Anda.<br><br>
                                    Kami akan segera menindaklanjutinya!<br><br>
                              <strong>Kode Pengaduan Anda: ${response.kode_pengaduan}</strong><br><br>
                              Simpan Kode Pengaduan Anda Untuk Pengecekan Berkala !`,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    location.reload(); // Muat ulang halaman setelah menutup SweetAlert
                                });
                            } else {
                                // Jika gagal
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: response.message || 'Terjadi kesalahan saat mengirim pesan. Silakan coba lagi!',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        } catch (e) {
                            // Tangani kesalahan parsing JSON
                            Swal.fire({
                                title: 'Gagal!',
                                text: 'Terjadi kesalahan dalam memproses respons server!',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        // Tangani jika terjadi kesalahan pada permintaan
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi kesalahan saat mengirim pesan!',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                };

                xhr.send(formData);
            });
        </script>
        <!-- End Script Form  -->
        <!-- /kontak Section -->

    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Total Desa -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/desa/totalData", function(responsePemohon) {
                    var total = parseInt(responsePemohon.total);
                    $("#totalDesaCounter").attr("data-purecounter-end", total);
                    $("#totalDesaCounter").text(total);
                    new PureCounter().elements.forEach(element => {
                        element.startCounting();
                    });
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url,
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
                    var total = parseInt(responsePemohon.total);
                    $("#totalLaporanCounter").attr("data-purecounter-end", total);
                    $("#totalLaporanCounter").text(total);
                    new PureCounter().elements.forEach(element => {
                        element.startCounting();
                    });
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url,
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
                getTotalFeedback("/admin/pengaduan/totalData", function(responsePemohon) {
                    var total = parseInt(responsePemohon.total);
                    $("#totalFeedbackCounter").attr("data-purecounter-end", total);
                    $("#totalFeedbackCounter").text(total);
                    new PureCounter().elements.forEach(element => {
                        element.startCounting();
                    });
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url,
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

    <!-- Total Anggota -->
    <script>
        $(document).ready(function() {
            updateTotal();

            function updateTotal() {
                getTotalFeedback("/admin/babin/totalData", function(responsePemohon) {
                    var total = parseInt(responsePemohon.total);
                    $("#totalBabinCounter").attr("data-purecounter-end", total);
                    $("#totalBabinCounter").text(total);
                    new PureCounter().elements.forEach(element => {
                        element.startCounting();
                    });
                });
            }

            function getTotalFeedback(url, callback) {
                $.ajax({
                    url: url,
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


    <?= $this->include('layouts/script2') ?>