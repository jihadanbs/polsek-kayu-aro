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
                        <h4 class="mb-sm-0 font-size-18">Formulir Tambah Data Laporan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tambah Data Laporan</a></li>
                                <li class="breadcrumb-item active">Formulir Tambah Data Laporan</li>
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
                            <h2 class="text-center mb-4">Formulir Tambah Data Laporan</h2>

                            <form action="<?= esc(site_url('admin/laporan/save'), 'attr'); ?>" method="POST" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_babin" class="col-form-label">Nama Bhabin Yang Bertanggung Jawab</label><span style="color: red;">*</span>
                                        <select class="form-select custom-border <?= session('errors.id_babin') ? 'is-invalid' : '' ?>" id="id_babin" name="id_babin" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Bhabin ~</option>
                                            <?php foreach ($tb_babin as $value) : ?>
                                                <option value="<?= esc($value['id_babin'], 'attr') ?>" <?= old('id_babin') == $value['id_babin'] ? 'selected' : ''; ?>>
                                                    <?= esc($value['nama_lengkap'], 'html') ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errors.id_babin')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_babin') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="judul_laporan" class="col-form-label">Judul Laporan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.judul_laporan') ? 'is-invalid' : '' ?>" id="judul_laporan" autofocus name="judul_laporan" placeholder="Masukkan Judul Laporan Kegiatan" style="background-color: white;" value="<?= esc(old('judul_laporan'), 'attr'); ?>">
                                            <?php if (session('errors.judul_laporan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.judul_laporan') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">Contoh: Laporan Kegiatan Kerja Bakti Desa Bukit Tinggi</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="tanggal_laporan" class="col-form-label">Tanggal Kegiatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control <?= session('errors.tanggal_laporan') ? 'is-invalid' : '' ?>" id="tanggal_laporan" name="tanggal_laporan" style="background-color: white;" value="<?= esc(old('tanggal_laporan'), 'attr'); ?>" required>
                                            <?php if (session('errors.tanggal_laporan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.tanggal_laporan') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3 ">
                                        <label for="jenis_kegiatan" class="col-form-label">Jenis Kegiatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.jenis_kegiatan') ? 'is-invalid' : '' ?>" id="jenis_kegiatan" name="jenis_kegiatan" placeholder="Masukkan Jenis Kegiatan Anda" style="background-color: white;" value="<?= esc(old('jenis_kegiatan'), 'attr'); ?>">
                                            <?php if (session('errors.jenis_kegiatan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jenis_kegiatan') ?>
                                                </div>
                                            <?php endif ?>
                                            <small class="form-text text-muted">Contoh: Kerja Bakti</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="uraian_kegiatan" class="col-form-label">Isi Kegiatan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= session('errors.uraian_kegiatan') ? 'is-invalid' : '' ?>" required name="uraian_kegiatan" placeholder="Masukkan Isi Kegiatan Secara Lengkap" id="uraian_kegiatan" cols="30" rows="5" style="background-color: white;"><?= esc(old('uraian_kegiatan'), 'html'); ?></textarea>
                                    <?php if (session('errors.uraian_kegiatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.uraian_kegiatan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="hasil_kegiatan" class="col-form-label">Hasil Dari Kegiatan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= session('errors.hasil_kegiatan') ? 'is-invalid' : '' ?>" required name="hasil_kegiatan" placeholder="Masukkan Hasil Dari Kegiatan Secara Lengkap" id="hasil_kegiatan" cols="30" rows="5" style="background-color: white;"><?= esc(old('hasil_kegiatan'), 'html'); ?></textarea>
                                    <?php if (session('errors.hasil_kegiatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.hasil_kegiatan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="file_foto" class="col-form-label">Dokumentasi Foto Kegiatan</label><span style="color: red;">*</span>
                                    <input type="file" accept="image/*" class="form-control custom-border <?= session('errors.file_foto') ? 'is-invalid' : '' ?>" id="file_foto" name="file_foto[]" style="background-color: white;" <?= (old('file_foto')) ? 'disabled' : 'required'; ?> multiple>
                                    <?php if (session('errors.file_foto')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.file_foto') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi_kegiatan" class="col-form-label">Lokasi Kegiatan</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <div id="map" style="height: 400px;"></div>
                                        <input type="hidden" id="lokasi_kegiatan" name="lokasi_kegiatan" value="<?= esc(old('lokasi_kegiatan'), 'attr'); ?>" class="form-control <?= session('errors.lokasi_kegiatan') ? 'is-invalid' : '' ?>">
                                        <?php if (session('errors.lokasi_kegiatan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.lokasi_kegiatan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                </div>

                                <!-- Script Maps -->
                                <script>
                                    // Inisialisasi peta dengan koordinat default
                                    var map = L.map('map').setView([-6.1751, 106.8650], 13); // Koordinat pusat peta awal (contoh: Jakarta)

                                    // Tambahkan tile layer dari OpenStreetMap
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                    }).addTo(map);

                                    var marker;

                                    // Fungsi untuk mengatur marker ke lokasi saat ini
                                    function setMarker(lat, lng) {
                                        var latlng = L.latLng(lat, lng);
                                        if (marker) {
                                            marker.setLatLng(latlng);
                                        } else {
                                            marker = L.marker(latlng).addTo(map);
                                        }
                                        document.getElementById('lokasi_kegiatan').value = lat + ", " + lng;
                                        map.setView(latlng, 15); // Atur tampilan peta ke lokasi baru
                                    }

                                    // Dapatkan lokasi saat ini menggunakan Geolocation API
                                    if (navigator.geolocation) {
                                        navigator.geolocation.getCurrentPosition(function(position) {
                                            setMarker(position.coords.latitude, position.coords.longitude);
                                            console.log('Position:', position.coords.latitude, position.coords.longitude);
                                        }, function(error) {
                                            console.error('Error occurred:', error.message);
                                            // Fallback: Gunakan IP Geolocation API
                                            fetch('https://ipapi.co/json/')
                                                .then(response => response.json())
                                                .then(data => {
                                                    setMarker(data.latitude, data.longitude);
                                                    console.log('Fallback Position:', data.latitude, data.longitude);
                                                })
                                                .catch(err => console.error('IP Geolocation Error:', err));
                                        }, {
                                            enableHighAccuracy: true,
                                            timeout: 10000,
                                            maximumAge: 0
                                        });
                                    } else {
                                        alert("Geolocation tidak didukung oleh browser Anda.");
                                    }

                                    // Tambahkan fungsi klik pada peta untuk memperbarui lokasi marker
                                    map.on('click', function(e) {
                                        setMarker(e.latlng.lat, e.latlng.lng);
                                    });

                                    // Tambahkan kontrol geocoder ke peta
                                    var geocoder = L.Control.geocoder({
                                        defaultMarkGeocode: false
                                    }).on('markgeocode', function(e) {
                                        var latlng = e.geocode.center;
                                        setMarker(latlng.lat, latlng.lng);
                                    }).addTo(map);
                                </script>
                                <!-- End Script Maps -->

                                <div class="modal-footer">
                                    <a href="<?= esc(site_url('/admin/laporan'), 'attr'); ?>" class="btn btn-secondary btn-md ml-3">
                                        <i class="fas fa-times"></i> Batal Tambah
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="background-color: #28527A; color: white; margin-left: 10px;"><i class="fas fa-plus font-size-16 align-middle me-2"></i> Tambah Data Laporan</button>
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