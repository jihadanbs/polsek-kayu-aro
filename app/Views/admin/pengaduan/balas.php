<?= $this->include('admin/layouts/script') ?>
<style>
    .separator {
        border-right: 1px solid #ccc;
        height: auto;
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
                        <h4 class="mb-sm-0 font-size-18">Formulir Balas Feedback</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Form Balas Feedback Pengunjung</a></li>
                                <li class="breadcrumb-item active">Formulir Balas Feedback</li>
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
                            <h2 class="text-center mb-4">Formulir Balas Feedback Pengunjung</h2>

                            <form action="<?= site_url('admin/feedback/kirim/' . $tb_pengaduan->id_feedback); ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama" class="col-form-label">Nama Lengkap</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama" style="background-color: #C7C8CC;" name="nama" value="<?= old('nama', $tb_feedback->nama); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="col-form-label">Email</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="email" style="background-color: #C7C8CC;" name="email" value="<?= old('email', $tb_feedback->email); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="subjek" class="col-form-label">Subjek</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input disabled type="text" class="form-control" id="subjek" style="background-color: #C7C8CC;" name="subjek" value="<?= old('subjek', $tb_feedback->subjek); ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pesan" class="col-form-label">Isi Pesan</label><span style="color: red;">*</span>
                                    <textarea disabled class="form-control custom-border" id="pesan" cols="30" rows="5" style="background-color: #C7C8CC;" name="pesan"><?= old('pesan', $tb_feedback->pesan); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="balasan" class="col-form-label">Isi balasan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('balasan')) ? 'is-invalid' : ''; ?>" required name="balasan" placeholder="Masukkan Isi balasan Anda" id="balasan" cols="30" rows="5" style="background-color: white;"><?php echo old('balasan'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('balasan'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= site_url('admin/feedback/cek_data/' .  $tb_pengaduan->id_feedback); ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-arrow-left"></i> Batal
                                    </a>
                                    <button type="submit" class="btn btn-primary btn-md ml-3" style="margin-left: 10px;">
                                        <i class="fas fa-paper-plane"></i> Kirim
                                    </button>
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