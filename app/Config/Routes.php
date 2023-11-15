<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// AUTH
$routes->get('login', 'AuthController::index');
$routes->get('login-dark', 'AuthController::index2');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->get('googleAuth/loginWithGoogle', 'AuthController::googleLogin');
$routes->get('googleAuth/loginWithGoogle/callback', 'Auth::googleCallback');


// RESET PASSWORD
// $routes->get('forgot-password', 'AuthController::forgotPassword');
// $routes->post('forgot-password', 'AuthController::processForgotPassword');
// $routes->get('reset-password/(:any)', 'AuthController::showResetForm/$1', ['as' => 'password.reset']);
// $routes->post('reset-password', 'AuthController::reset', ['as' => 'password.update']);

// DASHBOARD ADMIN FILTERS
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('profile', 'DashboardController::profile');

    // ADMINISTRATOR
    $routes->get('data-users', 'UserController::index');
    $routes->post('data-users/add', 'UserController::add');
    $routes->post('data-users/update/(:num)', 'UserController::update/$1');
    $routes->get('data-users/delete/(:num)', 'UserController::delete/$1');

    // KELAS DAN SET KELAS
    $routes->get('data-anggota-kelas', 'SiswaController::anggota');
    $routes->get('data-kelas', 'KelasController::index');
    $routes->post('data-kelas/add', 'KelasController::add');
    $routes->post('data-kelas/update/(:num)', 'KelasController::update/$1');
    $routes->get('data-kelas/delete/(:num)', 'KelasController::delete/$1');
    $routes->get('data-jurusan', 'KelasController::indexJurusan');
    $routes->post('data-jurusan/add', 'KelasController::addJurusan');
    $routes->post('data-jurusan/update/(:num)', 'KelasController::updateJurusan/$1');
    $routes->get('data-jurusan/delete/(:num)', 'KelasController::deleteJurusan/$1');

    // FAQ
    $routes->get('faq', 'DashboardController::faq');

    // REKAP MONITORING
    $routes->get('rekap-monitoring', 'RekapMonitoringController::index');
    $routes->get('rekap-monitoring/view/(:num)', 'RekapMonitoringController::view/$1');

    // DATA SISWA
    $routes->get('data-siswa', 'SiswaController::index');
    $routes->get('data-siswa/new', 'SiswaController::new');
    $routes->post('data-siswa/add', 'SiswaController::add');
    $routes->get('data-siswa/edit/(:num)', 'SiswaController::edit/$1');
    $routes->post('data-siswa/update/(:num)', 'SiswaController::update/$1');
    $routes->get('data-siswa/delete/(:num)', 'SiswaController::delete/$1');

    // DATA ORANGTUA
    $routes->get('data-orangtua', 'OrtuController::index');
    $routes->get('data-orangtua/new', 'OrtuController::new');
    $routes->post('data-orangtua/add', 'OrtuController::add');
    $routes->get('data-orangtua/edit/(:num)', 'OrtuController::edit/$1');
    $routes->post('data-orangtua/update/(:num)', 'OrtuController::update/$1');
    $routes->get('data-orangtua/delete/(:num)', 'OrtuController::delete/$1');

    // DATA GURU
    $routes->get('data-guru', 'GuruController::index');
    $routes->get('data-guru/new', 'GuruController::new');
    $routes->post('data-guru/add', 'GuruController::add');
    $routes->get('data-guru/edit/(:num)', 'GuruController::edit/$1');
    $routes->post('data-guru/update/(:num)', 'GuruController::update/$1');
    $routes->get('data-guru/delete/(:num)', 'GuruController::delete/$1');

    // DATA WALIKELAS
    $routes->get('data-walikelas', 'WaliKelasController::index');
    $routes->post('data-walikelas/add', 'WaliKelasController::add');
    $routes->post('data-walikelas/update/(:num)', 'WaliKelasController::update/$1');
    $routes->get('data-walikelas/delete/(:num)', 'WaliKelasController::delete/$1');

    // DATA WALIKELAS
    $routes->get('data-pengumuman', 'PengumumanController::index');
    $routes->post('data-pengumuman/add', 'PengumumanController::add');
    $routes->post('data-pengumuman/update/(:num)', 'PengumumanController::update/$1');
    $routes->get('data-pengumuman/delete/(:num)', 'PengumumanController::delete/$1');

    // DATA TAPEL
    $routes->get('data-tapel', 'TapelController::index');
    $routes->post('data-tapel/add', 'TapelController::add');
    $routes->post('data-tapel/update/(:num)', 'TapelController::update/$1');
    $routes->get('data-tapel/delete/(:num)', 'TapelController::delete/$1');

    // DATA PRESTASI AKADEMIK
    $routes->get('prestasi-akademik', 'PrestasiAkademikController::index');
    $routes->post('prestasi-akademik/add', 'PrestasiAkademikController::add');
    $routes->post('prestasi-akademik/update/(:num)', 'PrestasiAkademikController::update/$1');
    $routes->get('prestasi-akademik/delete/(:num)', 'PrestasiAkademikController::delete/$1');

    // DATA PRESTASI NON-AKADEMIK
    $routes->get('prestasi-nonakademik', 'PrestasiNonAkademikController::index');
    $routes->post('prestasi-nonakademik/add', 'PrestasiNonAkademikController::add');
    $routes->post('prestasi-nonakademik/update/(:num)', 'PrestasiNonAkademikController::update/$1');
    $routes->get('prestasi-nonakademik/delete/(:num)', 'PrestasiNonAkademikController::delete/$1');

    // DATA MAPEL
    $routes->get('data-ranking', 'RankingController::index');
    $routes->post('data-ranking/add', 'RankingController::add');
    $routes->post('data-ranking/update/(:num)', 'RankingController::update/$1');
    $routes->get('data-ranking/delete/(:num)', 'RankingController::delete/$1');

    // DATA KEAKTIFAN
    $routes->get('keaktifan-siswa', 'KeaktifanSiswaController::index');
    $routes->post('keaktifan-siswa/add', 'KeaktifanSiswaController::add');
    $routes->post('keaktifan-siswa/update/(:num)', 'KeaktifanSiswaController::update/$1');
    $routes->get('keaktifan-siswa/delete/(:num)', 'KeaktifanSiswaController::delete/$1');

    // DATA KEAKTIFAN
    $routes->get('evaluasi-guru', 'EvaluasiGuruController::index');
    $routes->post('evaluasi-guru/add', 'EvaluasiGuruController::add');
    $routes->post('evaluasi-guru/update/(:num)', 'EvaluasiGuruController::update/$1');
    $routes->get('evaluasi-guru/delete/(:num)', 'EvaluasiGuruController::delete/$1');

    // DATA EKSTRAKURIKULER
    $routes->get('ekstrakurikuler', 'EkstrakurikulerController::index');
    $routes->post('ekstrakurikuler/add', 'EkstrakurikulerController::add');
    $routes->post('ekstrakurikuler/update/(:num)', 'EkstrakurikulerController::update/$1');
    $routes->get('ekstrakurikuler/delete/(:num)', 'EkstrakurikulerController::delete/$1');

    // DATA PELANGGARAN SISWA
    $routes->get('data-pelanggaran', 'PelanggaranController::index');
    $routes->post('data-pelanggaran/add', 'PelanggaranController::add');
    $routes->post('data-pelanggaran/update/(:num)', 'PelanggaranController::update/$1');
    $routes->get('data-pelanggaran/delete/(:num)', 'PelanggaranController::delete/$1');

    // ANGGOTA EKSTRAKURIKULER
    $routes->get('anggota-ekstrakurikuler/view/(:num)', 'EkstrakurikulerController::view/$1');
    $routes->post('anggota-ekstrakurikuler/add', 'EkstrakurikulerController::addAnggota');
    $routes->post('anggota-ekstrakurikuler/update/(:num)', 'EkstrakurikulerController::updateAnggota/$1');
    $routes->get('anggota-ekstrakurikuler/delete/(:num)', 'EkstrakurikulerController::deleteAnggota/$1');
});

$routes->group('siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('keaktifan-siswa', 'KeaktifanSiswaController::index');
    $routes->get('data-ranking', 'RankingController::index');
    $routes->get('prestasi-akademik', 'PrestasiAkademikController::index');
    $routes->get('prestasi-nonakademik', 'PrestasiNonAkademikController::index');
    $routes->get('ekstrakurikuler', 'EkstrakurikulerController::index');
    $routes->get('data-pelanggaran', 'PelanggaranController::index');
    $routes->get('evaluasi-guru', 'EvaluasiGuruController::index');
    $routes->get('rekap-monitoring', 'RekapMonitoringController::index');
    $routes->get('data-pengumuman', 'PengumumanController::index');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
