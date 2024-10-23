<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Desa</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row justify-content-center">

                <div class="col-10">
                    <div class="card border border-secondary rounded p-4">
                        <div class="card-body">
                            <h2 class="text-center mb-4">Formulir Ubah Data Desa</h2>

                            <form action="<?= esc(site_url('admin/desa/update/' . $tb_desa['id_desa']), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <label class="col-form-label" style="font-size: 25px;">A. Data Umum Desa</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_desa" class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_desa')) ? 'is-invalid' : ''; ?>" id="nama_desa" style="background-color: white;" name="nama_desa" placeholder="Masukkan Nama Desa" value="<?= esc(old('nama_desa', $tb_desa['nama_desa']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nama_desa'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kecamatan" class="col-form-label">Kecamatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" style="background-color: white;" name="kecamatan" placeholder="Masukkan Kecamatan Desa Ini" value="<?= esc(old('kecamatan', $tb_desa['kecamatan']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kecamatan'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="kabupaten" class="col-form-label">Kabupaten</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" id="kabupaten" style="background-color: white;" name="kabupaten" placeholder="Masukkan Kabupaten Desa Ini" value="<?= esc(old('kabupaten', $tb_desa['kabupaten']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kabupaten'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi" class="col-form-label">Provinsi</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" id="provinsi" style="background-color: white;" name="provinsi" placeholder="Masukkan Provinsi Desa Ini" value="<?= esc(old('provinsi', $tb_desa['provinsi']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('provinsi'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="kode_pos" class="col-form-label">Kode Pos</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" id="kode_pos" style="background-color: white;" name="kode_pos" placeholder="Masukkan Kode Pos Desa Ini" value="<?= esc(old('kode_pos', $tb_desa['kode_pos']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kode_pos'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="luas_wilayah" class="col-form-label">Luas Wilayah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" class="form-control <?= ($validation->hasError('luas_wilayah')) ? 'is-invalid' : ''; ?>" id="luas_wilayah" style="background-color: white;" name="luas_wilayah" placeholder="Masukkan Luas Wilayah Desa Ini" value="<?= esc(old('luas_wilayah', $tb_desa['luas_wilayah']), 'html'); ?>">
                                            <span class="input-group-text">Hektar (ha)</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('luas_wilayah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label for="website" class="col-form-label">Website</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <span class="input-group-text">https:</span>
                                        <input type="text" class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : ''; ?>" id="website" style="background-color: white;" name="website" placeholder="Masukkan Website Desa Ini" value="<?= esc(old('website', $tb_desa['website']), 'html'); ?>">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('website'), 'html'); ?>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">Jika Desa Tidak Memiliki Website Kosongkan Saja</small>
                                    <hr style="border: 1px solid #ccc; margin-top: 20px; margin-bottom: 20px;">
                                </div>

                                <label class="col-form-label" style="font-size: 25px;">B. Sensus Penduduk</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk" class="col-form-label">Jumlah Penduduk</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk" style="background-color: white;" name="jumlah_penduduk" placeholder="Masukkan Jumlah Penduduk Desa Ini" value="<?= esc(old('jumlah_penduduk', $tb_desa['jumlah_penduduk']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_kepala_keluarga" class="col-form-label">Jumlah Kepala Keluarga</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga" style="background-color: white;" name="jumlah_kepala_keluarga" placeholder="Jumlah Kepala Keluarga" value="<?= esc(old('jumlah_kepala_keluarga', $tb_desa['jumlah_kepala_keluarga']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_kepala_keluarga'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_pria" class="col-form-label">Jumlah Penduduk Pria</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_pria')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_pria" style="background-color: white;" name="jumlah_penduduk_pria" placeholder="Jumlah Penduduk Pria" value="<?= esc(old('jumlah_penduduk_pria', $tb_desa['jumlah_penduduk_pria']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_pria'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_wanita" class="col-form-label">Jumlah Penduduk Wanita</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_wanita')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_wanita" style="background-color: white;" name="jumlah_penduduk_wanita" placeholder="Jumlah Penduduk Wanita" value="<?= esc(old('jumlah_penduduk_wanita', $tb_desa['jumlah_penduduk_wanita']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_wanita'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_usia_0_14" class="col-form-label">Jumlah Penduduk Usia 0 - 14th</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_0_14')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_0_14" style="background-color: white;" name="jumlah_penduduk_usia_0_14" placeholder="Jumlah Penduduk Usia 0 - 14th" value="<?= esc(old('jumlah_penduduk_usia_0_14', $tb_desa['jumlah_penduduk_usia_0_14']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_usia_0_14'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_usia_15_64" class="col-form-label">Jumlah Penduduk Usia 15 - 64th</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_15_64')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_15_64" style="background-color: white;" name="jumlah_penduduk_usia_15_64" placeholder="Jumlah Penduduk Usia 15 - 64th" value="<?= esc(old('jumlah_penduduk_usia_15_64', $tb_desa['jumlah_penduduk_usia_15_64']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_usia_15_64'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label for="jumlah_penduduk_usia_65_keatas" class="col-form-label">Jumlah Penduduk Usia 65th ke Atas</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_65_keatas')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_65_keatas" style="background-color: white;" name="jumlah_penduduk_usia_65_keatas" placeholder="Jumlah Penduduk Usia 65th ke Atas" value="<?= esc(old('jumlah_penduduk_usia_65_keatas', $tb_desa['jumlah_penduduk_usia_65_keatas']), 'html'); ?>">
                                        <span class="input-group-text">Jiwa</span>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('jumlah_penduduk_usia_65_keatas'), 'html'); ?>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-form-label" style="font-size: 20px; text-align: center; display: block;">- B1. Pendidikan -</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_tidak_sekolah" class="col-form-label">Jumlah Penduduk Tidak Sekolah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_tidak_sekolah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_tidak_sekolah" style="background-color: white;" name="jumlah_penduduk_tidak_sekolah" placeholder="Jumlah Penduduk Tidak Sekolah" value="<?= esc(old('jumlah_penduduk_tidak_sekolah', $tb_desa['jumlah_penduduk_tidak_sekolah']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_tidak_sekolah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_sd" class="col-form-label">Jumlah Penduduk Menempuh Sekolah Dasar</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_sd')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_sd" style="background-color: white;" name="jumlah_penduduk_sd" placeholder="Jumlah Penduduk Menempuh Sekolah Dasar" value="<?= esc(old('jumlah_penduduk_sd', $tb_desa['jumlah_penduduk_sd']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_sd'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_smp" class="col-form-label">Jumlah Penduduk Menempuh Sekolah Menengah Pertama</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_smp')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_smp" style="background-color: white;" name="jumlah_penduduk_smp" placeholder="Jumlah Penduduk Menempuh SMP" value="<?= esc(old('jumlah_penduduk_smp', $tb_desa['jumlah_penduduk_smp']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_smp'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_sma_smk" class="col-form-label">Jumlah Penduduk Menempuh SMA / SMK</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_sma_smk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_sma_smk" style="background-color: white;" name="jumlah_penduduk_sma_smk" placeholder="Jumlah Penduduk Menempuh SMA / SMK" value="<?= esc(old('jumlah_penduduk_sma_smk', $tb_desa['jumlah_penduduk_sma_smk']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_sma_smk'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label for="jumlah_penduduk_diploma_sarjana" class="col-form-label">Jumlah Penduduk Menempuh Diploma Sarjana</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_diploma_sarjana')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_diploma_sarjana" style="background-color: white;" name="jumlah_penduduk_diploma_sarjana" placeholder="Jumlah Penduduk Menempuh Diploma Sarjana" value="<?= esc(old('jumlah_penduduk_diploma_sarjana', $tb_desa['jumlah_penduduk_diploma_sarjana']), 'html'); ?>">
                                        <span class="input-group-text">Jiwa</span>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('jumlah_penduduk_diploma_sarjana'), 'html'); ?>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-form-label" style="font-size: 20px; text-align: center; display: block;">- B2. Pekerjaan -</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_bekerja" class="col-form-label">Jumlah Penduduk Bekerja</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_bekerja')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_bekerja" style="background-color: white;" name="jumlah_penduduk_bekerja" placeholder="Jumlah Penduduk Tidak Menganggur" value="<?= esc(old('jumlah_penduduk_bekerja', $tb_desa['jumlah_penduduk_bekerja']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_bekerja'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_tidak_bekerja" class="col-form-label">Jumlah Penduduk Tidak Bekerja (Menganggur)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_tidak_bekerja')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_tidak_bekerja" style="background-color: white;" name="jumlah_penduduk_tidak_bekerja" placeholder="Jumlah Penduduk Menganggur" value="<?= esc(old('jumlah_penduduk_tidak_bekerja', $tb_desa['jumlah_penduduk_tidak_bekerja']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_tidak_bekerja'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <label class="col-form-label" style="font-size: 20px; text-align: center; display: block;">- B3. Pernikahan -</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk_menikah" class="col-form-label">Jumlah Penduduk Sudah Menikah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_menikah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_menikah" style="background-color: white;" name="jumlah_penduduk_menikah" placeholder="Jumlah Penduduk Sudah Menikah" value="<?= esc(old('jumlah_penduduk_menikah', $tb_desa['jumlah_penduduk_menikah']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_menikah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_belum_menikah" class="col-form-label">Jumlah Penduduk Belum Menikah (Lajang)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_belum_menikah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_belum_menikah" style="background-color: white;" name="jumlah_penduduk_belum_menikah" placeholder="Jumlah Penduduk Masih Lajang" value="<?= esc(old('jumlah_penduduk_belum_menikah', $tb_desa['jumlah_penduduk_belum_menikah']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_belum_menikah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mb-3">
                                    <label for="jumlah_penduduk_cerai" class="col-form-label">Jumlah Penduduk Cerai</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <input type="number" class="form-control <?= ($validation->hasError('jumlah_penduduk_cerai')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_cerai" style="background-color: white;" name="jumlah_penduduk_cerai" placeholder="Jumlah Penduduk Cerai" value="<?= esc(old('jumlah_penduduk_cerai', $tb_desa['jumlah_penduduk_cerai']), 'html'); ?>">
                                        <span class="input-group-text">Jiwa</span>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('jumlah_penduduk_cerai'), 'html'); ?>
                                        </div>
                                    </div>
                                    <hr style="border: 1px solid #ccc; margin-top: 20px; margin-bottom: 20px;">
                                </div>

                                <label class="col-form-label" style="font-size: 25px;">C. Infrastruktur dan Layanan Umum</label>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_sekolah" class="col-form-label">Jumlah Sekolah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_sekolah')) ? 'is-invalid' : ''; ?>" id="jumlah_sekolah" style="background-color: white;" name="jumlah_sekolah" placeholder="Jumlah Sekolah" value="<?= esc(old('jumlah_sekolah', $tb_desa['jumlah_sekolah']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_sekolah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_tempat_ibadah" class="col-form-label">Jumlah Tempat Ibadah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_tempat_ibadah')) ? 'is-invalid' : ''; ?>" id="jumlah_tempat_ibadah" style="background-color: white;" name="jumlah_tempat_ibadah" placeholder="Jumlah Tempat Ibadah" value="<?= esc(old('jumlah_tempat_ibadah', $tb_desa['jumlah_tempat_ibadah']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_tempat_ibadah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_posyandu" class="col-form-label">Jumlah Posyandu</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_posyandu')) ? 'is-invalid' : ''; ?>" id="jumlah_posyandu" style="background-color: white;" name="jumlah_posyandu" placeholder="Jumlah Posyandu" value="<?= esc(old('jumlah_posyandu', $tb_desa['jumlah_posyandu']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_posyandu'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_pos_ronda" class="col-form-label">Jumlah Pos Ronda</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="number" class="form-control <?= ($validation->hasError('jumlah_pos_ronda')) ? 'is-invalid' : ''; ?>" id="jumlah_pos_ronda" style="background-color: white;" name="jumlah_pos_ronda" placeholder="Jumlah Pos Ronda" value="<?= esc(old('jumlah_pos_ronda', $tb_desa['jumlah_pos_ronda']), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_pos_ronda'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('admin/desa/cek_data/' . $tb_desa['id_desa']), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" style="background-color: #28527A; color: white;">Ubah Data</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->include('admin/layouts/footer') ?>
<!-- end main content-->

<?= $this->include('admin/layouts/script2') ?>

<!-- autofocus input edit langsung kebelakang kata -->
<script>
    window.addEventListener('DOMContentLoaded', function() {
        var inputJudul = document.getElementById('nama_desa');

        // Fungsi untuk mengatur fokus ke posisi akhir input
        function setFocusToEnd(element) {
            element.focus();
            var val = element.value;
            element.value = ''; // kosongkan nilai input
            element.value = val; // isi kembali nilai input untuk memindahkan fokus ke posisi akhir
        }

        // Panggil fungsi setFocusToEnd setelah DOM selesai dimuat
        setFocusToEnd(inputJudul);
    });
</script>
<!-- end autofocus input edit langsung kebelakang kata -->