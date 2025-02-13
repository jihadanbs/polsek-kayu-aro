<?= $this->include('admin/layouts/script') ?>
<style>
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .text-success {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk readmore */
    .modal {
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

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border-radius: 5px;
        width: 80%;
        max-width: 600px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
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
    <!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Pengaduan Masyarakat</a></li>
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

                        <?php
                        function getStatusClass($status)
                        {
                            switch ($status) {
                                case 'Sudah Ditanggapi':
                                    return 'text-success';
                                case 'Ditolak':
                                    return 'text-danger';
                                case 'Diproses':
                                    return 'text-warning';
                                default:
                                    return 'text-warning';
                            }
                        }
                        ?>
                        <?php
                        function truncateText($text, $maxLength)
                        {
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }
                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center"><b>Formulir Cek Data Pengaduan Masyarakat</b></h4>
                            <h4 class="text-center mb-3 text-success" style="width: 200px; margin-left: 480px"><b>"<?= $tb_pengaduan['kode_pengaduan'] ?? '' ?>"</b></h4>
                            <?php if (!empty($tb_pengaduan)) : ?>
                                <tr>
                                    <td rowspan="50" width="250px" class="text-center">
                                        <img src="<?= base_url('assets/img/binmas.png') ?>" id="gambar_load" width="250px" height="200">
                                    </td>
                                    <th width="170px">Nama Lengkap</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['nama'] ?? '' ?></strong> </td>
                                </tr>
                                <tr>
                                    <th width="150px">No Telepon</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['no_telepon'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">Email</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['email'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">Nama Desa</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['nama_desa'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">Nama Babin</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['nama_lengkap'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Subjek</th>
                                    <th class="text-center">:</th>
                                    <td><strong><?= $tb_pengaduan['subjek'] ?? '' ?></strong></td>
                                </tr>
                                <tr>
                                    <th>Isi Pesan</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><?= truncateText($tb_pengaduan['pesan'] ?? '', 70) ?? 'Data tidak ditemukan'; ?>
                                        <?php if (strlen(strip_tags($tb_pengaduan['pesan'] ?? '')) > 70) : ?>
                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_pengaduan['pesan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Balasan Pesan</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore"><?= truncateText($tb_pengaduan['balasan'] ?? '', 70) ?? '', 'Pesan Belum Mendapatkan Balasan'; ?>
                                        <?php if (strlen(strip_tags($tb_pengaduan['balasan'] ?? '')) > 70) : ?>
                                            <a href="#" class="read-more-link" data-text="<?= htmlspecialchars(strip_tags($tb_pengaduan['balasan']), ENT_QUOTES, 'UTF-8') ?>">Read more..</a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong class="<?= getStatusClass($tb_pengaduan['status'] ?? '') ?>">
                                            <?= empty($tb_pengaduan['status'] ?? '') ? 'Belum dibalas' : $tb_pengaduan['status'] ?? '' ?>
                                        </strong>
                                    </td>
                                </tr>

                                <!-- Modal Structure -->
                                <div id="readMoreModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">&times;</span>
                                        <p id="modal-text"></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </table>

                        <table class="table table-bordered table-sm">
                            <thead class="text-center">
                                <tr>
                                    <th width="50px">NO</th>
                                    <th>DOKUMENTASI PENGADUAN MASYARAKAT</th>
                                    <th width="100px">AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($tb_pengaduan)) : ?>
                                    <tr>
                                        <td class="text-center">1</td>
                                        <td><?= esc($tb_pengaduan['subjek'] ?? '', 'html') ?></td>
                                        <td class="text-center">
                                            <?php if ($tb_pengaduan['dokumentasi'] ?? '') : ?>
                                                <a href="<?= esc(base_url($tb_pengaduan['dokumentasi'] ?? ''), 'attr') ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
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
                                <a href="<?= site_url('/admin/pengaduan'); ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= site_url('/admin/pengaduan/balas/' . $tb_pengaduan['id_pengaduan']); ?>" class="btn btn-success btn-md ml-3 <?= $tb_pengaduan['status'] == 'Sudah Ditanggapi' ? 'disabled' : '' ?>">
                                    <i class="fas fa-reply"></i> Balas
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $tb_pengaduan['id_pengaduan'] ?>">
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
    document.addEventListener("DOMContentLoaded", function() {
        const modal = document.getElementById("readMoreModal");
        const modalText = document.getElementById("modal-text");
        const closeBtn = document.querySelector(".modal .close");

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

<!-- Delete -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_pengaduan = $(this).data('id');

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
                        url: "<?= site_url('/admin/pengaduan/delete2'); ?>",
                        data: {
                            id_pengaduan: id_pengaduan,
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
                                    // Redirect ke halaman /admin/pengaduan setelah sukses menghapus
                                    window.location.href = '<?= site_url('/admin/pengaduan'); ?>';
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

</body>

</html>