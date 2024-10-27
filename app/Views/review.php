<?= $this->include('layouts/script') ?>

<style>
    .review-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #FFFFFF;
        /* Ganti warna latar belakang sesuai tema Anda */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .review-container .section-title {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #333;
    }

    .review-container .form-group {
        margin-bottom: 15px;
    }

    .review-container .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        /* Ganti sesuai dengan style Anda */
        border-radius: 4px;
        font-size: 16px;
    }

    .review-container .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .review-container .btn {
        width: 150px;
        padding: 10px;
        background-color: #007bff;
        /* Ganti sesuai dengan style Anda */
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        display: block;
        /* Mengubah tampilan tombol menjadi block */
        margin: 20px auto;
        /* Memusatkan tombol dengan margin otomatis */
    }

    .review-container .btn:hover {
        background-color: #0056b3;
    }

    /* File Foto */
    .review-container .input-group {
        display: flex;
        align-items: center;
        /* Memastikan semua item di dalam grup sejajar secara vertikal */
    }

    .review-container .form-control.input-file-custom {
        flex: 1;
        /* Membuat input file mengisi ruang yang tersedia */
        margin-right: 5px;
        /* Spasi antara input dan tombol */
    }

    .review-container .btn.remove-file {
        width: auto;
        /* Ubah lebar tombol menjadi auto */
        padding: 10px 15px;
        /* Sesuaikan padding sesuai kebutuhan */
        background-color: #dc3545;
        /* Warna tombol */
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        display: inline-block;
        /* Pastikan tombol ditampilkan sebagai blok inline */
    }

    /* Rating */
    .rating-container {
        display: flex;
    }

    /* Sesuaikan lebar dan jarak antar elemen */
    #rating {
        margin-left: 10px;
    }
</style>

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
                            <p class="mb-0">Berikan Review Untuk Polsek Kayu Aro</p>
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
                        <div class="review-container">
                            <h2 class="widget-title" style="text-align: center">Beri Review Anda</h2>
                            <form action="<?= esc(site_url('/review'), 'attr'); ?>" id="formReview" method="post" enctype="multipart/form-data" class="review-form" autocomplete="off">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <label for="nama_lengkap" class="widget-title">Nama Lengkap</label><span style="color: red;">*</span>
                                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap Anda">
                                </div>

                                <div class="form-group">
                                    <label for="pekerjaan" class="widget-title">Pekerjaan</label><span style="color: red;">*</span>
                                    <input type="text" id="pekerjaan" name="pekerjaan" class="form-control" placeholder="Masukkan pekerjaan Anda">
                                </div>

                                <div class="form-group">
                                    <label for="pesan_review" class="widget-title">Tulis Review Anda</label><span style="color: red;">*</span>
                                    <textarea id="pesan_review" name="pesan_review" rows="4" class="form-control" placeholder="Tulis review Anda di sini"></textarea>
                                </div>

                                <div class="form-group rating-container">
                                    <label for="rating" class="widget-title">Beri Rating</label><span style="color: red;">*</span>
                                    <div id="rating" class="rater"></div>
                                    <input type="hidden" id="ratingValue" name="rating" value="0"> <!-- Input hidden untuk rating -->
                                </div>
                                <!-- Script Rating -->
                                <script>
                                    var myRater = raterJs({
                                        element: document.querySelector("#rating"),
                                        starSize: 32, // Ukuran bintang
                                        step: 0.5, // Langkah rating (1 sampai 5)
                                        rateCallback: function rateCallback(rating, done) {
                                            this.setRating(rating); // Menampilkan rating yang dipilih
                                            document.getElementById("ratingValue").value = rating; // Mengupdate nilai pada input hidden
                                            done(); // Callback setelah rating dipilih
                                        }
                                    });
                                </script>

                                <div class="form-group">
                                    <label for="file_foto" class="widget-title">Unggah Foto</label><span style="color: red;">*</span>
                                    <!-- Elemen untuk menampilkan gambar -->
                                    <div id="previewContainer" style="margin-top: 10px; display: none;">
                                        <img id="previewImage" src="" alt="Preview" style="max-width: 100px; height: 80px; display: block; margin-top: 10px;">
                                    </div>
                                    <div class="input-group" style="display: flex; align-items: center;">
                                        <input type="file" id="file_foto" name="file_foto" class="form-control input-file-custom" accept="image/*">
                                        <button type="button" class="btn remove-file" style="margin-left: 10px; display: none;">
                                            <i class="mdi mdi-trash-can d-block font-size-16"></i>
                                        </button>
                                    </div>
                                    <label for="file_foto" class="form-label" style="font-size: 12px; color: red;">Max Upload 5 MB</label>
                                </div>

                                <script>
                                    document.getElementById('file_foto').addEventListener('change', function() {
                                        const removeFileButton = document.querySelector('.remove-file');
                                        const previewContainer = document.getElementById("previewContainer");
                                        const previewImage = document.getElementById("previewImage");

                                        if (this.files.length > 0) {
                                            const file = this.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function(e) {
                                                previewImage.src = e.target.result; // Mengatur src gambar
                                                previewContainer.style.display = "block"; // Menampilkan kontainer gambar
                                            }

                                            reader.readAsDataURL(file); // Membaca file sebagai URL data

                                            removeFileButton.style.display = 'inline-block'; // Tampilkan tombol hapus foto
                                        } else {
                                            removeFileButton.style.display = 'none'; // Sembunyikan tombol hapus foto
                                        }
                                    });

                                    document.querySelector('.remove-file').addEventListener('click', function() {
                                        const fileInput = document.getElementById('file_foto');
                                        fileInput.value = ''; // Hapus inputan file
                                        this.style.display = 'none'; // Sembunyikan tombol hapus foto
                                        document.getElementById("previewImage").src = ""; // Hapus preview gambar
                                        document.getElementById("previewContainer").style.display = "none"; // Sembunyikan kontainer gambar
                                    });
                                </script>

                                <!-- Script Batal Unggah -->
                                <script>
                                    document.getElementById('file_foto').addEventListener('change', function() {
                                        const removeFileButton = document.querySelector('.remove-file');
                                        if (this.files.length > 0) {
                                            removeFileButton.classList.add('show'); // Tampilkan button tempah sampah untuk menghapus foto
                                            removeFileButton.style.display = 'inline-block'; // Tampilkan button tempah sampah untuk menghapus foto
                                        } else {
                                            removeFileButton.classList.remove('show'); // Sembunyikan button tempah sampah untuk menghapus foto
                                            removeFileButton.style.display = 'none'; // Sembunyikan button tempah sampah untuk menghapus foto
                                        }
                                    });

                                    document.querySelector('.remove-file').addEventListener('click', function() {
                                        const fileInput = document.getElementById('file_foto');
                                        fileInput.value = ''; // Hapus inputan file
                                        this.classList.remove('show'); // Sembunyikan button tempah sampah untuk menghapus foto
                                        this.style.display = 'none'; // Sembunyikan button tempah sampah untuk menghapus foto
                                    });
                                </script>

                                <button type="submit" id="formReview" class="btn btn-primary waves-effect waves-light">
                                    <i class="bx bx-smile font-size-16 align-middle me-2"></i> Kirim Review
                                </button>

                            </form>
                        </div>
                    </section>
                </div>
                <?= $this->include('layouts/sideInformasi') ?>
            </div>
        </div>

    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?= $this->include('layouts/script2') ?>