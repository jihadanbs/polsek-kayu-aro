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

                            <form action="<?= esc(site_url('admin/desa/save'), 'attr') ?>" method="post" enctype="multipart/form-data" novalidate>
                                <?= csrf_field(); ?>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_desa" class="col-form-label">Nama Desa :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_desa')) ? 'is-invalid' : ''; ?>" id="nama_desa" name="nama_desa" placeholder="Masukkan Nama Desa" style="background-color: white;" value="<?= esc(old('nama_desa'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nama_desa'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kecamatan" class="col-form-label">Kecamatan :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kecamatan')) ? 'is-invalid' : ''; ?>" id="kecamatan" name="kecamatan" placeholder="Masukkan Kecamatan Dari Desa Ini" style="background-color: white;" value="<?= esc(old('kecamatan'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kecamatan'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="kabupaten" class="col-form-label">Kabupaten :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" id="kabupaten" name="kabupaten" placeholder="Masukkan Kabupaten dari Desa Ini" style="background-color: white;" value="<?= esc(old('kabupaten'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kabupaten'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi" class="col-form-label">Provinsi :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('provinsi')) ? 'is-invalid' : ''; ?>" id="provinsi" name="provinsi" placeholder="Masukkan Provinsi Dari Desa Ini" style="background-color: white;" value="<?= esc(old('provinsi'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('provinsi'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="kode_pos" class="col-form-label">Kode Pos :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" id="kode_pos" name="kode_pos" placeholder="Masukkan Kode Pos dari Desa Ini" style="background-color: white;" value="<?= esc(old('kode_pos'), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kode_pos'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="luas_wilayah" class="col-form-label">Luas Wilayah :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('luas_wilayah')) ? 'is-invalid' : ''; ?>" id="luas_wilayah" name="luas_wilayah" placeholder="Masukkan Luas Wilayah Dari Desa Ini" style="background-color: white;" value="<?= esc(old('luas_wilayah'), 'html'); ?>">
                                            <small class="form-text text-muted">Satuan Luas Wilayah Dinyatakan Dengan Satuan Hektar (ha)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('luas_wilayah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk" class="col-form-label">Jumlah Penduduk:</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('jumlah_penduduk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk" name="jumlah_penduduk" placeholder="Masukkan Jumlah Penduduk dari Desa Ini" style="background-color: white;" value="<?= esc(old('jumlah_penduduk'), 'html'); ?>">
                                            <small class="form-text text-muted">Satuan Jumlah Penduduk Dinyatakan Dengan Satuan (Jiwa)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="website" class="col-form-label">Website :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : ''; ?>" id="website" name="website" placeholder="Masukkan Website Dari Desa Ini" style="background-color: white;" value="<?= esc(old('website'), 'html'); ?>">
                                            <small class="form-text text-muted">Jika Desa Tidak Memiliki Website Kosongkan Saja</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('website'), 'html'); ?>
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