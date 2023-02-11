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
$routes->get('/', 'Auth::index');
$routes->get('registrasi', 'Auth::registrasi');
$routes->post('auth/simpan', 'Auth::simpan');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('dashboard', 'Dashboard::index', ['filter' => 'authfilter']);

$routes->get('sarana', 'Sarana::index', ['filter' => 'authfilter']);
$routes->get('sarana/tambah', 'Sarana::tambah', ['filter' => 'authfilter']);
$routes->get('sarana/ubah/(:num)', 'Sarana::ubah/$1', ['filter' => 'authfilter']);
$routes->get('sarana/export', 'Sarana::export');
$routes->post('sarana/simpan', 'Sarana::simpan');
$routes->post('sarana/update/(:num)', 'Sarana::update/$1');
$routes->delete('sarana/(:num)', 'Sarana::hapus/$1');

$routes->get('prasarana', 'Prasarana::index', ['filter' => 'authfilter']);
$routes->get('prasarana/tambah', 'Prasarana::tambah', ['filter' => 'authfilter']);
$routes->get('prasarana/ubah/(:num)', 'Prasarana::ubah/$1', ['filter' => 'authfilter']);
$routes->get('prasarana/export', 'Prasarana::export');
$routes->post('prasarana/simpan', 'Prasarana::simpan');
$routes->post('prasarana/update/(:num)', 'Prasarana::update/$1');
$routes->delete('prasarana/(:num)', 'Prasarana::hapus/$1');

$routes->get('peminjaman', 'Peminjaman::index', ['filter' => 'authfilter']);
$routes->post('peminjaman/simpan', 'Peminjaman::simpan');

$routes->get('daftarpeminjaman', 'DaftarPeminjaman::index', ['filter' => 'authfilter']);
$routes->get('daftarpeminjaman/ubah/(:num)', 'DaftarPeminjaman::ubah/$1', ['filter' => 'authfilter']);
$routes->get('daftarpeminjaman/export', 'DaftarPeminjaman::export');
$routes->post('daftarpeminjaman/update/(:num)', 'DaftarPeminjaman::update/$1');
$routes->delete('daftarpeminjaman/(:num)', 'DaftarPeminjaman::hapus/$1');

$routes->get('anggota', 'Anggota::index', ['filter' => 'authfilter']);
$routes->get('anggota/tambah', 'Anggota::tambah', ['filter' => 'authfilter']);
$routes->get('anggota/ubah/(:num)', 'Anggota::ubah/$1', ['filter' => 'authfilter']);
$routes->get('anggota/export', 'Anggota::export');
$routes->post('anggota/simpan', 'Anggota::simpan');
$routes->post('anggota/update/(:num)', 'Anggota::update/$1');
$routes->delete('anggota/(:num)', 'Anggota::hapus/$1');

$routes->get('profil', 'Profil::index', ['filter' => 'authfilter']);
$routes->get('profil/ubah/(:num)', 'Profil::ubah/$1', ['filter' => 'authfilter']);
$routes->post('profil/update/(:num)', 'Profil::update/$1');
$routes->delete('profil/(:num)', 'Profil::hapus/$1');

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
