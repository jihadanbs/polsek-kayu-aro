<?= $this->include('admin/layouts/script') ?>

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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data FAQ</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">FAQ</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data FAQ</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data FAQ</h2>
                            <form action="/admin/faq/update/<?= $tb_faq['id_faq']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="pertanyaan" class="col-form-label">Pertanyaan</label><span style="color: red;">*</span>
                                    <textarea class="form-control <?= ($validation->hasError('pertanyaan')) ? 'is-invalid' : ''; ?>" name="pertanyaan" id="pertanyaan" required><?= old('pertanyaan', $tb_faq['pertanyaan']); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('pertanyaan'); ?>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            if (typeof initEditor === 'function') {
                                                initEditor('#pertanyaan');
                                            } else {
                                                console.error('initEditor function is not available.');
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="mb-3">
                                    <label for="jawaban" class="col-form-label">Jawaban</label><span style="color: red;">*</span>
                                    <textarea class="form-control <?= ($validation->hasError('jawaban')) ? 'is-invalid' : ''; ?>" name="jawaban" id="jawaban" required><?= old('jawaban', $tb_faq['jawaban']); ?></textarea>

                                    <!-- Menambahkan div untuk menampilkan pesan validasi -->
                                    <div class="invalid-feedback">
                                        <?= $validation->getError('jawaban'); ?>
                                    </div>
                                    <script>
                                        document.addEventListener('DOMContentLoaded', function() {
                                            if (typeof initEditor === 'function') {
                                                initEditor('#jawaban');
                                            } else {
                                                console.error('initEditor function is not available.');
                                            }
                                        });
                                    </script>
                                </div>

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= site_url('/admin/faq/cek_data/' . $tb_faq['id_faq']); ?>" class="btn btn-secondary btn-md ml-3">
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