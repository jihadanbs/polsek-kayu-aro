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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Gambar Slider</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Slider Beranda</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Gambar Slider</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Gambar Slider</h2>
                            <form action="/admin/slider/update/<?= $tb_slider_beranda['id_slider_beranda']; ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <!-- dengan id tersebut -> kategori -> judul  2x cek-->
                                <input type="hidden" name="_method" value="PUT">
                                <?= csrf_field(); ?>

                                <div class="mb-3">
                                    <label for="gambar_slider" class="col-form-label">File</label>
                                    <input type="file" accept="image/*" class="form-control" id="gambar_slider" name="gambar_slider" style="background-color: white;" <?= (old('gambar_slider')) ? 'disabled' : 'required'; ?>>
                                    <!-- Tampilkan nama file yang telah diunggah -->
                                    <?php if (!empty($tb_slider_beranda['gambar_slider'])) : ?>
                                        <p>File exists: <?= $tb_slider_beranda['gambar_slider'] ?></p>
                                        <input type="hidden" name="old_gambar_slider" value="<?= $tb_slider_beranda['gambar_slider']; ?>">
                                    <?php endif; ?>
                                </div>
                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="/admin/slider" class="btn btn-secondary btn-md ml-3">
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