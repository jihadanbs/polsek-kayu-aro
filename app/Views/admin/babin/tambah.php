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
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Data Bhabin</a></li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Bhabin Polsek Kayu Aro</h2>

                            <form action="<?= esc(site_url('/admin/babin/save'), 'attr'); ?>" method="POST" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="col-form-label">Nama Lengkap</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" autofocus name="nama_lengkap" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" value="<?= esc(old('nama_lengkap'), 'attr'); ?>">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('nama_lengkap'), 'html'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nrp" class="col-form-label">NRP (Nomor Registrasi Pokok)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nrp')) ? 'is-invalid' : ''; ?>" id="nrp" name="nrp" placeholder="Masukkan NRP Anda" style="background-color: white;" value="<?= esc(old('nrp'), 'attr'); ?>" required>
                                            <small class="form-text text-muted">Cek Kembali NRP Anda</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nrp'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="pangkat" class="col-form-label">Pangkat</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('pangkat')) ? 'is-invalid' : ''; ?>" id="pangkat" name="pangkat" placeholder="Masukkan Pangkat Anda" style="background-color: white;" value="<?= esc(old('pangkat'), 'attr'); ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('pangkat'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jabatan" class="col-form-label">Jabatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan Anda" style="background-color: white;" value="<?= esc(old('jabatan'), 'attr'); ?>" required>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jabatan'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Aktif Anda (Cth : 0812345678)" style="background-color: white;" value="<?= esc(old('no_telepon'), 'attr'); ?>">
                                            <small class="form-text text-muted">Pastikan Nomor Telepon Anda Aktif (Bisa No HP / Whatsapp)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('no_telepon'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" required name="alamat" placeholder="Masukkan Alamat Lengkap Anda" id="alamat" cols="30" rows="5" style="background-color: white;"><?= esc(old('alamat'), 'html'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('alamat'), 'html'); ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="email" class="col-form-label">Email</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" value="<?= esc(old('email'), 'attr'); ?>">
                                            <small class="form-text text-muted">Pastikan Email Anda Aktif</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('email'), 'html'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_mulai_tugas" class="col-form-label">Tanggal Mulai Tugas</label><span style="color: red;">*</span>
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_mulai_tugas')) ? 'is-invalid' : ''; ?>" name="tanggal_mulai_tugas" id="tanggal_mulai_tugas" style="background-color: white;" value="<?= esc(old('tanggal_mulai_tugas'), 'attr'); ?>">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('tanggal_mulai_tugas'), 'html'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="col-form-label">Upload Foto</label><span style="color: red;">*</span>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" style="background-color: white;" <?= (old('foto')) ? 'disabled' : 'required'; ?>>
                                    <small class="form-text text-muted">Pastikan Foto Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('foto'), 'html'); ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                    <small class="form-text text-muted"> (Dapat Memilih Banyak Desa)</small>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php foreach ($tb_desa as $index => $value) : ?>
                                                <?php if ($index > 0 && $index % 6 == 0) : ?>
                                        </div>
                                        <div class="row">
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input <?= ($validation->hasError('id_desa')) ? 'is-invalid' : ''; ?>" type="checkbox" id="id_desa_<?= esc($value['id_desa'], 'attr'); ?>" name="id_desa[]" value="<?= esc($value['id_desa'], 'attr'); ?>" <?= in_array($value['id_desa'], old('id_desa', [])) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="id_desa_<?= esc($value['id_desa'], 'attr'); ?>">
                                                    <?= esc($value['nama_desa'], 'html'); ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('id_desa'), 'html'); ?>
                                        </div>
                                        <p id="selected-count">Jumlah Desa yang Dipilih: <span id="count">0</span></p>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= esc(site_url('/admin/babin'), 'attr'); ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-times"></i> Batal Tambah
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color: white; margin-left: 10px;"><i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah Data Babin</button>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Ambil elemen select
        var selectElement = document.getElementById('id_desa');

        // Event listener untuk memantau perubahan pada elemen select
        selectElement.addEventListener('click', function(event) {
            // Jika opsi yang dipilih tidak memiliki atribut selected, tambahkan atribut selected
            if (!event.target.hasAttribute('selected')) {
                event.target.setAttribute('selected', '');
            } else {
                // Jika opsi yang dipilih memiliki atribut selected, hapus atribut selected
                event.target.removeAttribute('selected');
            }
        });
    });
</script>

<script>
    // Ambil semua checkbox dengan nama "id_desa[]"
    const checkboxes = document.querySelectorAll('input[name="id_desa[]"]');

    // Inisialisasi jumlah desa yang dipilih
    let selectedCount = 0;

    // Event listener untuk setiap checkbox
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                selectedCount++; // Jika checkbox diceklis, tambahkan 1 ke jumlah desa yang dipilih
            } else {
                selectedCount--; // Jika checkbox tidak diceklis, kurangi 1 dari jumlah desa yang dipilih
            }
            document.getElementById('count').innerText = selectedCount; // Update tampilan jumlah desa yang dipilih
        });
    });
</script>