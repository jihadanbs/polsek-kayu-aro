<?= $this->include('admin/layouts/script') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

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
                        <h4 class="mb-sm-0 font-size-18">Data Desa</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Master Bhabin</a></li>
                                <li class="breadcrumb-item active">Data Desa</li>
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

                                <?php if (session()->getFlashdata('pesan')) : ?>
                                    <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-check-all me-3 align-middle"></i><strong>Sukses</strong> -
                                        <?= session()->getFlashdata('pesan') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>

                                <?php if (session()->getFlashdata('gagal')) : ?>
                                    <div class="alert alert-danger alert-border-left alert-dismissible fade show" role="alert">
                                        <i class="mdi mdi-block-helper me-3 align-middle"></i><strong>Gagal</strong> -
                                        <?= session()->getFlashdata('gagal') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif; ?>
                                <thead>
                                    <tr class="highlight text-center" style="background-color: #28527A; color: white;">
                                        <th>Nomor</th>
                                        <th>Nama Pengunjung</th>
                                        <th>Pekerjaan</th>
                                        <th>Rating</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $n = 1; ?>
                                    <?php foreach ($tb_review as $row) : ?>
                                        <tr>
                                            <td data-field="id_reviewer" style="width: 10px" scope="row"><?= esc($n++, 'html'); ?></td>
                                            <td data-field="nama_lengkap"><?= esc($row['nama_lengkap'], 'html'); ?></td>
                                            <td data-field="pekerjaan"><?= esc($row['pekerjaan'], 'html'); ?></td>
                                            <td data-field="rating">
                                                <?php
                                                $rating = (float) $row['rating']; // Mengkonversi rating menjadi float
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
                                            <td style="width: 155px">
                                                <a href="<?= esc(site_url('admin/review/cek_data/' . urlencode($row['id_reviewer'])), 'attr') ?>" class="btn btn-info btn-sm view">
                                                    <i class="fa fa-eye"></i> Cek
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm waves-effect waves-light sa-warning" data-id="<?= esc($row['id_reviewer'], 'attr') ?>">
                                                    <i class="fas fa-trash-alt"></i> Delete
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
                            url: '<?= site_url('/admin/review/delete') ?>',
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