<?= $this->include('layouts/script') ?>

<body class="blog-details-page">
  <?= $this->include('layouts/navbar2') ?>
  <main class="main">

    <!-- Page Title -->
    <div class="page-title">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Detail Informasi dan Edukasi</h1>
              <p class="mb-0">Temukan Penjelasan Mendalam dan Bermanfaat dalam Informasi dan Edukasi Kami</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="/">Beranda</a></li>
            <li class="current">Detail Informasi-Edukasi</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <div class="container">
      <div class="row">

        <div class="col-lg-8">

          <!-- Blog Details Section -->
          <section id="blog-details" class="blog-details section">
            <div class="container">

              <article class="article">

                <!-- format tanggal -->
                <?php
                if (!function_exists('formatTanggal')) {
                  function formatTanggal($date)
                  {
                    $bulanIndonesia = [
                      1 => 'Januari',
                      2 => 'Februari',
                      3 => 'Maret',
                      4 => 'April',
                      5 => 'Mei',
                      6 => 'Juni',
                      7 => 'Juli',
                      8 => 'Agustus',
                      9 => 'September',
                      10 => 'Oktober',
                      11 => 'November',
                      12 => 'Desember'
                    ];

                    $timestamp = strtotime($date);
                    $day = date('d', $timestamp);
                    $month = date('n', $timestamp);
                    $year = date('Y', $timestamp);

                    return "$day " . $bulanIndonesia[$month] . " $year";
                  }
                }
                ?>
                <!-- end format tanggal -->

                <div class="post-img">
                  <img src="<?= esc(base_url($tb_informasi_edukasi->gambar ?? ''), 'html'); ?>" alt="" class="img-fluid">
                </div>

                <h2 class="title"><?= esc($tb_informasi_edukasi->judul ?? '', 'html'); ?></h2>

                <div class="meta-top">
                  <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#"><?= esc($tb_informasi_edukasi->penulis ?? '', 'html'); ?></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="#"><time datetime="<?= esc($tb_informasi_edukasi->tanggal_diterbitkan ?? '', 'html'); ?>"><?= esc(formatTanggal($tb_informasi_edukasi->tanggal_diterbitkan ?? ''), 'html'); ?></time></a></li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  <?= htmlspecialchars_decode($tb_informasi_edukasi->konten ?? ''); ?>
                </div><!-- End post content -->

                <div class="meta-bottom">
                  <i class="bi bi-tags"></i>
                  <ul class="tags">
                    <li><a href="#"><?= esc($tb_informasi_edukasi->nama_kategori ?? '', 'html'); ?></a></li>
                  </ul>
                </div><!-- End meta bottom -->

              </article>
            </div>
          </section><!-- /Blog Details Section -->
        </div>
        <?= $this->include('layouts/sideInformasi') ?>
      </div>
    </div>

  </main>

  <?= $this->include('layouts/footer') ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?= $this->include('layouts/script2') ?>