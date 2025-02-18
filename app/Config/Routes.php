<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->GET('/', 'Home::index');
$routes->GET('/', 'Home::detail-informasi');
$routes->GET('detail-informasi/(:segment)', 'Home::detailInformasi/$1');
$routes->GET('statistik', 'Home::statistik');
$routes->GET('cek-pengaduan', 'Home::cekPengaduan');
$routes->POST('cek-pengaduan', 'Home::cek');
$routes->POST('review', 'Home::save_review');
$routes->GET('review', 'Home::review');


//TOKEN CSRF
$routes->GET('get-new-csrf-token', 'SecurityController::getNewCSRFToken');

//AUTHENTICATION
$routes->GROUP('authentication', function ($routes) { //catatan : pastikan POST / GET
    $routes->GET('registrasi', 'Authentication::registrasi/$1');
    $routes->POST('cekRegistrasi', 'Authentication::cekRegistrasi/');
    $routes->post('updateStatus', 'Authentication::updateStatus');
    $routes->GET('login', 'Authentication::login/');
    $routes->POST('cekLogin', 'Authentication::cekLogin/$1');
    $routes->GET('logout', 'Authentication::logout/$1');
    $routes->GET('lupaPassword', 'Authentication::lupaPassword/$1');
    $routes->POST('lupaPassword', 'Authentication::lupaPassword/$1');
    $routes->GET('resetPassword', 'Authentication::resetPassword/$1');
    $routes->POST('resetPassword', 'Authentication::resetPassword/$1');
    $routes->GET('tidakBisaLogin', 'Authentication::tidakBisaLogin/$1');
    $routes->POST('tidakBisaLogin', 'Authentication::tidakBisaLogin/$1');
    $routes->GET('resetStatusLogin', 'Authentication::resetStatusLogin/$1');
    $routes->POST('resetStatusLogin', 'Authentication::resetStatusLogin/$1');
});

//ROLE
$routes->GET('dashboard', 'RoleController::index');

//ROLE ADMIN
$routes->GROUP('admin', ['namespace' => 'App\Controllers\Admin'], function ($routes) {
    /*=================================== DASHBOARD ====================================*/
    $routes->GET('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Admin']);

    /*=================================== PROFILE ====================================*/
    $routes->GET('profile', 'ProfileController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('profile', static function ($routes) {
        $routes->POST('update/(:num)', 'ProfileController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('resetpassword', 'ProfileController::resetPassword', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('updateSandi/(:num)', 'ProfileController::updateSandi/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== DESA ====================================*/
    $routes->GET('desa', 'DesaController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('desa', static function ($routes) {
        $routes->GET('getDesaData/(:num)/(:segment)', 'DesaController::getDesaData/$1/$2', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('totalData', 'DesaController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'DesaController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'DesaController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'DesaController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'DesaController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'DesaController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'DesaController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== BABIN ====================================*/
    $routes->GET('babin', 'BabinController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('babin', static function ($routes) {
        $routes->GET('totalData', 'BabinController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'BabinController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'BabinController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'BabinController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'BabinController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'BabinController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'BabinController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== KATEGORI INFORMASI ====================================*/
    $routes->GET('kategori', 'KategoriController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('kategori', static function ($routes) {
        $routes->POST('save', 'KategoriController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('simpan_perubahan', 'KategoriController::simpan_perubahan', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'KategoriController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== INFORMASI EDUKASI ====================================*/
    $routes->GET('informasi', 'InformasiController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('informasi', static function ($routes) {
        $routes->GET('totalData', 'InformasiController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'InformasiController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'InformasiController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'InformasiController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'InformasiController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'InformasiController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'InformasiController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'InformasiController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== LAPORAN BABIN ====================================*/
    $routes->GET('laporan', 'LaporanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('laporan', static function ($routes) {
        $routes->GET('totalData', 'LaporanController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'LaporanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'LaporanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'LaporanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'LaporanController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'LaporanController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'LaporanController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'LaporanController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== GALERI ====================================*/
    $routes->GET('galeri', 'GaleriController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('galeri', static function ($routes) {
        $routes->GET('totalData', 'GaleriController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'GaleriController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'GaleriController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'GaleriController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'GaleriController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'GaleriController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'GaleriController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'GaleriController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== PENGADUAN ====================================*/
    $routes->GET('pengaduan', 'PengaduanController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('pengaduan', static function ($routes) {
        $routes->POST('send', 'PengaduanController::send', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('totalData', 'PengaduanController::totalData', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('totalByStatus/(:any)', 'PengaduanController::totalByStatus/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('tambah', 'PengaduanController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'PengaduanController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'PengaduanController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('balas/(:segment)', 'PengaduanController::balas/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('kirim/(:num)', 'PengaduanController::kirim/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'PengaduanController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'PengaduanController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== FAQ ====================================*/
    $routes->GET('faq', 'FaqController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('faq', static function ($routes) {
        $routes->GET('tambah', 'FaqController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'FaqController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'FaqController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'FaqController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'FaqController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'FaqController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete/(:num)', 'FaqController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== SLIDER ====================================*/
    $routes->GET('slider', 'SliderController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('slider', static function ($routes) {
        $routes->GET('tambah', 'SliderController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'SliderController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'SliderController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'SliderController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'SliderController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'SliderController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== REVIEWS ====================================*/
    $routes->GET('review', 'ReviewController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('review', static function ($routes) {
        $routes->GET('cek_data/(:segment)', 'ReviewController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete2', 'ReviewController::delete2', ['namespace' => 'App\Controllers\Admin']);
        $routes->DELETE('delete', 'ReviewController::delete', ['namespace' => 'App\Controllers\Admin']);
    });

    /*=================================== WEB OPTION ====================================*/
    $routes->GET('web_option', 'WebOptionController::index', ['namespace' => 'App\Controllers\Admin']);
    $routes->GROUP('web_option', static function ($routes) {
        $routes->GET('tambah', 'WebOptionController::tambah', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('save', 'WebOptionController::save', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('edit/(:segment)', 'WebOptionController::edit/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->PUT('update/(:num)', 'WebOptionController::update/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('cek_judul', 'WebOptionController::cek_judul', ['namespace' => 'App\Controllers\Admin']);
        $routes->GET('cek_data/(:segment)', 'WebOptionController::cek_data/$1', ['namespace' => 'App\Controllers\Admin']);
        $routes->POST('delete', 'WebOptionController::delete/$1', ['namespace' => 'App\Controllers\Admin']);
    });
});

//ROLE STAFF
$routes->GROUP('staff', ['namespace' => 'App\Controllers\Staff'], function ($routes) {
    $routes->GET('dashboard', 'Dashboard::index', ['namespace' => 'App\Controllers\Staff']);
});
