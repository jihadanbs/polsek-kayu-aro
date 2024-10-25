<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }
</style>

<!-- saya nonaktifkan agar side bar tidak dapat di klik sembarangan -->
<div style="pointer-events: none;">
    <?= $this->include('admin/layouts/navbar') ?>
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Data Desa</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Desa</h2>

                            <form action="<?= esc(site_url('admin/desa/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate autocomplete="off" onsubmit="cleanInput()">
                                <?= csrf_field(); ?>

                                <label class="col-form-label" style="font-size: 25px;">A. Data Umum Desa</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_desa" class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_desa')) ? 'is-invalid' : ''; ?>" id="nama_desa" name="nama_desa" placeholder="Nama Desa" style="background-color: white;" value="<?= esc(old('nama_desa'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nama_desa'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kecamatan" class="col-form-label">Kecamatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" placeholder="Kecamatan" style="background-color: white;" value="<?= esc(old('kecamatan'), 'html'); ?>">
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
                                            <input type="text" class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" id="kabupaten" name="kabupaten" placeholder="Kabupaten" style="background-color: white;" value="<?= esc(old('kabupaten'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kabupaten'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi" class="col-form-label">Provinsi</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" id="provinsi" name="provinsi" placeholder="Provinsi" style="background-color: white;" value="<?= esc(old('provinsi'), 'html'); ?>">
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
                                            <input type="number" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" id="kode_pos" name="kode_pos" placeholder="Kode Pos" style="background-color: white;" value="<?= esc(old('kode_pos'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kode_pos'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="luas_wilayah" class="col-form-label">Luas Wilayah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('luas_wilayah')) ? 'is-invalid' : ''; ?>" id="luas_wilayah" name="luas_wilayah" placeholder="Luas Wilayah" style="background-color: white;" value="<?= esc(old('luas_wilayah'), 'html'); ?>">
                                            <span class="input-group-text">Hektar (ha)</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('luas_wilayah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-mb-3">
                                    <label for="website" class="col-form-label">Website</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <span class="input-group-text">https:</span>
                                        <input type="text" class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : ''; ?>" id="website" name="website" placeholder="Website" style="background-color: white;" value="<?= esc(old('website'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk" name="jumlah_penduduk" placeholder="Jumlah Penduduk" style="background-color: white;" value="<?= esc(old('jumlah_penduduk'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_kepala_keluarga" class="col-form-label">Jumlah Kepala Keluarga</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_kepala_keluarga')) ? 'is-invalid' : ''; ?>" id="jumlah_kepala_keluarga" name="jumlah_kepala_keluarga" placeholder="Jumlah Kepala Keluarga" style="background-color: white;" value="<?= esc(old('jumlah_kepala_keluarga'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_pria')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_pria" name="jumlah_penduduk_pria" placeholder="Jumlah Penduduk Pria" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_pria'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_pria'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_wanita" class="col-form-label">Jumlah Penduduk Wanita</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_wanita')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_wanita" name="jumlah_penduduk_wanita" placeholder="Jumlah Penduduk Wanita" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_wanita'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_0_14')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_0_14" name="jumlah_penduduk_usia_0_14" placeholder="Jumlah Penduduk Usia 0 - 14th" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_usia_0_14'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_usia_0_14'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_usia_15_64" class="col-form-label">Jumlah Penduduk Usia 15 - 64th</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_15_64')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_15_64" name="jumlah_penduduk_usia_15_64" placeholder="Jumlah Penduduk Usia 15 - 64th" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_usia_15_64'), 'html'); ?>">
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
                                        <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_usia_65_keatas')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_usia_65_keatas" name="jumlah_penduduk_usia_65_keatas" placeholder="Jumlah Penduduk Usia 65th ke Atas" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_usia_65_keatas'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_tidak_sekolah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_tidak_sekolah" name="jumlah_penduduk_tidak_sekolah" placeholder="Jumlah Penduduk Tidak Sekolah" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_tidak_sekolah'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_tidak_sekolah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_sd" class="col-form-label">Jumlah Penduduk Menempuh Sekolah Dasar</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_sd')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_sd" name="jumlah_penduduk_sd" placeholder="Jumlah Penduduk Menempuh Sekolah Dasar" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_sd'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_smp')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_smp" name="jumlah_penduduk_smp" placeholder="Jumlah Penduduk Menempuh SMP" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_smp'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_smp'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_sma_smk" class="col-form-label">Jumlah Penduduk Menempuh SMA / SMK</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_sma_smk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_sma_smk" name="jumlah_penduduk_sma_smk" placeholder="Jumlah Penduduk Menempuh SMA / SMK" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_sma_smk'), 'html'); ?>">
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
                                        <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_diploma_sarjana')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_diploma_sarjana" name="jumlah_penduduk_diploma_sarjana" placeholder="Jumlah Penduduk Menempuh Diploma Sarjana" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_diploma_sarjana'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_bekerja')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_bekerja" name="jumlah_penduduk_bekerja" placeholder="Jumlah Penduduk Tidak Menganggur" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_bekerja'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_bekerja'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_tidak_bekerja" class="col-form-label">Jumlah Penduduk Tidak Bekerja (Menganggur)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_tidak_bekerja')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_tidak_bekerja" name="jumlah_penduduk_tidak_bekerja" placeholder="Jumlah Penduduk Menganggur" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_tidak_bekerja'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_menikah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_menikah" name="jumlah_penduduk_menikah" placeholder="Jumlah Penduduk Sudah Menikah" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_menikah'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_menikah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_penduduk_belum_menikah" class="col-form-label">Jumlah Penduduk Belum Menikah (Lajang)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_belum_menikah')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_belum_menikah" name="jumlah_penduduk_belum_menikah" placeholder="Jumlah Penduduk Masih Lajang" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_belum_menikah'), 'html'); ?>">
                                            <span class="input-group-text">Jiwa</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk_belum_menikah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-mb-3">
                                    <label for="jumlah_penduduk_cerai" class="col-form-label">Jumlah Penduduk Cerai</label><span style="color: red;">*</span>
                                    <div class="col-sm-12 input-group">
                                        <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_penduduk_cerai')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk_cerai" name="jumlah_penduduk_cerai" placeholder="Jumlah Penduduk Cerai" style="background-color: white;" value="<?= esc(old('jumlah_penduduk_cerai'), 'html'); ?>">
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_sekolah')) ? 'is-invalid' : ''; ?>" id="jumlah_sekolah" name="jumlah_sekolah" placeholder="Jumlah Sekolah" style="background-color: white;" value="<?= esc(old('jumlah_sekolah'), 'html'); ?>">
                                            <span class="input-group-text">Unit</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_sekolah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_tempat_ibadah" class="col-form-label">Jumlah Tempat Ibadah</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_tempat_ibadah')) ? 'is-invalid' : ''; ?>" id="jumlah_tempat_ibadah" name="jumlah_tempat_ibadah" placeholder="Jumlah Tempat Ibadah" style="background-color: white;" value="<?= esc(old('jumlah_tempat_ibadah'), 'html'); ?>">
                                            <span class="input-group-text">Unit</span>
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
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_posyandu')) ? 'is-invalid' : ''; ?>" id="jumlah_posyandu" name="jumlah_posyandu" placeholder="Jumlah Posyandu" style="background-color: white;" value="<?= esc(old('jumlah_posyandu'), 'html'); ?>">
                                            <span class="input-group-text">Unit</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_posyandu'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jumlah_pos_ronda" class="col-form-label">Jumlah Pos Ronda</label><span style="color: red;">*</span>
                                        <div class="col-sm-12 input-group">
                                            <input type="text" oninput="formatNumber(this)" class="form-control <?= ($validation->hasError('jumlah_pos_ronda')) ? 'is-invalid' : ''; ?>" id="jumlah_pos_ronda" name="jumlah_pos_ronda" placeholder="Jumlah Pos Ronda" style="background-color: white;" value="<?= esc(old('jumlah_pos_ronda'), 'html'); ?>">
                                            <span class="input-group-text">Unit</span>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_pos_ronda'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= esc(site_url('admin/desa'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color: white; margin-left: 10px;">Tambah</button>
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

<script>
    function formatNumber(input) {
        // Menghapus semua karakter non-digit
        let value = input.value.replace(/\D/g, '');

        // Menambahkan titik ribuan
        if (value) {
            input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    function cleanInput() {
        // Daftar ID input yang perlu dibersihkan titiknya
        const inputFields = ['luas_wilayah', 'jumlah_penduduk', 'jumlah_kepala_keluarga', 'jumlah_penduduk_pria', 'jumlah_penduduk_wanita', 'jumlah_penduduk_usia_0_14', 'jumlah_penduduk_usia_15_64', 'jumlah_penduduk_usia_65_keatas', 'jumlah_penduduk_tidak_sekolah', 'jumlah_penduduk_sd', 'jumlah_penduduk_smp', 'jumlah_penduduk_sma_smk', 'jumlah_penduduk_diploma_sarjana', 'jumlah_penduduk_bekerja', 'jumlah_penduduk_tidak_bekerja', 'jumlah_penduduk_belum_menikah', 'jumlah_penduduk_menikah', 'jumlah_penduduk_cerai', 'jumlah_sekolah', 'jumlah_posyandu', 'jumlah_tempat_ibadah', 'jumlah_pos_ronda'];

        inputFields.forEach(function(fieldId) {
            const inputField = document.getElementById(fieldId);
            if (inputField) {
                // Menghapus titik pemisah ribuan sebelum form disubmit
                inputField.value = inputField.value.replace(/\./g, '');
            }
        });
    }
</script>