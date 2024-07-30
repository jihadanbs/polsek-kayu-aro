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
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Desa</a></li>
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
                            <h4 class="text-center mb-3"><b>Formulir Cek Data Desa</b></h4>
                            <?php if (!empty($tb_desa)) : ?>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                        <img src="<?= esc('https://4.bp.blogspot.com/-mZIESsyeTVQ/W-PF6769_-I/AAAAAAAAPtk/riuYYSxoE3U9kpsFMgjA5MyNw8oYm5omQCLcBGAs/s1600/Binmas.png', 'attr') ?>" id="gambar_load" width="250px" height="200" alt="Logo Desa">
                                    </td>
                                    <th width="170px">Nama Desa</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_desa['nama_desa'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Kecamatan</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_desa['kecamatan'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th width="150px">Kabupaten</th>
                                    <th width="30px" class="text-center">:</th>
                                    <td><?= esc($tb_desa['kabupaten'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th>Provinsi</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_desa['provinsi'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th>Kode Pos</th>
                                    <th class="text-center">:</th>
                                    <td><?= esc($tb_desa['kode_pos'] ?? '', 'html') ?></td>
                                </tr>
                                <tr>
                                    <th>Luas Wilayah</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-danger"><?= esc($tb_desa['luas_wilayah'] ?? '', 'html') ?> ha (hektar)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= esc($tb_desa['jumlah_penduduk'] ?? '', 'html') ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <strong>
                                            <?= empty($tb_desa['website']) ? 'Desa Tidak Memiliki Website' : esc($tb_desa['website'], 'html') ?>
                                        </strong>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/desa'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('admin/desa/edit/' . ($tb_desa['id_desa'] ?? '')), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-pencil-alt"></i> Edit
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