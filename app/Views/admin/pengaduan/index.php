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
                        <h4 class="mb-sm-0 font-size-18">Data Pengaduan Masyarakat</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pengaduan Masyarakat</a></li>
                                <li class="breadcrumb-item active">Data Pengaduan Masyarakat</li>
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
                                <!-- TRUNCATE TEXT -->
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
                                <!-- END TRUNCATE TEXT -->

                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>No Telepon</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($tb_pengaduan as $row) : ?>
                                        <tr>
                                            <td data-field="id_pengaduan" style="width: 10px" scope="row"><?= $i++; ?></td>
                                            <td><?= truncateText($row->nama, 70); ?></td>
                                            <td><?php
                                                // Ambil nomor telepon dari database
                                                $no_telepon = $row->no_telepon;

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
                                            <td><?= $row->email; ?></td>
                                            <td><?= truncateText($row->subjek, 70); ?></td>
                                            <td>
                                                <?php
                                                $statusClass = '';
                                                if ($row->status === 'Belum dibalas') {
                                                    $statusClass = 'text-warning';
                                                } elseif ($row->status === 'Sudah Ditanggapi') {
                                                    $statusClass = 'text-success';
                                                }
                                                ?>
                                                <span class="<?= $statusClass; ?>"><strong><?= $row->status; ?></strong></span>
                                            </td>
                                            <td style="width: 155px">
                                                <a href="<?= site_url('/admin/pengaduan/cek_data/' . $row->id_pengaduan); ?>" class="btn btn-info btn-sm view"><i class="fa fa-eye"></i> Cek</a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning <?= $row->status == 'Belum dibalas' ? 'disabled' : '' ?>" data-id="<?= $row->id_pengaduan ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <small class="form-text text-danger">Note : Bila Tidak Bisa Melakukan Delete Dihalaman Ini, Anda Bisa Melakukannya Pada Halaman CEK DATA PENGADUAN MASYARAKAT</small>
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
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdf',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
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
                            url: '<?= site_url("/admin/pengaduan/delete") ?>',
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