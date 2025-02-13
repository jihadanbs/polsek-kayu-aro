<?= $this->include('admin/layouts/script') ?>

<style>
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data Foto</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Galeri</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data Foto</li>
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
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Foto</b></h4>
                            <?php if (!empty($tb_foto)) : ?>
                                <tr>
                                    <td rowspan="1" width="250px" class="text-center">
                                        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <?php foreach (explode(', ', $tb_foto['file_foto'] ?? '') as $index => $file) : ?>
                                                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                        <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-height: 300px; object-fit: cover;">
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>
                                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>

                                    <td style="padding-left: 50px;">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Judul Foto</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= esc($tb_foto['judul_foto'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Tanggal Upload Foto</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <p><?= formatTanggalIndo($tb_foto['tanggal_foto'] ?? '', 'html'); ?></p>
                                            </div>

                                            <div class="col-md-2">
                                                <label class="fw-bold text-black">Deskripsi Foto</label>
                                            </div>
                                            <div class="col-auto">:</div>
                                            <div class="col-md-8">
                                                <strong>
                                                    <?= truncateText($tb_foto['deskripsi'] ?? 'Belum ada deskripsi lebih lanjut', 50); ?>
                                                    <?php if (strlen(strip_tags($tb_foto['deskripsi'] ?? '')) > 50) : ?>
                                                        <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_foto['deskripsi']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                                    <?php endif; ?>
                                                </strong>
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

                                            <!-- Modal Structure -->
                                            <div id="readMoreModal" class="jendela">
                                                <div class="jendela-content">
                                                    <span class="close">&times;</span>
                                                    <p id="jendela-text"></p>
                                                </div>
                                            </div>
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
                                <?php if (!empty($tb_foto)) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($no++, 'html'); ?>.</td>
                                        <td><?= esc($tb_foto['judul_foto'] ?? '', 'html'); ?></td>

                                        <td class="text-center">
                                            <?php if (!empty($tb_foto['file_foto'])) : ?>
                                                <button type="button" class="btn btn-info btn-sm view" data-bs-toggle="modal" data-bs-target="#exampleModal<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>">
                                                    <i class="fas fa-eye"></i> View File
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModal<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <div id="carouselExampleIndicators<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" class="carousel slide" data-bs-ride="carousel">
                                                                    <!-- Carousel Indicators -->
                                                                    <div class="carousel-indicators">
                                                                        <?php
                                                                        $files = explode(', ', $tb_foto['file_foto']);
                                                                        foreach ($files as $index => $file) :
                                                                        ?>
                                                                            <button type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" data-bs-slide-to="<?= $index; ?>" class="<?= $index === 0 ? 'active' : ''; ?>" aria-current="<?= $index === 0 ? 'true' : 'false'; ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                                                                        <?php endforeach; ?>
                                                                    </div>

                                                                    <!-- Carousel Items -->
                                                                    <div class="carousel-inner">
                                                                        <?php foreach ($files as $index => $file) : ?>
                                                                            <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                                                                                <img src="<?= esc(base_url($file), 'attr'); ?>" class="d-block w-100" alt="..." style="max-width: 800px; max-height: 600px; margin: 0 auto;">
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>

                                                                    <!-- Carousel Controls -->
                                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" data-bs-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Previous</span>
                                                                    </button>
                                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators<?= esc($tb_foto['id_foto'] ?? '', 'attr'); ?>" data-bs-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="visually-hidden">Next</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php else : ?>
                                                <a href="javascript: void(0);" class="btn btn-info btn-sm view disabled" title="Gambar tidak tersedia">
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
                                <a href="<?= esc(site_url('/admin/galeri'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('/admin/galeri/edit/' . urlencode($tb_foto['slug'])), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-edit"></i> Ubah Data Foto
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $tb_foto['id_foto'] ?>">
                                    <i class="fas fa-trash-alt"></i> Hapus Foto
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
            var id_foto = $(this).data('id');

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
                        url: "<?= site_url('/admin/galeri/delete2'); ?>", // Ubah sesuai dengan URL
                        data: {
                            id_foto: id_foto,
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
                                    // Redirect ke halaman /admin/galeri setelah sukses menghapus
                                    window.location.href = <?= site_url('/admin/galeri'); ?>
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