<?= $this->include('layouts/script') ?>

<style>
    body {
        font-family: 'Arial', sans-serif;
        /* Gunakan font yang modern */
    }

    .statistik-card {
        background-color: #ffffff;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        margin-top: 30px;
        padding: 20px;
        /* Tambahkan padding untuk ruang tambahan */
    }

    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        /* Lebih menonjol */
    }

    .btn {
        color: #fff;
        margin-top: 15px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-reset {
        background-color: #e74c3c;
        /* Warna merah untuk tombol reset */
    }

    .btn-reset:hover {
        background-color: #c0392b;
        color: #ffffff;
    }

    .form-inline {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .statistik-card .form-inline .form-select,
    .statistik-card .form-inline .btn {
        margin-left: 10px;
        /* Jarak antar elemen */
    }

    .pengaduan-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .pengaduan-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .pengaduan-subtitle {
        color: #666;
        font-size: 16px;
    }

    .hasil-title {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .hidden {
        display: none !important;
    }

    .pengaduan-card {
        background: linear-gradient(145deg, #ffffff, #f5f7ff);
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        padding: 2rem;
        margin: 2rem 0;
    }

    .pengaduan-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .input-pengaduan {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 1rem;
        margin-bottom: 1rem;
    }

    .input-pengaduan:focus {
        border-color: #4f46e5;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .btn-pengaduan {
        width: 100%;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(145deg, #4f46e5, #4338ca);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-pengaduan:hover {
        background: linear-gradient(145deg, #4338ca, #3730a3);
        transform: translateY(-2px);
    }

    .hasil-pengaduan {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }

    .detail-item {
        display: flex;
        margin-bottom: 1rem;
        align-items: center;
    }

    .detail-label {
        width: 100px;
        color: #64748b;
        font-weight: 500;
    }

    .detail-value {
        color: #1e293b;
        font-weight: 500;
    }

    /* Memperbaiki alignment pada detail item */
    .detail-item {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        gap: 10px;
    }

    .detail-label {
        min-width: 100px;
        font-weight: 500;
    }

    .detail-value {
        flex: 1;
    }

    .error-alert {
        background-color: #fee2e2;
        border-left: 4px solid #ef4444;
        padding: 1rem;
        margin-top: 1rem;
        border-radius: 8px;
        display: flex;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .error-icon {
        color: #ef4444;
        margin-right: 0.75rem;
    }

    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .btn-reset {
        width: 100%;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(145deg, #dc2626, #b91c1c);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .btn-reset:hover {
        background: linear-gradient(145deg, #b91c1c, #991b1b);
        transform: translateY(-2px);
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-5px);
        }

        75% {
            transform: translateX(5px);
        }
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
                            <h1>Pengaduan Masyarakat</h1>
                            <p class="mb-0">Temukan Data Pengaduan Anda</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Cek Pengaduan</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="text-center mb-4 mt-4 widget-title" style="font-size: 42px;">POLSEK KAYU ARO</h2>
                    <section id="blog-details" class="pengaduan-card">
                        <div class="pengaduan-header">
                            <h3 class="pengaduan-title">Cek Status Pengaduan<span style="color: red;">*</span></h3>
                            <p class="pengaduan-subtitle">Masukkan kode pengaduan Anda untuk melihat status</p>
                        </div>

                        <div id="errorMessage" class="error-alert hidden mb-3">
                            <svg class="error-icon" width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                            <span id="errorText">Kode pengaduan tidak ditemukan !</span>
                        </div>

                        <form id="formCekPengaduan" autocomplete="off">
                            <input id="kode_pengaduan" name="kode_pengaduan" type="text" class="input-pengaduan"
                                placeholder="Masukkan kode pengaduan">
                            <div class="button-group">
                                <button type="submit" class="btn-pengaduan">
                                    Cek Status Pengaduan
                                </button>
                                <button type="button" id="btnReset" class="btn-reset">
                                    Reset
                                </button>
                            </div>
                        </form>

                        <div id="hasilPengaduan" class="hasil-pengaduan hidden">
                            <h4 class="hasil-title">Detail Pengaduan<span style="color: red;">*</span></h4>
                            <div class="detail-item">
                                <span class="detail-label">Nama Lengkap</span>
                                <span id="nama" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Email</span>
                                <span id="email" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">No Telepon</span>
                                <span id="no_telepon" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Nama Desa</span>
                                <span id="nama_desa" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Nama Babin</span>
                                <span id="nama_lengkap" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Subjek</span>
                                <span id="subjek" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Isi Pesan</span>
                                <span id="pesan" class="detail-value"></span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Balasan</span>
                                <span id="balasan" class="detail-value"></span>
                            </div>
                            <!-- <div class="detail-item">
                                <span class="detail-label">Status</span>
                                <span id="status" class="detail-value" style="display: important;"></span>
                            </div> -->
                        </div>
                    </section>
                </div>

                <script>
                    document.getElementById('formCekPengaduan').addEventListener('submit', async function(e) {
                        e.preventDefault();

                        const kode = document.getElementById('kode_pengaduan').value.trim();
                        const hasilDiv = document.getElementById('hasilPengaduan');
                        const errorDiv = document.getElementById('errorMessage');
                        const errorText = document.getElementById('errorText');

                        if (!kode) {
                            errorText.textContent = 'Masukkan Kode Pengaduan Anda !';
                            errorDiv.classList.remove('hidden');
                            hasilDiv.classList.add('hidden');
                            return;
                        }

                        try {
                            const response = await fetch('/cek-pengaduan', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/x-www-form-urlencoded',
                                },
                                body: `kode_pengaduan=${kode}`
                            });

                            const data = await response.json();

                            if (data.status_pengecekan === 'success') {
                                console.log('Data pengaduan:', data.pengaduan);
                                // Isi data pengaduan
                                document.getElementById('nama').textContent = data.pengaduan.nama;
                                document.getElementById('nama_desa').textContent = data.pengaduan.nama_desa;
                                document.getElementById('nama_lengkap').textContent = data.pengaduan.nama_lengkap;
                                document.getElementById('no_telepon').textContent = data.pengaduan.no_telepon;
                                document.getElementById('email').textContent = data.pengaduan.email;
                                document.getElementById('pesan').textContent = data.pengaduan.pesan;
                                // document.getElementById('status').textContent = data.pengaduan.status;
                                document.getElementById('subjek').textContent = data.pengaduan.subjek;

                                document.getElementById('balasan').textContent = data.pengaduan.balasan || 'Belum diproses, Mohon Cek Secara Berkala. Terima Kasih !';

                                hasilDiv.classList.remove('hidden');
                                errorDiv.classList.add('hidden');
                            } else {
                                errorText.textContent = 'Kode pengaduan tidak ditemukan !';
                                hasilDiv.classList.add('hidden');
                                errorDiv.classList.remove('hidden');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            errorText.textContent = 'Terjadi kesalahan saat memproses permintaan !';
                            hasilDiv.classList.add('hidden');
                            errorDiv.classList.remove('hidden');
                        }
                    });

                    // Event listener untuk tombol reset
                    document.getElementById('btnReset').addEventListener('click', function() {
                        document.getElementById('formCekPengaduan').reset();
                        document.getElementById('hasilPengaduan').classList.add('hidden');
                        document.getElementById('errorMessage').classList.add('hidden');
                        document.getElementById('kode_pengaduan').focus();
                    });
                </script>

                <?= $this->include('layouts/sideInformasi') ?>
            </div>
        </div>
    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?= $this->include('layouts/script2') ?>