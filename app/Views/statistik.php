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
                            <h1>Statistik Wilayah</h1>
                            <p class="mb-0">Temukan Data Informasi Setiap Wilayahnya</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/">Beranda</a></li>
                        <li class="current">Statistik</li>
                    </ol>
                </div>
            </nav>
        </div><!-- End Page Title -->

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <h2 class="text-center mb-4 mt-4 widget-title" style="font-size: 42px;">Statistik Desa</h2>
                    <section id="blog-details" class="statistik-card">
                        <div class="form-inline form-row align-items-center mb-3">
                            <div class="col-auto">
                                <select id="desaSelector" class="form-select" onchange="updateChart()">
                                    <option value="">Pilih Desa</option>
                                    <?php foreach ($tb_desa as $row) : ?>
                                        <option value="<?= esc($row['id_desa'], 'attr') ?>"
                                            data-nama-desa="<?= esc($row['nama_desa'], 'attr') ?>"
                                            <?= old('id_desa') == $row['id_desa'] ? 'selected' : ''; ?>>
                                            <?= esc($row['nama_desa'], 'html') ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-auto">
                                <select id="kategoriSelector" class="form-select" onchange="updateChart()">
                                    <option value="">Pilih Kategori</option>
                                    <option value="Jenis Kelamin">Jenis Kelamin</option>
                                    <option value="Usia">Usia</option>
                                    <option value="Pendidikan">Pendidikan</option>
                                    <option value="Pekerjaan">Pekerjaan</option>
                                    <option value="Infrastruktur">Infrastruktur</option>
                                </select>
                            </div>
                            <div class="col-md-3 btn-group pb-3">
                                <button id="resetButton" type="button" class="btn btn-reset" onclick="resetSelections()">Hapus</button>
                            </div>
                        </div>
                        <div id="container" style="width:100%; height:400px; margin-top: 20px;"></div>
                    </section>
                </div>

                <!-- Script Chart -->
                <script>
                    // Inisialisasi chart
                    const chart = Highcharts.chart('container', {
                        chart: {
                            type: 'spline'
                        },
                        title: {
                            text: 'Statistik Desa'
                        },
                        accessibility: {
                            enabled: false
                        },
                        xAxis: {
                            categories: []
                        },
                        plotOptions: {
                            spline: {
                                marker: {
                                    radius: 4,
                                    lineColor: '#666666',
                                    lineWidth: 1
                                },
                                dataLabels: {
                                    enabled: true,
                                    formatter: function() {
                                        return Highcharts.numberFormat(this.y, 0, ',', '.');
                                    }
                                }
                            }
                        },
                        series: [{
                            name: 'Data',
                            data: []
                        }],
                        tooltip: {
                            formatter: function() {
                                const additionalInfo = this.series.userOptions.additionalInfo || {};
                                const luasWilayah = additionalInfo.luas_wilayah ? Highcharts.numberFormat(additionalInfo.luas_wilayah, 0, ',', '.') : 'N/A';
                                const jumlahPenduduk = additionalInfo.jumlah_penduduk ? Highcharts.numberFormat(additionalInfo.jumlah_penduduk, 0, ',', '.') : 'N/A';

                                return `
                                <b>${this.x}</b>: ${Highcharts.numberFormat(this.y, 0, ',', '.')} ${this.series.userOptions.tooltipSuffix || ''}<br/>
                                - Luas Wilayah: ${luasWilayah} (ha)<br/>
                                - Jumlah Penduduk: ${jumlahPenduduk} (jiwa)`;
                            },
                            crosshairs: true,
                            shared: true
                        }
                        // exporting: {
                        //     enabled: true,
                        //     sourceWidth: 1200, // Ukuran gambar ekspor
                        //     sourceHeight: 600,
                        //     scale: 1,
                        //     fallbackToExportServer: false, // Nonaktifkan server ekspor eksternal
                        //     // Gunakan ekspor lokal
                        //     exportChartLocal: true,
                        //     buttons: {
                        //         contextButton: {
                        //             menuItems: ["downloadPNG", "downloadJPEG", "downloadPDF", "downloadSVG"]
                        //         }
                        //     }
                        // }
                    });

                    // Function to Update Chart Based on Selection
                    function updateChart() {
                        const desaSelector = document.getElementById('desaSelector');
                        const desaId = desaSelector.value;
                        const namaDesa = desaSelector.options[desaSelector.selectedIndex].dataset.namaDesa;
                        const kategori = document.getElementById('kategoriSelector').value;

                        let tooltipSuffix = '';
                        if (kategori === 'Jenis Kelamin' || kategori === 'Usia' || kategori === 'Pendidikan' || kategori === 'Pekerjaan') {
                            tooltipSuffix = '(Jiwa)';
                        } else if (kategori === 'Infrastruktur') {
                            tooltipSuffix = '(Unit)';
                        }

                        if (desaId && kategori) {
                            fetch(`/admin/desa/getDesaData/${desaId}/${kategori}`)
                                .then(response => response.json())
                                .then(data => {
                                    const categories = Object.keys(data.filteredData);
                                    const values = Object.values(data.filteredData).map(value => Number(value));

                                    const colors = ['#FEFFA7', '#F95454', '#A0D683', '#B7B7B7', '#CDC1FF'];

                                    chart.update({
                                        xAxis: {
                                            categories: categories
                                        },
                                        series: [{
                                            name: kategori,
                                            data: values.map((value, index) => ({
                                                y: value,
                                                color: colors[index % colors.length]
                                            })),
                                            tooltipSuffix: tooltipSuffix,
                                            additionalInfo: {
                                                luas_wilayah: data.additionalInfo.luas_wilayah,
                                                jumlah_penduduk: data.additionalInfo.jumlah_penduduk
                                            },
                                            dataLabels: {
                                                enabled: true,
                                                formatter: function() {
                                                    return Highcharts.numberFormat(this.y, 0, ',', '.');
                                                }
                                            }
                                        }]
                                    });

                                    chart.setTitle({
                                        text: `Statistik ${kategori} Desa ${namaDesa}`
                                    });
                                })
                                .catch(error => console.error('Error:', error));
                        }
                    }

                    // Fungsi untuk mengekspor grafik dengan format yang dipilih
                    // function exportChart() {
                    //     const desaSelector = document.getElementById('desaSelector');
                    //     const kategoriSelector = document.getElementById('kategoriSelector');
                    //     const namaDesa = desaSelector.options[desaSelector.selectedIndex].dataset.namaDesa;
                    //     const kategori = kategoriSelector.value;

                    //     // Ganti nama file sesuai dengan kategori dan nama desa
                    //     const filename = `statistik-${kategori}-desa-${namaDesa}`;

                    //     // Tampilkan pilihan format
                    //     const format = prompt("Pilih format ekspor (png, jpeg, pdf, svg):", "png").toLowerCase();

                    //     // Validasi format
                    //     if (['png', 'jpeg', 'pdf', 'svg'].includes(format)) {
                    //         chart.exportChartLocal({
                    //             type: `image/${format}`, // Ganti tipe sesuai pilihan
                    //             filename: filename // Menyertakan nama file yang diubah
                    //         });
                    //     } else {
                    //         alert("Format tidak valid. Silakan pilih antara png, jpeg, pdf, atau svg.");
                    //     }
                    // }

                    function resetSelections() {
                        document.getElementById('desaSelector').selectedIndex = 0;
                        document.getElementById('kategoriSelector').selectedIndex = 0;
                        chart.update({
                            xAxis: {
                                categories: []
                            },
                            series: [{
                                name: '',
                                data: []
                            }]
                        });
                        chart.setTitle({
                            text: 'Statistik Desa'
                        });
                    }
                </script>
                <!-- End Chart -->

                <div class="col-lg-4 sidebar">
                    <div class="widgets-container">
                        <!-- Search Widget -->
                        <div class="search-widget widget-item">
                            <h3 class="widget-title">Search</h3>
                            <form action="">
                                <input type="text">
                                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
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
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <p>No recent posts available.</p>
                            <?php endif; ?>
                        </div>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?= $this->include('layouts/footer') ?>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <?= $this->include('layouts/script2') ?>