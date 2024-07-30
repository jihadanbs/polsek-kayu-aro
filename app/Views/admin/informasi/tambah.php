<?= $this->include('admin/layouts/script') ?>

<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
    }

    .form-check {
        margin-bottom: 10px;
    }
</style>

<!-- saya nonaktifkan agar agar side bar tidak dapat di klik sembarangan -->
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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Informasi Edukasi</a></li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Informasi Edukasi</h2>

                            <form action="<?= esc(site_url('admin/informasi/save'), 'attr') ?>" method="POST" enctype="multipart/form-data" id="validationForm" novalidate>
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="judul" class="col-form-label">Judul :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" placeholder="Masukkan Judul Informasi-Edukasi" style="background-color: white;" value="<?= esc(old('judul'), 'attr') ?>" required>
                                            <small class="form-text text-muted">Cek Kembali Judul Anda</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('judul'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_diterbitkan" class="col-form-label">Tanggal Diterbitkan :</label>
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_diterbitkan')) ? 'is-invalid' : ''; ?>" name="tanggal_diterbitkan" id="tanggal_diterbitkan" style="background-color: white;" value="<?= esc(old('tanggal_diterbitkan'), 'attr') ?>" required>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('tanggal_diterbitkan'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="konten" class="col-form-label">Isi Konten :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('konten')) ? 'is-invalid' : ''; ?>" required name="konten" placeholder="Masukkan Deskripsi Isi Konten Anda" id="konten" cols="30" rows="5" style="background-color: white;"><?php echo esc(old('konten'), 'html'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('konten'), 'html') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="penulis" class="col-form-label">Penulis :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" placeholder="Masukkan Penulis Konten" style="background-color: white;" value="<?= esc(old('penulis'), 'attr') ?>" required>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('penulis'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_informasi" class="col-form-label">Nama Kategori Informasi :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_informasi')) ? 'is-invalid' : ''; ?>" id="id_kategori_informasi" name="id_kategori_informasi" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Kategori Informasi ~</option>
                                            <!-- Populasi opsi dropdown dengan data dari controller -->
                                            <?php foreach ($tb_kategori_informasi as $value) : ?>
                                                <option value="<?= esc($value['id_kategori_informasi'], 'attr') ?>" <?= old('id_kategori_informasi') == $value['id_kategori_informasi'] ? 'selected' : ''; ?>>
                                                    <?= esc($value['nama_kategori'], 'html') ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('id_kategori_informasi'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="profile_penulis" class="col-form-label">Foto Profile Penulis :</label>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('profile_penulis')) ? 'is-invalid' : ''; ?>" id="profile_penulis" name="profile_penulis" style="background-color: white;" <?= (old('profile_penulis')) ? 'disabled' : 'required'; ?> onchange="previewImage(event)">
                                    <small class="form-text text-muted">Pastikan Foto Profile Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <br>
                                    <img id="preview" src="#" alt="Pratinjau profile_penulis" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;">
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('profile_penulis'), 'html') ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="col-form-label">Upload Gambar :</label>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" style="background-color: white;" <?= (old('gambar')) ? 'disabled' : 'required'; ?> onchange="previewImage(event)">
                                    <small class="form-text text-muted">Pastikan Gambar Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <br>
                                    <img id="preview" src="#" alt="Pratinjau Gambar" style="display: none; max-width: 200px; max-height: 200px; margin-top: 10px;">
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('gambar'), 'html') ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= esc(site_url('admin/informasi'), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color:white; margin-left: 10px;">Tambah</button>
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

<!-- script menampilkan gambar setelah di inputkan -->
<script>
    function previewImage(event) {
        var input = event.target;
        var reader = new FileReader();

        reader.onload = function() {
            var dataURL = reader.result;
            var preview = document.getElementById('preview');
            preview.src = dataURL;
            preview.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    }
</script>
<!-- end script -->