<?= $this->include('admin/layouts/script') ?>

<style>
    .tabel-kanan {
        display: flex;
        margin-left: 20px;
    }

    /* CSS untuk readmore */
    .jendela {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.7);
    }

    .jendela-content {
        position: relative;
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .close {
        position: absolute;
        top: -8px;
        right: 10px;
        color: red;
        font-size: 30px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    .read-more-link {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }
</style>

<div class="col-md-12">
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
        <?= $this->include('admin/layouts/navbar') ?>
        <?= $this->include('admin/layouts/sidebar') ?>
    </div>
    <?= $this->include('admin/layouts/rightsidebar') ?>

    <?= $this->section('content'); ?>

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Laporan</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan Babin</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data Laporan</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title">POLSEK KAYU ARO</h3>
                    </div>

                    <div class="card-body">

                        <!-- truncate text -->
                        <?php
                        function truncateText($text, $maxLength)
                        {
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }
                        ?>
                        <!-- end truncate text -->

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Laporan</b></h4>
                            <?php if (!empty($tb_laporan_babin)) : ?>
                                <tr>
                                    <td rowspan="1" width="250px" class="text-center">
                                        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel" style="text-align: center;">
                                            <div class="carousel-inner">
                                                <?php foreach (explode(', ', $tb_laporan_babin['file_foto'] ?? '') as $index => $file) : ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block mx-auto file_foto" alt="..." style="max-width: 150px; max-height: 100px;">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev" style="background-color: black; border-radius: 10px;">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next" style="background-color: black; border-radius: 10px;">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Judul Laporan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <p><?= esc($tb_laporan_babin['judul_laporan'] ?? '', 'html'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Jenis Kegiatan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <p><?= esc($tb_laporan_babin['jenis_kegiatan'] ?? '', 'html'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Tanggal Laporan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <p><?= esc($tb_laporan_babin['tanggal_laporan'] ?? '', 'html'); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Deskripsi Kegiatan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <strong>
                                                        <?= truncateText($tb_laporan_babin['uraian_kegiatan'] ?? 'Belum ada catatan lebih lanjut', 50); ?>
                                                        <?php if (strlen(strip_tags($tb_laporan_babin['uraian_kegiatan'] ?? '')) > 50) : ?>
                                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_laporan_babin['uraian_kegiatan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                        <?php endif; ?>
                                                    </strong>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Hasil Kegiatan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <strong>
                                                        <?= truncateText($tb_laporan_babin['hasil_kegiatan'] ?? 'Belum ada catatan lebih lanjut', 50); ?>
                                                        <?php if (strlen(strip_tags($tb_laporan_babin['hasil_kegiatan'] ?? '')) > 50) : ?>
                                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_laporan_babin['hasil_kegiatan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                        <?php endif; ?>
                                                    </strong>
                                                </div>
                                            </div>

                                            <!-- script read more -->
                                            <script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    const modal = document.getElementById("readMoreModal");
                                                    const modalText = document.getElementById("jendela-text");
                                                    const closeBtn = document.querySelector(".jendela .close");

                                                    document.querySelectorAll(".read-more-link").forEach(link => {
                                                        link.addEventListener("click", function(event) {
                                                            event.preventDefault();
                                                            const fullText = this.getAttribute("data-text");
                                                            modalText.innerText = fullText;
                                                            modal.style.display = "block";
                                                        });
                                                    });

                                                    closeBtn.addEventListener("click", function() {
                                                        modal.style.display = "none";
                                                    });

                                                    window.addEventListener("click", function(event) {
                                                        if (event.target == modal) {
                                                            modal.style.display = "none";
                                                        }
                                                    });
                                                });
                                            </script>
                                            <!-- end script -->

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="fw-bold text-black">Lokasi Kegiatan :</label>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <p id="lokasi_nama"><?= esc($tb_laporan_babin['lokasi_kegiatan'] ?? '', 'html'); ?></p>
                                                </div>
                                            </div>

                                            <!-- Modal Structure -->
                                            <div id="readMoreModal" class="jendela">
                                                <div class="jendela-content">
                                                    <span class="close">&times;</span>
                                                    <p id="jendela-text"></p>
                                                </div>
                                            </div>

                                            <!-- Script Koordinat Lokasi -->
                                            <script>
                                                // Fungsi untuk mengonversi koordinat menjadi nama lokasi
                                                function reverseGeocode(lat, lng) {
                                                    var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&addressdetails=1`;

                                                    fetch(url)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            var address = data.display_name || 'Alamat tidak ditemukan';
                                                            document.getElementById('lokasi_nama').innerText = address;
                                                        })
                                                        .catch(err => console.error('Geocoding Error:', err));
                                                }

                                                // Ambil koordinat dari elemen HTML dan lakukan geocoding
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var lokasiKegiatan = "<?= esc($tb_laporan_babin['lokasi_kegiatan'] ?? '', 'js'); ?>";
                                                    if (lokasiKegiatan) {
                                                        var coords = lokasiKegiatan.split(',');
                                                        if (coords.length === 2) {
                                                            var lat = parseFloat(coords[0].trim());
                                                            var lng = parseFloat(coords[1].trim());
                                                            reverseGeocode(lat, lng);
                                                        }
                                                    }
                                                });
                                            </script>
                                            <!-- End Script Koordinat Lokasi -->

                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">NO</th>
                                    <th>Dokumentasi Foto</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php if (!empty($tb_laporan_babin)) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($no++, 'html'); ?>.</td>
                                        <td><?= esc($tb_laporan_babin['judul_laporan'] ?? '', 'html'); ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($tb_laporan_babin['file_foto'])) : ?>
                                                <button type="button" class="btn btn-info btn-sm view" data-bs-toggle="modal" data-bs-target="#exampleModal<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>">
                                                    <i class="fas fa-eye"></i> View File
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div id="carouselExampleControls<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>" class="carousel slide" data-bs-ride="carousel">
                                                                    <div class="carousel-inner">
                                                                        <?php foreach (explode(', ', $tb_laporan_babin['file_foto']) as $index => $file) : ?>
                                                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                                <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-width: 800px; max-height: 600px; margin: 0 auto;">
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>" data-bs-slide="prev" style="background-color: black; border-radius: 10px;">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls<?= esc($tb_laporan_babin['id_laporan_babin'] ?? '', 'attr'); ?>" data-bs-slide="next" style="background-color: black; border-radius: 10px;">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/laporan'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('admin/laporan/edit/' . urlencode($tb_laporan_babin['id_laporan_babin'])), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $tb_laporan_babin['id_laporan_babin'] ?>">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= $this->include('admin/layouts/footer') ?>
</div>
<?= $this->include('admin/layouts/script2') ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var carousels = document.querySelectorAll('.carousel');
        carousels.forEach(function(carousel) {
            new bootstrap.Carousel(carousel);
        });
    });
</script>

<!-- HAPUS -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_laporan_babin = $(this).data('id');

            Swal.fire({
                title: "Anda Yakin Ingin Menghapus?",
                text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#28527A",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/admin/laporan/delete2", // Ubah sesuai dengan URL
                        data: {
                            id_laporan_babin: id_laporan_babin,
                            _method: 'DELETE'
                        },
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                Swal.fire({
                                    title: "Dihapus!",
                                    text: response.message,
                                    icon: "success"
                                }).then(() => {
                                    // Redirect ke halaman /admin/laporan setelah sukses menghapus
                                    window.location.href = '/admin/laporan';
                                });
                            } else if (response.status === 'error') {
                                Swal.fire({
                                    title: "Gagal!",
                                    text: response.message,
                                    icon: "error"
                                });
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: "Terjadi kesalahan. Silakan coba lagi.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
    });
</script>
<!-- HAPUS -->

</body>

</html>