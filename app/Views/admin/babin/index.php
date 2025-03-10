<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk status "Belum Diproses" dan "Diproses" */
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
    }

    /* CSS untuk status "Diberikan" */
    .text-success {
        background-color: #d4edda;
        color: #155724;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    /* CSS untuk status "Ditolak" */
    .text-danger {
        background-color: #f8d7da;
        color: #721c24;
        padding: 5px 10px;
        border-radius: 5px;
    }

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

    .jumlah-penduduk {
        color: #2c3e50;
        font-weight: bold;
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
                        <h4 class="mb-sm-0 font-size-18">Data Bhabin</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Master Bhabin</a></li>
                                <li class="breadcrumb-item active">Data Bhabin</li>
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
                                <!-- script truncate -->
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
                                <!-- end script truncate -->

                                <div class="col-md-3 mb-3">
                                    <a href="<?= esc(site_url('/admin/babin/tambah'), 'attr') ?>" class="btn waves-effect waves-light" style="background-color: #28527A; color:white;">
                                        <i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah
                                    </a>
                                </div>

                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Telepon</th>
                                        <th>NRP</th>
                                        <th>Jabatan</th>
                                        <th>Desa Yang Diampu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_babin as $row) : ?>
                                        <tr>
                                            <td data-field="id_babin" style="width: 10px" scope="row"><?= esc($i++, 'html'); ?></td>
                                            <td><?= esc(truncateText($row['nama_lengkap'], 10), 'html'); ?></td>
                                            <td><?php
                                                // Ambil nomor telepon dari database
                                                $no_telepon = $row['no_telepon'];

                                                // Konversi nomor telepon ke format internasional
                                                if (substr($no_telepon, 0, 1) == '0') {
                                                    $no_telepon_wa = '+62' . substr($no_telepon, 1);
                                                } else {
                                                    $no_telepon_wa = $no_telepon;
                                                }

                                                // Buat link WhatsApp
                                                $link_wa = "https://wa.me/{$no_telepon_wa}";
                                                ?>
                                                <a href="<?= esc($link_wa, 'attr'); ?>" target="_blank" class="text-success">
                                                    <?= esc($no_telepon); ?>
                                                </a>
                                            </td>
                                            <td><?= esc($row['nrp'], 'html'); ?></td>
                                            <td><?= esc($row['jabatan'], 'html'); ?></td>
                                            <td><?= esc(truncateText($row['nama_desa'], 20), 'html'); ?></td>
                                            <td style="width: 155px">
                                                <a href="<?= esc(site_url('/admin/babin/cek_data/' . urlencode($row['id_babin'])), 'attr') ?>" class="btn btn-info btn-sm view">
                                                    <i class="fa fa-eye"></i> Cek
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= esc($row['id_babin'], 'attr') ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

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
                var id_babin = $(this).data('id');

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
                            url: '<?= site_url('/admin/babin/delete') ?>', // Ubah sesuai dengan URL
                            data: {
                                id_babin: id_babin,
                                _method: 'DELETE'
                            },
                            dataType: 'json',
                            // headers: {
                            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
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