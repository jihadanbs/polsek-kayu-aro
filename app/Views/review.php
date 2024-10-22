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
                            <h1>Review Pengunjung</h1>
                            <p class="mb-0">Review Pengunjung Polsek Kayu Aro</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Review Pengunjung</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">

                <div class="col-lg-8">

                    <section id="blog-details" class="blog-details section">

                    </section>
                </div>

                <div class="col-lg-4 sidebar">


                </div>

            </div>
        </div>

    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?= $this->include('layouts/script2') ?>