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

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_desa" class="col-form-label">Nama Desa :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nama_desa')) ? 'is-invalid' : ''; ?>" id="nama_desa" style="background-color: white;" name="nama_desa" placeholder="Masukkan Nama Desa" value="<?= esc(old('nama_desa', $tb_desa['nama_desa']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nama_desa'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="kecamatan" class="col-form-label">Kecamatan :</label>
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
                                        <label for="kabupaten" class="col-form-label">Kabupaten :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kabupaten')) ? 'is-invalid' : ''; ?>" id="kabupaten" style="background-color: white;" name="kabupaten" placeholder="Masukkan Kabupaten Desa Ini" value="<?= esc(old('kabupaten', $tb_desa['kabupaten']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kabupaten'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="provinsi" class="col-form-label">Provinsi :</label>
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
                                        <label for="kode_pos" class="col-form-label">Kode Pos :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" id="kode_pos" style="background-color: white;" name="kode_pos" placeholder="Masukkan Kode Pos Desa Ini" value="<?= esc(old('kode_pos', $tb_desa['kode_pos']), 'html'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('kode_pos'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="luas_wilayah" class="col-form-label">Luas Wilayah :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('luas_wilayah')) ? 'is-invalid' : ''; ?>" id="luas_wilayah" style="background-color: white;" name="luas_wilayah" placeholder="Masukkan Luas Wilayah Desa Ini" value="<?= esc(old('luas_wilayah', $tb_desa['luas_wilayah']), 'html'); ?>">
                                            <small class="form-text text-muted">Satuan Luas Wilayah Dinyatakan Dengan Satuan Hektar (ha)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('luas_wilayah'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jumlah_penduduk" class="col-form-label">Jumlah Penduduk :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('jumlah_penduduk')) ? 'is-invalid' : ''; ?>" id="jumlah_penduduk" style="background-color: white;" name="jumlah_penduduk" placeholder="Masukkan Jumlah Penduduk Desa Ini" value="<?= esc(old('jumlah_penduduk', $tb_desa['jumlah_penduduk']), 'html'); ?>">
                                            <small class="form-text text-muted">Satuan Jumlah Penduduk Dinyatakan Dengan Satuan (Jiwa)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jumlah_penduduk'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="website" class="col-form-label">Website :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('website')) ? 'is-invalid' : ''; ?>" id="website" style="background-color: white;" name="website" placeholder="Masukkan Website Desa Ini" value="<?= esc(old('website', $tb_desa['website']), 'html'); ?>">
                                            <small class="form-text text-muted">Jika Desa Tidak Memiliki Website Kosongkan Saja</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('website'), 'html'); ?>
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