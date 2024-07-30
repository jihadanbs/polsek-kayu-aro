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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Formulir Cek Data</a></li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Informasi-Edukasi</h2>

                            <form action="<?= esc(site_url('/admin/informasi/update/' . $tb_informasi_edukasi['id_informasi']), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate>
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="judul" class="col-form-label">Judul :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" autofocus name="judul" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" value="<?= esc(old('judul', $tb_informasi_edukasi['judul']), 'attr') ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('judul'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="id_kategori_informasi" class="col-form-label">Kategori Informasi :</label>
                                        <select class="form-select custom-border <?= ($validation->hasError('id_kategori_informasi')) ? 'is-invalid' : ''; ?>" id="id_kategori_informasi" name="id_kategori_informasi" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>Silahkan Pilih Nama Kategori Informasi --</option>
                                            <?php foreach ($tb_kategori_informasi as $value) : ?>
                                                <?php $selected = ($value['id_kategori_informasi'] == old('id_kategori_informasi', $tb_informasi_edukasi['id_kategori_informasi'])) ? 'selected' : ''; ?>
                                                <option value="<?= esc($value['id_kategori_informasi'], 'attr') ?>" <?= esc($selected, 'attr') ?>><?= esc($value['nama_kategori'], 'html') ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('id_kategori_informasi'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="penulis" class="col-form-label">Penulis :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" placeholder="Masukkan Nama Si Penulis" style="background-color: white;" value="<?= esc(old('penulis', $tb_informasi_edukasi['penulis']), 'attr') ?>" required>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('penulis'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_diterbitkan" class="col-form-label">Tanggal Diterbitkan :</label>
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_diterbitkan')) ? 'is-invalid' : ''; ?>" name="tanggal_diterbitkan" id="tanggal_diterbitkan" value="<?= esc(old('tanggal_diterbitkan', $tb_informasi_edukasi['tanggal_diterbitkan']), 'attr') ?>" style="background-color: white;">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('tanggal_diterbitkan'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="konten" class="col-form-label">Isi Konten :</label>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('konten')) ? 'is-invalid' : ''; ?>" name="konten" placeholder="Masukkan Isi konten Lengkap Anda" id="konten" cols="30" rows="5" style="background-color: white;"><?= esc(old('konten', $tb_informasi_edukasi['konten']), 'html') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('konten'), 'html') ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="profile_penulis" class="col-form-label">Profile Penulis :</label>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('profile_penulis')) ? 'is-invalid' : ''; ?>" id="profile_penulis" name="profile_penulis" style="background-color: white;">
                                    <input type="hidden" name="current_profile_penulis" value="<?= esc(old('current_profile_penulis', $tb_informasi_edukasi['profile_penulis']), 'attr') ?>">
                                    <small class="form-text text-muted">Pastikan Foto Profile Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <?php if (old('current_profile_penulis', $tb_informasi_edukasi['profile_penulis'])) : ?>
                                        <div class="mt-2">
                                            <p>profile_penulis saat ini: <?= esc(old('current_profile_penulis', $tb_informasi_edukasi['profile_penulis']), 'html') ?></p>
                                            <img src="<?= esc(base_url($tb_informasi_edukasi['profile_penulis']), 'attr') ?>" alt="Current Photo" style="max-width: 150px; max-height: 150px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('profile_penulis'), 'html') ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="gambar" class="col-form-label">Gambar :</label>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" style="background-color: white;">
                                    <input type="hidden" name="current_gambar" value="<?= esc(old('current_gambar', $tb_informasi_edukasi['gambar']), 'attr') ?>">
                                    <small class="form-text text-muted">Pastikan gambar Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <?php if (old('current_gambar', $tb_informasi_edukasi['gambar'])) : ?>
                                        <div class="mt-2">
                                            <p>Gambar saat ini: <?= esc(old('current_gambar', $tb_informasi_edukasi['gambar']), 'html') ?></p>
                                            <img src="<?= esc(base_url($tb_informasi_edukasi['gambar']), 'attr') ?>" alt="Current Photo" style="max-width: 150px; max-height: 150px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('gambar'), 'html') ?>
                                    </div>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('/admin/informasi/cek_data/' . $tb_informasi_edukasi['slug']), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-arrow-left"></i> Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary ">Ubah Data</button>
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
        var inputJudul = document.getElementById('judul');

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