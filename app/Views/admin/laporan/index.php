<?= $this->include('admin/layouts/script') ?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
        font-size: 18px;
        text-align: left;
    }

    th,
    td {
        padding: 12px;
        border-bottom: 1px solid #ddd;
        text-align: center;
        vertical-align: middle;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<?= $this->include('admin/layouts/navbar') ?>
<?= $this->include('admin/layouts/sidebar') ?>
<?= $this->include('admin/layouts/rightsidebar') ?>

<?= $this->section('content'); ?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Data Laporan Babin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan Babin</a></li>
                                <li class="breadcrumb-item active">Data Laporan Babin</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->


            <div class="row">

                <div class="col-12">
                    <div class="card">

                        <div class="card-body">
                            <table id="example1" class="table table-bordered dt-responsive nowrap w-100">
                                <?= $this->include('alert/alert'); ?>
                                <div class="col-md-3 mb-3">
                                    <a href="<?= esc(site_url('admin/laporan/tambah'), 'attr') ?>" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>

                                <?php
                                function truncateText($text, $maxLength)
                                {
                                    // Memeriksa apakah teks lebih panjang dari batas maksimum
                                    if (strlen($text) > $maxLength) {
                                        // Mengambil substring dari awal hingga batas maksimum
                                        $text = substr($text, 0, $maxLength);
                                        // Mencari posisi spasi terakhir untuk memastikan tidak memotong kata di tengah
                                        $lastSpace = strrpos($text, ' ');
                                        if ($lastSpace !== false) {
                                            $text = substr($text, 0, $lastSpace);
                                        }
                                        // Menambahkan ellipsis (...) untuk menunjukkan bahwa teks dipotong
                                        $text .= '...';
                                    }
                                    return $text;
                                }
                                ?>

                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Judul Laporan</th>
                                        <th>Tanggal</th>
                                        <th>Jenis Kegiatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_laporan_babin as $row) : ?>
                                        <tr>
                                            <td data-field="id_laporan_babin" style="width: 10px" scope="row"><?= esc($i++, 'html'); ?></td>
                                            <td><?= esc($row['nama_lengkap'], 'html'); ?></td>
                                            <td><?= esc($row['judul_laporan'], 'html'); ?></td>
                                            <td><?= formatTanggalIndo($row['tanggal_laporan'], 'html'); ?></td>
                                            <td><?= esc($row['jenis_kegiatan'], 'html'); ?></td>
                                            <td style="width: 155px">
                                                <a href="<?= esc(site_url('admin/laporan/cek_data/' . urlencode($row['id_laporan_babin'])), 'attr') ?>" class="btn btn-info btn-sm view">
                                                    <i class="fa fa-eye"></i> Cek
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= esc($row['id_laporan_babin'], 'attr') ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <small class="form-text text-danger">Note : Bila Tidak Bisa Melakukan Delete Dihalaman Ini, Anda Bisa Melakukannya Pada Halaman CEK DATA LAPORAN</small>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <?= $this->include('admin/layouts/footer') ?>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?= $this->include('admin/layouts/script2') ?>

    <script>
        $(document).ready(function() {
            $("#example1").DataTable({
                "paging": true,
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": [{
                        extend: 'copy',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    'colvis'
                ],
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
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
                            url: '<?= site_url('/admin/laporan/delete') ?>',
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
                                        location.reload(); // Refresh halaman setelah sukses menghapus
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
                                console.log("Error details:", xhr.responseText); // Tambahkan ini untuk debugging
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