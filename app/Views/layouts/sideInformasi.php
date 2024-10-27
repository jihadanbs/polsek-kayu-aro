<div class="col-lg-4 sidebar">

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
                            <h4><a href="<?= esc(site_url('detail-informasi/' . urlencode($post->slug ?? '')), 'attr') ?>"><?= esc($post->judul ?? ''); ?></a></h4>
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
                <li><a href="#">Keamanan Publik</a></li>
                <li><a href="#">Teknologi Informasi</a></li>
                <li><a href="#">Aplikasi Keamanan</a></li>
                <li><a href="#">Sistem Pemantauan</a></li>
                <li><a href="#">Analisis Data Kejahatan</a></li>
                <li><a href="#">Inovasi Polri</a></li>
                <li><a href="#">Pelayanan Masyarakat</a></li>
                <li><a href="#">Sosialisasi Hukum</a></li>
                <li><a href="#">Smart City</a></li>
                <li><a href="#">Transparansi</a></li>
                <li><a href="#">Keamanan Siber</a></li>
            </ul>
        </div><!--/Tags Widget -->

    </div>

</div>