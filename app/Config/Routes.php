<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


// login
$routes->post('/login', 'Login::cek_login');
$routes->get('/logout', 'Login::logout');


$routes->group('panel', function ($routes) {
	$routes->get('beranda', 'Panel\Beranda::index');


	$routes->group('users', function ($routes) {
		$routes->get('index', 				'Panel\Users::index');
		$routes->get('(:segment)/edit', 	'Panel\Users::show');
		$routes->delete('(:segment)', 		'Panel\Users::delete/$1');
	});

	$routes->group('produk', function ($routes) {
		$routes->get('index', 				'Panel\Produk::index');
	});

	$routes->group('hadiah', function ($routes) {
		$routes->get('index', 		'Panel\Hadiah::index');
	});

	$routes->group('transaksi', function ($routes) {
		$routes->get('index', 		'Panel\Transaksi::index');
	});
});


$routes->group('rest', function ($routes) {
	$routes->group('users', function ($routes) {
		$routes->get('data', 					'RestUser::index');
		$routes->post('create',					'RestUser::userCreate');
		$routes->post('update',					'RestUser::userUpdate');
		$routes->delete('delete/(:segment)',	'RestUser::userDell/$1');
	});

	$routes->group('produk', function ($routes) {
		$routes->get('data', 					'RestProduk::index');
		$routes->post('create',					'RestProduk::produkCreate');
		$routes->post('update',					'RestProduk::produkUpdate');
		$routes->delete('delete/(:segment)',	'RestProduk::produkDell/$1');
	});

	$routes->group('hadiah', function ($routes) {
		$routes->get('data', 					'RestHadiah::index');
		$routes->post('create',					'RestHadiah::hadiahCreate');
		$routes->post('update',					'RestHadiah::hadiahUpdate');
		$routes->delete('delete/(:segment)',	'RestHadiah::hadiahDell/$1');
	});
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
