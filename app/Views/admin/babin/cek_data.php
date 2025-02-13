<?= $this->include('admin/layouts/script') ?>

<style>
    /* CSS untuk status "Belum Diproses" dan "Diproses" */
    .text-warning {
        background-color: #ffeeba;
        color: #856404;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Data Bhabin</a></li>
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
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Bhabin</b></h4>
                            <?php if (!empty($tb_babin)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= base_url(esc($tb_babin['foto'], 'attr')) ?>" id="gambar_load" width="200px" height="200">
                                    </td>
                                    <th width="170px">Nama Lengkap</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= esc($tb_babin['nama_lengkap'] ?? '') ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">NRP</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><strong><?= esc($tb_babin['nrp'] ?? '') ?></strong></td>
                                </tr>
                                <tr>
                                    <th width="150px">Pangkat</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_babin['pangkat'] ?? '') ?></td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_babin['jabatan'] ?? '') ?></td>
                                </tr>
                                <tr>
                                    <th>No Telepon</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_babin['no_telepon'] ?? '') ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_babin['email'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th style="font-size: 1.0rem;">Tanggal Mulai Tugas</th>
                                    <th class="text-center" style="font-size: 1.0rem;">:</th>
                                    <td style="font-size: 1.0rem;"><?= formatTanggalIndo($tb_babin['tanggal_mulai_tugas'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <th style="font-size: 1.0rem;">Desa Yang Diampu</th>
                                    <th class="text-center" style="font-size: 1.0rem;">:</th>
                                    <td>
                                        <?php if (empty($tb_babin['nama_desa'])) : ?>
                                            <span class="badge bg-danger" style="font-size: 0.75em;">Tidak ada desa yang di ampu</span>
                                        <?php else : ?>
                                            <?php
                                            $desaList = explode(", ", $tb_babin['nama_desa']);
                                            foreach ($desaList as $desa) :
                                            ?>
                                                <span class="badge bg-success" style="font-size: 0.75rem;"><?= esc($desa) ?></span>
                                            <?php endforeach; ?>
                                            <br><br>
                                            <span class="badge bg-primary" style="font-size: 0.75rem;">Jumlah Desa : <?= count($desaList) ?></span>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                            <?php endif; ?>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('/admin/babin'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('/admin/babin/edit/' . $tb_babin['id_babin']), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-edit"></i> Ubah Data Babin
                                </a>
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

</body>

</html>