<?= $this->include('admin/layouts/script') ?>
<style>
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Edukasi</a></li>
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
                        function truncateText($text, $maxLength)
                        {
                            if (strlen($text) > $maxLength) {
                                return substr($text, 0, $maxLength) . '...';
                            }
                            return $text;
                        }
                        ?>

                        <?php
                        // Contoh format tanggal dari database
                        $tanggal_diterbitkan = $tb_informasi_edukasi[0]->tanggal_diterbitkan ?? '';

                        if (!empty($tanggal_diterbitkan)) {
                            $date = new DateTime($tanggal_diterbitkan);
                            $bulan = [
                                'January' => 'Januari',
                                'February' => 'Februari',
                                'March' => 'Maret',
                                'April' => 'April',
                                'May' => 'Mei',
                                'June' => 'Juni',
                                'July' => 'Juli',
                                'August' => 'Agustus',
                                'September' => 'September',
                                'October' => 'Oktober',
                                'November' => 'November',
                                'December' => 'Desember',
                            ];
                            $formatted_date = $date->format('d') . ' ' . $bulan[$date->format('F')] . ' ' . $date->format('Y');
                        } else {
                            $formatted_date = '';
                        }
                        ?>

                        <table class="table table-borderless table-sm">
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Informasi-Edukasi</b></h4>
                            <?php if (!empty($tb_informasi_edukasi)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <?php if ($tb_informasi_edukasi[0]->profile_penulis ?? '') : ?>
                                            <a href="<?= esc(base_url($tb_informasi_edukasi[0]->profile_penulis), 'attr') ?>" title="Lihat gambar" target="_blank">
                                                <img src="<?= esc(base_url($tb_informasi_edukasi[0]->profile_penulis), 'attr') ?>" width="250px" height="200px" alt="Gambar Penulis" id="gambar_load">
                                            </a>
                                        <?php else : ?>
                                            <a href="#" title="File tidak tersedia">
                                                <img src="<?= base_url('path/to/default/image.jpg') ?>" width="250px" height="200px" alt="Gambar tidak tersedia" id="gambar_load">
                                            </a>
                                        <?php endif; ?>
                                    </td>

                                    <th width="170px">Judul</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_informasi_edukasi[0]->judul ?? '', 'html') ?> </td>
                                </tr>
                                <tr>
                                    <th>Kategori Informasi</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_informasi_edukasi[0]->nama_kategori ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th style="font-size: 0.9rem;">Tanggal Diterbitkan</th>
                                    <th class="text-center" style="font-size: 0.9rem;">:</th>
                                    <td style="font-size: 0.9rem;"><?= esc($formatted_date, 'html') ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Penulis</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_informasi_edukasi[0]->penulis ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th>Isi Konten</th>
                                    <th class="text-center">:</th>
                                    <td class="readmore">
                                        <strong><?= esc(truncateText($tb_informasi_edukasi[0]->konten, 50) ?? 'Belum ada catatan lebih lanjut', 'html') ?>
                                            <?php if (strlen(strip_tags($tb_informasi_edukasi[0]->konten)) > 50) : ?>
                                                <a href="#" class="read-more-link" data-text="<?= esc(strip_tags($tb_informasi_edukasi[0]->konten), 'attr') ?>">Read more..</a>
                                            <?php endif; ?>
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
                                    <th>Dokumen Foto Informasi-Edukasi</th>
                                    <th width="100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1;
                                foreach ($dokumen as $key => $value) : ?>
                                    <tr>
                                        <td class="text-center"><?= esc($no++, 'html') ?>.</td>
                                        <td><?= esc($value->judul, 'html') ?></td>
                                        <td class="text-center">
                                            <?php if ($value->gambar) : ?>
                                                <a href="<?= esc(base_url($value->gambar), 'attr') ?>" class="btn btn-info btn-sm view" target="_blank">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php else : ?>
                                                <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                    <i class="fas fa-eye"></i> View File
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/informasi'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('admin/informasi/edit/' . $value->id_informasi), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <button type="button" class="btn btn-danger btn-md ml-3 waves-effect waves-light sa-warning" data-id="<?= $value->id_informasi ?>">
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

<!-- HAPUS -->
<script>
    $(document).ready(function() {
        $('.sa-warning').click(function(e) {
            e.preventDefault();
            var id_informasi = $(this).data('id');

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
                        url: "/admin/informasi/delete2", // Ubah sesuai dengan URL
                        data: {
                            id_informasi: id_informasi,
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
                                    // Redirect ke halaman /admin/informasi setelah sukses menghapus
                                    window.location.href = '/admin/informasi';
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