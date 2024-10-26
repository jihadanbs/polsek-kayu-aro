<?= $this->include('admin/layouts/script') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

<style>
    .text-primary {
        background-color: #CBDCEB;
        color: #608BC1;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .text-success {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .text-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }
</style>

<div class="col-md-12">

    <?= $this->include('admin/layouts/navbar') ?>
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
    <div style="pointer-events: none;">
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
                            <h4 class="mb-sm-0 font-size-18">Formulir Cek Data</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Review</a></li>
                                    <li class="breadcrumb-item active">Formulir Cek Data</li>
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
                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Review Pengunjung</b></h4>
                            <?php if (!empty($tb_review)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= base_url(esc($tb_review['file_foto'], 'attr')) ?>" id="gambar_load" width="200px" height="200px" alt="Foto Pengunjung">
                                    </td>
                                    <th width="170px">Nama Lengkap</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_review['nama_lengkap'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Pekerjaan</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_review['pekerjaan'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Rating</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?php
                                        $rating = (float) $tb_review['rating']; // Mengkonversi rating menjadi float
                                        $fullStars = floor($rating); // Menghitung bintang penuh
                                        $halfStars = ($rating - $fullStars >= 0.5) ? 1 : 0; // Menghitung setengah bintang
                                        $emptyStars = 5 - ($fullStars + $halfStars); // Menghitung bintang kosong
                                        ?>

                                        <!-- Menampilkan bintang penuh -->
                                        <?php for ($i = 0; $i < $fullStars; $i++): ?>
                                            <i class="bi bi-star-fill"></i>
                                        <?php endfor; ?>

                                        <!-- Menampilkan setengah bintang -->
                                        <?php if ($halfStars): ?>
                                            <i class="bi bi-star-half"></i>
                                        <?php endif; ?>

                                        <!-- Menampilkan bintang kosong -->
                                        <?php for ($i = 0; $i < $emptyStars; $i++): ?>
                                            <i class="bi bi-star"></i>
                                        <?php endfor; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="150px">Text Review</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_review['pesan_review'] ?? '', 'html') ?></td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/review'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $tb_review['id_reviewer'] ?>">
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

<!-- HAPUS -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_reviewer = $(this).data('id');

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
                        url: "/admin/review/delete2", // Ubah sesuai dengan URL
                        data: {
                            id_reviewer: id_reviewer,
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
                                    window.location.href = '/admin/review';
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