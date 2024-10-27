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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Foto</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Galeri</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Foto</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Foto</h2>

                            <form action="<?= esc(site_url('admin/galeri/update/' . urlencode($tb_foto['id_foto'])), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="slug" value="<?= esc($tb_foto['slug'], 'attr'); ?>">
                                <input type="hidden" name="file_foto" value="<?= esc($tb_foto['file_foto'], 'attr'); ?>">

                                <div class="mb-3">
                                    <label for="judul_foto" class="col-form-label">Judul Foto</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('judul_foto')) ? 'is-invalid' : ''; ?>" id="judul_foto" style="background-color: white;" placeholder="Masukkan Judul Foto" name="judul_foto" value="<?= esc(old('judul_foto', $tb_foto['judul_foto']), 'attr'); ?>" autocomplete="off">
                                        <small class="form-text text-muted">Judul Singkat Saja Maksimal 2-3 Kalimat. Cth: Kegiatan Warga Kerinci, Jambi</small>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('judul_foto'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="deskripsi" class="col-form-label">Deskripsi</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Deskripsi" name="deskripsi" autocomplete="off"><?= esc(old('deskripsi', $tb_foto['deskripsi']), 'attr'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('deskripsi'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="file_foto" class="col-form-label">File Foto</label><span style="color: red;">*</span>
                                        <input type="file" accept="image/*" class="form-control custom-border" id="file_foto" name="file_foto[]" style="background-color: white;" <?= (old('file_foto')) ? 'disabled' : 'required'; ?> multiple>
                                        <small class="form-text text-muted">
                                            <span style="color: blue;">NOTE : Untuk Menginputkan 3 Foto atau Lebih Anda Dapat Menggunakan CTRL Pada Keyboard Lalu<span style="color: red;"> TAHAN CTRL nya </span> Sambil Pilih Gambar yang Dimau Lalu Klik Kiri pada MOUSE ataupun TOUCHPAD (CTRL Masih Tetap Ditahan Ya!). Lakukan Hal Yang Sama Untuk Memilih Foto Lainnya.</span>
                                        </small>
                                        <?php if (!empty($tb_foto['file_foto'])) : ?>
                                            <input type="hidden" name="old_file_foto" value="<?= esc($tb_foto['file_foto'], 'attr'); ?>">
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_foto" class="col-form-label">Tanggal Ubah Upload Foto</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control <?= ($validation->hasError('tanggal_foto')) ? 'is-invalid' : ''; ?>" id="tanggal_foto" style="background-color: white;" name="tanggal_foto" value="<?= esc(old('tanggal_foto', $tb_foto['tanggal_foto']), 'attr'); ?>">
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('tanggal_foto'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('admin/galeri/cek_data/' . urlencode($tb_foto['id_foto'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
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
        var inputJudul = document.getElementById('judul_foto');

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