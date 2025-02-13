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
                            <h2 class="text-center mb-4">Formulir Ubah Data Bhabin</h2>

                            <form action="<?= esc(site_url('/admin/babin/update/' . $tb_babin['id_babin']), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field() ?>

                                <div class="mb-3">
                                    <label for="nama_lengkap" class="col-form-label">Nama Lengkap</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control <?= ($validation->hasError('nama_lengkap')) ? 'is-invalid' : ''; ?>" id="nama_lengkap" autofocus name="nama_lengkap" placeholder="Masukkan Nama Lengkap Anda" style="background-color: white;" value="<?= esc(old('nama_lengkap', $tb_babin['nama_lengkap']), 'html') ?>">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('nama_lengkap'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nrp" class="col-form-label">NRP (Nomor Registrasi Pokok)</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('nrp')) ? 'is-invalid' : ''; ?>" id="nrp" name="nrp" placeholder="Masukkan NRP Anda" style="background-color: white;" value="<?= esc(old('nrp', $tb_babin['nrp']), 'html') ?>" required>
                                            <small class="form-text text-muted">Cek Kembali NRP Anda</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('nrp'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="pangkat" class="col-form-label">Pangkat</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('pangkat')) ? 'is-invalid' : ''; ?>" id="pangkat" name="pangkat" placeholder="Masukkan Pangkat Anda" style="background-color: white;" value="<?= esc(old('pangkat', $tb_babin['pangkat']), 'html') ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('pangkat'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="jabatan" class="col-form-label">Jabatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('jabatan')) ? 'is-invalid' : ''; ?>" id="jabatan" name="jabatan" placeholder="Masukkan Jabatan Anda" style="background-color: white;" value="<?= esc(old('jabatan', $tb_babin['jabatan']), 'html') ?>">
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('jabatan'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="col-form-label">Nomor Telepon</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= ($validation->hasError('no_telepon')) ? 'is-invalid' : ''; ?>" id="no_telepon" name="no_telepon" placeholder="Masukkan Nomor Telepon Aktif Anda (Cth : 0812345678)" style="background-color: white;" value="<?= esc(old('no_telepon', $tb_babin['no_telepon']), 'html') ?>">
                                            <small class="form-text text-muted">Pastikan Nomor Telepon Anda Aktif (Bisa No HP / Whatsapp)</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('no_telepon'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('alamat')) ? 'is-invalid' : ''; ?>" required name="alamat" placeholder="Masukkan Alamat Lengkap Anda" id="alamat" cols="30" rows="5" style="background-color: white;"><?= esc(old('alamat', $tb_babin['alamat']), 'html') ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('alamat'), 'html') ?>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="email" class="col-form-label">Email</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="Masukkan Alamat Email Aktif Anda" style="background-color: white;" value="<?= esc(old('email', $tb_babin['email']), 'html') ?>">
                                            <small class="form-text text-muted">Pastikan Email Anda Aktif</small>
                                            <div class="invalid-feedback">
                                                <?= esc($validation->getError('email'), 'html') ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="tanggal_mulai_tugas" class="col-form-label">Tanggal Mulai Tugas</label><span style="color: red;">*</span>
                                        <input type="date" class="form-control <?= ($validation->hasError('tanggal_mulai_tugas')) ? 'is-invalid' : ''; ?>" name="tanggal_mulai_tugas" id="tanggal_mulai_tugas" value="<?= esc(old('tanggal_mulai_tugas', $tb_babin['tanggal_mulai_tugas']), 'html') ?>" style="background-color: white;">
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('tanggal_mulai_tugas'), 'html') ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="foto" class="col-form-label">Upload Foto</label><span style="color: red;">*</span>
                                    <input type="file" accept="image/*" class="form-control <?= ($validation->hasError('foto')) ? 'is-invalid' : ''; ?>" id="foto" name="foto" style="background-color: white;">
                                    <input type="hidden" name="current_foto" value="<?= esc(old('current_foto', $tb_babin['foto']), 'html') ?>">
                                    <small class="form-text text-muted">Pastikan Foto Yang Diunggah Tidak Lebih Dari 5MB</small>
                                    <?php if (old('current_foto', $tb_babin['foto'])) : ?>
                                        <div class="mt-2">
                                            <p>Foto saat ini: <?= esc(old('current_foto', $tb_babin['foto']), 'html') ?></p>
                                            <img src="<?= esc(base_url($tb_babin['foto']), 'attr') ?>" alt="Current Photo" style="max-width: 150px; max-height: 150px;">
                                        </div>
                                    <?php endif; ?>
                                    <div class="invalid-feedback">
                                        <?= esc($validation->getError('foto'), 'html') ?>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                    <small class="form-text text-muted"> (Dapat Memilih Banyak Desa)</small>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <?php
                                            $oldSelectedDesa = old('id_desa', $selected_desa_ids);
                                            foreach ($tb_desa as $index => $value) :
                                            ?>
                                                <?php if ($index > 0 && $index % 6 == 0) : ?>
                                        </div>
                                        <div class="row">
                                        <?php endif; ?>
                                        <div class="col-md-2">
                                            <div class="form-check">
                                                <input class="form-check-input <?= ($validation->hasError('id_desa')) ? 'is-invalid' : ''; ?>" type="checkbox" id="id_desa_<?= esc($value['id_desa'], 'attr') ?>" name="id_desa[]" value="<?= esc($value['id_desa'], 'attr') ?>" <?= in_array($value['id_desa'], $oldSelectedDesa) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="id_desa_<?= esc($value['id_desa'], 'attr') ?>">
                                                    <?= esc($value['nama_desa'], 'html') ?>
                                                </label>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= esc($validation->getError('id_desa'), 'html') ?>
                                        </div>
                                        <p id="selected-count">Jumlah Desa yang Dipilih: <span id="count">0</span></p>
                                    </div>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('/admin/babin/cek_data/' . $tb_babin['id_babin']), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
                                            <i class="fas fa-times"></i> Batal Ubah
                                        </a>
                                        <button type="submit" class="btn btn-warning btn-md edit"><i class="fas fa-save"></i> Simpan Perubahan Data</button>
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
        var inputJudul = document.getElementById('nama_lengkap');

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

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function updateSelectedCount() {
            const checkedCount = document.querySelectorAll('input[name="id_desa[]"]:checked').length;
            document.getElementById('count').innerText = checkedCount;
        }

        // Update count on page load
        updateSelectedCount();

        // Add event listeners to all checkboxes
        document.querySelectorAll('input[name="id_desa[]"]').forEach((checkbox) => {
            checkbox.addEventListener('change', updateSelectedCount);
        });
    });
</script>