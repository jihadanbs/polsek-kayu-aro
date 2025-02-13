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
                        <h4 class="mb-sm-0 font-size-18">Formulir Balas Pengaduan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Formulir Cek Data</a></li>
                                <li class="breadcrumb-item active">Formulir Balas Pengaduan</li>
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
                            <h2 class="text-center mb-4">Formulir Balas Pengaduan Masyarakat</h2>

                            <form action="<?= site_url('admin/pengaduan/kirim/' . $tb_pengaduan['id_pengaduan']); ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="kode_pengajuan" id="id_pengajuan" value="<?= old('kode_pengaduan', $tb_pengaduan['kode_pengaduan']); ?>">
                                <label class="col-form-label" style="font-size: 25px;">A. Data Masyarakat</label>
                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama" class="col-form-label">Nama Lengkap</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama" style="background-color: white;" name="nama" value="<?= old('nama', $tb_pengaduan['nama']); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="no_telepon" class="col-form-label">No Telepon</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="no_telepon" style="background-color: white;" name="no_telepon" value="<?= old('no_telepon', $tb_pengaduan['no_telepon']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="col-form-label">Email</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input disabled type="text" class="form-control" id="email" style="background-color: white;" name="email" value="<?= old('email', $tb_pengaduan['email']); ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="nama_desa" class="col-form-label">Nama Desa</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama_desa" style="background-color: white;" name="nama_desa" value="<?= old('nama_desa', $tb_pengaduan['nama_desa']); ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="nama_lengkap" class="col-form-label">Nama Babin</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input disabled type="text" class="form-control" id="nama_lengkap" style="background-color: white;" name="nama_lengkap" value="<?= old('nama_lengkap', $tb_pengaduan['nama_lengkap']); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="subjek" class="col-form-label">Subjek</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <input disabled type="text" class="form-control" id="subjek" style="background-color: white;" name="subjek" value="<?= old('subjek', $tb_pengaduan['subjek']); ?>">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="pesan" class="col-form-label">Isi Pesan</label><span style="color: red;">*</span>
                                    <textarea disabled class="form-control custom-border" id="pesan" cols="30" rows="5" style="background-color: white;" name="pesan"><?= old('pesan', $tb_pengaduan['pesan']); ?></textarea>
                                </div>

                                <table class="table table-bordered table-sm">
                                    <thead class="text-center">
                                        <tr>
                                            <th width="50px">NO</th>
                                            <th>DOKUMENTASI PENGADUAN MASYARAKAT</th>
                                            <th width="100px">AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($tb_pengaduan)) : ?>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td><?= esc($tb_pengaduan['subjek'] ?? '', 'html') ?></td>
                                                <td class="text-center">
                                                    <?php if ($tb_pengaduan['dokumentasi'] ?? '') : ?>
                                                        <a href="<?= esc(base_url($tb_pengaduan['dokumentasi'] ?? ''), 'attr') ?>" class="btn btn-info btn-sm view" target="_blank">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    <?php else : ?>
                                                        <a href="#" class="btn btn-info btn-sm view disabled" title="File tidak tersedia">
                                                            <i class="fas fa-eye"></i> View File
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>

                                <label class="col-form-label" style="font-size: 25px;">B. Balas Pengaduan Masyarakat</label>

                                <div class="mb-3">
                                    <label for="balasan" class="col-form-label">Isi Balasan Atas Pengaduan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= ($validation->hasError('balasan')) ? 'is-invalid' : ''; ?>" name="balasan" placeholder="Masukkan Isi Balasan Pengaduan" autofocus id="balasan" cols="30" rows="5" style="background-color: white;"><?php echo old('balasan'); ?></textarea>

                                    <div class="invalid-feedback">
                                        <?= $validation->getError('balasan'); ?>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <a href="<?= site_url('/admin/pengaduan/cek_data/' .  $tb_pengaduan['id_pengaduan']); ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-times"></i> Batal Kirim
                                    </a>
                                    <button type="submit" class="btn btn-success btn-md ml-3" style="margin-left: 10px;">
                                        <i class="fas fa-paper-plane"></i> Kirim Balasan Pengaduan
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