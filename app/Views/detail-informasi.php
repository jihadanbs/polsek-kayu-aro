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
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html"><?= esc($tb_informasi_edukasi->penulis ?? '', 'html'); ?></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="<?= esc($tb_informasi_edukasi->tanggal_diterbitkan ?? '', 'html'); ?>"><?= esc(formatTanggal($tb_informasi_edukasi->tanggal_diterbitkan ?? ''), 'html'); ?></time></a></li>
                  </ul>
                </div><!-- End meta top -->

                <div class="content">
                  <p><?= esc($tb_informasi_edukasi->konten ?? '', 'html'); ?></p>
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

        <div class="col-lg-4 sidebar">

          <div class="widgets-container">

            <!-- Search Widget -->
            <div class="search-widget widget-item">

              <h3 class="widget-title">Search</h3>
              <form action="">
                <input type="text">
                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
              </form>

            </div><!--/Search Widget -->

            <!-- Categories Widget -->
            <div class="categories-widget widget-item">
              <h3 class="widget-title">Kategori</h3>
              <ul class="mt-3">
                <?php if (!empty($categories)) : ?>
                  <?php foreach ($categories as $category) : ?>
                    <li>
                      <a href="#"><?= esc($category->nama_kategori ?? '', 'html'); ?> <span>(<?= esc($category->count, 'html'); ?>)</span></a>
                    </li>
                  <?php endforeach; ?>
                <?php else : ?>
                  <li><a href="#">Tidak Ada Kategori</a></li>
                <?php endif; ?>
              </ul>
            </div>
            <!--/Categories Widget -->

            <!-- Recent Posts Widget -->
            <div class="recent-posts-widget widget-item">

              <h3 class="widget-title">Post Terbaru</h3>

              <?php if (!empty($recent_posts)) : ?>
                <?php foreach ($recent_posts as $post) : ?>
                  <div class="post-item">
                    <img src="<?= esc(base_url($post->gambar ?? ''), 'html'); ?>" alt="" class="flex-shrink-0">
                    <div>
                      <h4><a href="#"><?= esc($post->judul ?? '', 'html'); ?></a></h4>
                      <time datetime="<?= esc($post->tanggal_diterbitkan ?? '', 'html'); ?>"><?= esc(formatTanggal($post->tanggal_diterbitkan ?? ''), 'html'); ?></time>
                    </div>
                  </div><!-- End recent post item -->
                <?php endforeach; ?>
              <?php else : ?>
                <p>No recent posts available.</p>
              <?php endif; ?>

            </div>
            <!--/Recent Posts Widget -->

            <!-- Tags Widget -->
            <div class="tags-widget widget-item">

              <h3 class="widget-title">Tags</h3>
              <ul>
                <li><a href="#">App</a></li>
                <li><a href="#">IT</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Mac</a></li>
                <li><a href="#">Design</a></li>
                <li><a href="#">Office</a></li>
                <li><a href="#">Creative</a></li>
                <li><a href="#">Studio</a></li>
                <li><a href="#">Smart</a></li>
                <li><a href="#">Tips</a></li>
                <li><a href="#">Marketing</a></li>
              </ul>

            </div><!--/Tags Widget -->

          </div>

        </div>

      </div>
    </div>

  </main>

  <?= $this->include('layouts/footer') ?>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <?= $this->include('layouts/script2') ?>