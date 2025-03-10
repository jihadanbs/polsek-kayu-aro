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
                        <h4 class="mb-sm-0 font-size-18">Formulir Ubah Data Laporan</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Laporan Babin</a></li>
                                <li class="breadcrumb-item active">Formulir Ubah Data Laporan</li>
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
                            <h2 class="text-center mb-4">Formulir Ubah Data Laporan</h2>

                            <form action="<?= esc(site_url('admin/laporan/update/' . urlencode($tb_laporan_babin['id_laporan_babin'])), 'attr') ?>" method="post" enctype="multipart/form-data" id="validationForm" novalidate autocomplete="off">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="PUT">
                                <input type="hidden" name="file_foto" value="<?= esc($tb_laporan_babin['file_foto'], 'attr'); ?>">

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="id_babin" class="col-form-label">Nama Bhabin Yang Bertanggung Jawab</label><span style="color: red;">*</span>
                                        <select class="form-select custom-border <?= session('errors.id_babin') ? 'is-invalid' : '' ?>" id="id_babin" name="id_babin" aria-label="Default select example" style="background-color: white;" required>
                                            <option value="" selected disabled>~ Silahkan Pilih Nama Bhabin ~</option>
                                            <?php foreach ($tb_babin as $value) : ?>
                                                <?php $selected = ($value['id_babin'] == old('id_babin', $tb_laporan_babin['id_babin'])) ? 'selected' : ''; ?>
                                                <option value="<?= $value['id_babin'] ?>" <?= $selected ?>><?= $value['nama_lengkap'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php if (session('errors.id_babin')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.id_babin') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="judul_laporan" class="col-form-label">Judul Laporan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.judul_laporan') ? 'is-invalid' : '' ?>" id="judul_laporan" style="background-color: white;" placeholder="Masukkan Judul Laporan" name="judul_laporan" value="<?= esc(old('judul_laporan', $tb_laporan_babin['judul_laporan']), 'attr'); ?>">
                                            <small class="form-text text-muted">Contoh: Laporan Kegiatan Kerja Bakti Desa Bukit Tinggi</small>
                                            <?php if (session('errors.judul_laporan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.judul_laporan') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3 separator">
                                        <label for="tanggal_laporan" class="col-form-label">Tanggal Kegiatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="date" class="form-control <?= session('errors.tanggal_laporan') ? 'is-invalid' : '' ?>" id="tanggal_laporan" style="background-color: white;" name="tanggal_laporan" value="<?= esc(old('tanggal_laporan', $tb_laporan_babin['tanggal_laporan']), 'attr'); ?>">
                                            <?php if (session('errors.tanggal_laporan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.tanggal_laporan') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="jenis_kegiatan" class="col-form-label">Jenis Kegiatan</label><span style="color: red;">*</span>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control <?= session('errors.jenis_kegiatan') ? 'is-invalid' : '' ?>" id="jenis_kegiatan" style="background-color: white;" placeholder="Masukkan Jenis Kegiatan" name="jenis_kegiatan" value="<?= esc(old('jenis_kegiatan', $tb_laporan_babin['jenis_kegiatan']), 'attr'); ?>">
                                            <?php if (session('errors.jenis_kegiatan')) : ?>
                                                <div class="invalid-feedback">
                                                    <?= session('errors.jenis_kegiatan') ?>
                                                </div>
                                            <?php endif ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="uraian_kegiatan" class="col-form-label">Isi Kegiatan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= session('errors.uraian_kegiatan') ? 'is-invalid' : '' ?>" id="uraian_kegiatan" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Uraian Kegiatan" name="uraian_kegiatan"><?= esc(old('uraian_kegiatan', $tb_laporan_babin['uraian_kegiatan']), 'attr'); ?></textarea>
                                    <?php if (session('errors.uraian_kegiatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.uraian_kegiatan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="hasil_kegiatan" class="col-form-label">Hasil Kegiatan</label><span style="color: red;">*</span>
                                    <textarea class="form-control custom-border <?= session('errors.hasil_kegiatan') ? 'is-invalid' : '' ?>" id="hasil_kegiatan" cols="30" rows="5" style="background-color: white;" placeholder="Masukkan Uraian Kegiatan" name="hasil_kegiatan"><?= esc(old('hasil_kegiatan', $tb_laporan_babin['hasil_kegiatan']), 'attr'); ?></textarea>
                                    <?php if (session('errors.hasil_kegiatan')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.hasil_kegiatan') ?>
                                        </div>
                                    <?php endif ?>
                                </div>

                                <div class="mb-3">
                                    <label for="file_foto" class="col-form-label">File Foto</label><span style="color: red;">*</span>
                                    <input type="file" accept="image/*" class="form-control custom-border <?= session('errors.file_foto') ? 'is-invalid' : '' ?>" id="file_foto" name="file_foto[]" style="background-color: white;" <?= (old('file_foto')) ? 'disabled' : 'required'; ?> multiple>
                                    <?php if (session('errors.file_foto')) : ?>
                                        <div class="invalid-feedback">
                                            <?= session('errors.file_foto') ?>
                                        </div>
                                    <?php endif ?>
                                    <small class="form-text text-muted">Tidak perlu menginputkan ulang, jika tidak ingin mengubah foto</small>
                                    <?php if (!empty($tb_laporan_babin['file_foto'])) : ?>
                                        <input type="hidden" name="old_file_foto" value="<?= esc($tb_laporan_babin['file_foto'], 'attr'); ?>">
                                    <?php endif; ?>
                                </div>

                                <div class="mb-3">
                                    <label for="lokasi_kegiatan" class="col-form-label">Lokasi Kegiatan</label><span style="color: red;">*</span>
                                    <div class="col-sm-12">
                                        <div id="map" style="height: 400px;"></div>
                                        <input type="hidden" class="form-control <?= session('errors.lokasi_kegiatan') ? 'is-invalid' : '' ?>" id="lokasi_kegiatan" style="background-color: white;" name="lokasi_kegiatan" value="<?= esc(old('lokasi_kegiatan', $tb_laporan_babin['lokasi_kegiatan']), 'attr'); ?>">
                                        <?php if (session('errors.lokasi_kegiatan')) : ?>
                                            <div class="invalid-feedback">
                                                <?= session('errors.lokasi_kegiatan') ?>
                                            </div>
                                        <?php endif ?>
                                    </div>
                                    <small class="form-text text-muted">Selalu Cek Ulang Lokasi Yang Diinputkan, Agar Sesuai Dengan Lokasi Anda Yang Sebenarnya</small>
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

                                <div class="form-group mb-4 mt-4">
                                    <div class="d-grid gap-2 d-md-flex justify-content-end">
                                        <a href="<?= esc(site_url('/admin/laporan/cek_data/' . urlencode($tb_laporan_babin['id_laporan_babin'])), 'attr') ?>" class="btn btn-secondary btn-md ml-3">
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
        var inputJudul = document.getElementById('judul_laporan');

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