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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');


$routes->group('admin', ['filter'=> 'admin-auth:admin,operator'] , function($routes){
	$routes->get('dashboard', 'Admin\DashboardController::index');
	
	$routes->group('categories', function($routes){
		$routes->get('categories', 'Admin\CategoriesController::index');
		$routes->get('categories/(:num)', 'Admin\CategoriesController::index/$1');
		$routes->post('categories', 'Admin\CategoriesController::store');
		$routes->put('categories/(:num)', 'Admin\CategoriesController::update/$1');
		$routes->delete('categories/(:num)', 'Admin\CategoriesController::destroy/$1');
	});

	

	$routes->get('attributes', 'Admin\AttributesController::index');
	$routes->get('attributes/(:num)', 'Admin\AttributesController::index/$1');
	$routes->post('attributes', 'Admin\AttributesController::store');
	$routes->put('attributes/(:num)', 'Admin\AttributesController::update/$1');
	$routes->delete('attributes/(:num)', 'Admin\AttributesController::destroy/$1');
	

});



$routes->group('auth', ['namespace' => 'IonAuth\Controllers'], function ($routes) {
	$routes->add('login', 'Auth::login');
	$routes->get('logout', 'Auth::logout');
	$routes->add('forgot_password', 'Auth::forgot_password');
    // $routes->get('dashboard', 'Admin\DashboardController::index');
	// $routes->get('/', 'Auth::index');
	// $routes->add('create_user', 'Auth::create_user');
	// $routes->add('edit_user/(:num)', 'Auth::edit_user/$1');
	// $routes->add('create_group', 'Auth::create_group');
	// $routes->get('activate/(:num)', 'Auth::activate/$1');
	// $routes->get('activate/(:num)/(:hash)', 'Auth::activate/$1/$2');
	// $routes->add('deactivate/(:num)', 'Auth::deactivate/$1');
	// $routes->get('reset_password/(:hash)', 'Auth::reset_password/$1');
	// $routes->post('reset_password/(:hash)', 'Auth::reset_password/$1');
	// ...
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
