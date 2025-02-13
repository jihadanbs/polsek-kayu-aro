<?= $this->include('admin/layouts/script') ?>

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
                                        <img src="<?= esc('https://4.bp.blogspot.com/-mZIESsyeTVQ/W-PF6769_-I/AAAAAAAAPtk/riuYYSxoE3U9kpsFMgjA5MyNw8oYm5omQCLcBGAs/s1600/Binmas.png', 'attr') ?>" id="gambar_load" width="250px" height="200px" alt="Logo Desa">
                                    </td>
                                    <th width="170px">A. Data Umum Desa<span style="color: red;">*</span></th>
                                </tr>
                                <tr>
                                    <th width="150px">Nama Desa</th>
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
                                        <span class="text-danger"><?= isset($tb_desa['luas_wilayah']) ? number_format(esc($tb_desa['luas_wilayah'], 'html'), 0, ',', '.') : '' ?> ha (hektar)</span>
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
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <th>B. Sensus Penduduk<span style="color: red;">*</span></th>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk']) ? number_format(esc($tb_desa['jumlah_penduduk'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Kepala keluarga</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_kepala_keluarga']) ? number_format(esc($tb_desa['jumlah_kepala_keluarga'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Pria</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_pria']) ? number_format(esc($tb_desa['jumlah_penduduk_pria'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Wanita</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_wanita']) ? number_format(esc($tb_desa['jumlah_penduduk_wanita'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Usia 0-14th</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_usia_0_14']) ? number_format(esc($tb_desa['jumlah_penduduk_usia_0_14'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Usia 15 - 64th</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_usia_15_64']) ? number_format(esc($tb_desa['jumlah_penduduk_usia_15_64'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Usia 65th Keatas</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_usia_65_keatas']) ? number_format(esc($tb_desa['jumlah_penduduk_usia_65_keatas'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td rowspan="17" width="250px" class="text-center">
                                    </td>
                                    <th width="170px">~ B1. Pendidikan<span style="color: red;">*</span></th>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Tidak Sekolah</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_tidak_sekolah']) ? number_format(esc($tb_desa['jumlah_penduduk_tidak_sekolah'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Menempuh SD</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_sd']) ? number_format(esc($tb_desa['jumlah_penduduk_sd'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Menempuh SMP</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_smp']) ? number_format(esc($tb_desa['jumlah_penduduk_smp'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Menempuh SMA / SMK</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_sma_smk']) ? number_format(esc($tb_desa['jumlah_penduduk_sma_smk'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th width="350px">Jumlah Penduduk Menempuh Diploma / Sarjana</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_diploma_sarjana']) ? number_format(esc($tb_desa['jumlah_penduduk_diploma_sarjana'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>~ B2. Pekerjaan<span style="color: red;">*</span></th>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Sudah Bekerja</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_bekerja']) ? number_format(esc($tb_desa['jumlah_penduduk_bekerja'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Penduduk Tidak Bekerja</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-success"><?= isset($tb_desa['jumlah_penduduk_tidak_bekerja']) ? number_format(esc($tb_desa['jumlah_penduduk_tidak_bekerja'], 'html'), 0, ',', '.') : '' ?> Jiwa</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3">
                                        <hr>
                                    </td>
                                </tr>
                                <tr>
                                    <th>C. Infrastruktur dan Layanan Umum<span style="color: red;">*</span></th>
                                </tr>
                                <tr>
                                    <th>Jumlah Sekolah</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-primary"><?= isset($tb_desa['jumlah_sekolah']) ? number_format(esc($tb_desa['jumlah_sekolah'], 'html'), 0, ',', '.') : '' ?> Unit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Tempat Ibadah</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-primary"><?= isset($tb_desa['jumlah_tempat_ibadah']) ? number_format(esc($tb_desa['jumlah_tempat_ibadah'], 'html'), 0, ',', '.') : '' ?> Unit</span>
                                    </td>
                                </tr>
                                <tr>
                                    </td>
                                    <th>Jumlah Posyandu</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-primary"><?= isset($tb_desa['jumlah_posyandu']) ? number_format(esc($tb_desa['jumlah_posyandu'], 'html'), 0, ',', '.') : '' ?> Unit</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pos Ronda</th>
                                    <th class="text-center">:</th>
                                    <td>
                                        <span class="text-primary"><?= isset($tb_desa['jumlah_pos_ronda']) ? number_format(esc($tb_desa['jumlah_pos_ronda'], 'html'), 0, ',', '.') : '' ?> Unit</span>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                        <!-- memformat angka dengan pemisah ribuan berupa titik  -->
                        <script>
                            function formatNumber() {
                                // Ambil nilai dari input
                                let number = document.getElementById('numberInput').value;

                                // Pastikan hanya angka yang diformat
                                let formattedNumber = number.replace(/\D/g, '');

                                // Format angka dengan titik sebagai pemisah ribuan
                                formattedNumber = formattedNumber.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                                // Tampilkan angka yang diformat
                                document.getElementById('formattedNumber').innerText = formattedNumber;
                            }
                        </script>
                        <!-- end memformat angka -->

                        <div class="form-group mb-4 mt-4">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="<?= esc(site_url('admin/desa'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                                <a href="<?= esc(site_url('admin/desa/edit/' . ($tb_desa['id_desa'] ?? '')), 'attr') ?>" class="btn btn-warning btn-md edit">
                                    <i class="fas fa-edit"></i> Ubah Data Desa
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