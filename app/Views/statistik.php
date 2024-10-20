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

                    </div>

                </div>

            </div>
        </div>

    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?= $this->include('layouts/script2') ?>