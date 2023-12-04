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

// DASHBOARD ADMIN FILTERS
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('profile', 'ProfileController::profile');

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

    // REKAP MONITORING
    $routes->get('rekap-monitoring', 'RekapMonitoringController::index');
    $routes->get('rekap-monitoring/view/(:num)', 'RekapMonitoringController::view/$1');

    // DATA SISWA
    $routes->get('data-siswa', 'SiswaController::index');
    $routes->get('data-siswa/new', 'SiswaController::new');
    $routes->post('data-siswa/add', 'SiswaController::add');
    $routes->get('data-siswa/edit/(:num)/(:any)', 'SiswaController::edit/$1/$2');
    $routes->post('data-siswa/update/(:num)', 'SiswaController::update/$1');
    $routes->get('data-siswa/delete/(:num)', 'SiswaController::delete/$1');

    // DATA GURU
    $routes->get('data-guru', 'GuruController::index');
    $routes->get('data-guru/new', 'GuruController::new');
    $routes->post('data-guru/add', 'GuruController::add');
    $routes->get('data-guru/edit/(:num)/(:any)', 'GuruController::edit/$1/$2');
    $routes->post('data-guru/update/(:num)', 'GuruController::update/$1');
    $routes->get('data-guru/delete/(:num)', 'GuruController::delete/$1');

    // DATA PRESTASI AKADEMIK
    $routes->get('prestasi-akademik', 'PrestasiAkademikController::index');
    $routes->post('prestasi-akademik/add', 'PrestasiAkademikController::add');
    $routes->post('prestasi-akademik/update/(:num)', 'PrestasiAkademikController::update/$1');
    $routes->get('prestasi-akademik/delete/(:num)', 'PrestasiAkademikController::delete/$1');

    // DATA PELANGGARAN SISWA
    $routes->get('data-pelanggaran', 'PelanggaranController::index');
    $routes->post('data-pelanggaran/add', 'PelanggaranController::add');
    $routes->post('data-pelanggaran/update/(:num)', 'PelanggaranController::update/$1');
    $routes->get('data-pelanggaran/delete/(:num)', 'PelanggaranController::delete/$1');
});

$routes->group('siswa', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('profile', 'ProfileController::profile');
    $routes->post('profile/update/(:num)', 'ProfileController::updateProfile/$1');
    $routes->post('profile/ganti-password/(:num)', 'ProfileController::password/$1');
    $routes->get('prestasi-akademik', 'PrestasiAkademikController::index');
    $routes->get('data-pelanggaran', 'PelanggaranController::index');
    $routes->get('rekap-monitoring', 'RekapMonitoringController::index');
});

$routes->group('guru', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('profile', 'ProfileController::profile');
    $routes->post('profile/update/(:num)', 'ProfileController::updateProfile/$1');
    $routes->post('profile/ganti-password/(:num)', 'ProfileController::password/$1');

    // KELAS DAN SET KELAS
    $routes->get('data-anggota-kelas', 'SiswaController::anggota');

    // REKAP MONITORING
    $routes->get('rekap-monitoring', 'RekapMonitoringController::index');
    $routes->get('rekap-monitoring/view/(:num)', 'RekapMonitoringController::view/$1');

    // DATA SISWA
    $routes->get('data-siswa', 'SiswaController::index');

    // DATA PRESTASI AKADEMIK
    $routes->get('prestasi-akademik', 'PrestasiAkademikController::index');
    $routes->post('prestasi-akademik/add', 'PrestasiAkademikController::add');
    $routes->post('prestasi-akademik/update/(:num)', 'PrestasiAkademikController::update/$1');

    // DATA PELANGGARAN SISWA
    $routes->get('data-pelanggaran', 'PelanggaranController::index');
    $routes->post('data-pelanggaran/add', 'PelanggaranController::add');
    $routes->post('data-pelanggaran/update/(:num)', 'PelanggaranController::update/$1');
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
