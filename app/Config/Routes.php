<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers\base');
$routes->setDefaultController('DashboardController');
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
// route since we don't have to scan directories.\

// Authentication Login
$routes->add('/', 'DashboardController::index');
$routes->post('auth', 'DashboardController::auth');


// Router
$routes->add('router/list', 'DashboardController::router');
$routes->add('router/addrouter', 'DashboardController::add_router');
$routes->post('router/update_user', 'DashboardController::update_user');
$routes->post('router/do_add_router', 'DashboardController::do_add_router');
$routes->post('router/edit_router', 'DashboardController::edit_router');
$routes->post('router/do_auth_router', 'DashboardController::do_auth_router');
$routes->post('router/delete_router', 'DashboardController::delete_router');
$routes->get('logout', 'DashboardController::logout');



// Dashboard
$routes->add('dashboard', 'DashboardController::dashboard');
$routes->add('traffic', 'DashboardController::traffic');


// Hotspot
$routes->add('hotspot/generate', 'DashboardController::generate');
$routes->post('hotspot/prosesgenerate', 'DashboardController::prosesgenerate');

$routes->add('hotspot/profile', 'DashboardController::profile');
$routes->post('hotspot/add_profile', 'DashboardController::add_profile');
$routes->post('hotspot/prosessinkron', 'DashboardController::prosessinkron');
$routes->add('hotspot/users', 'DashboardController::users');

$routes->add('hotspot/print/default', 'DashboardController::print_default');
$routes->add('hotspot/print/default/(:any)', 'DashboardController::print_default/$1');

$routes->add('hotspot/print/small', 'DashboardController::print_small');
$routes->add('hotspot/print/small/(:any)', 'DashboardController::print_small/$1');

$routes->add('hotspot/voucher/comment', 'DashboardController::cekdatabycomment');
$routes->add('hotspot/voucher/comment/(:any)', 'DashboardController::cekdatabycomment/$1');


$routes->add('hotspot/voucher/deletevoucherbycomment', 'DashboardController::deletevoucherbycomment');
$routes->add('hotspot/voucher/deletevoucherbycomment/(:any)', 'DashboardController::deletevoucherbycomment/$1');





$routes->add('hotspot/delete_profile/(:any)', 'DashboardController::delete_profile/$1');
$routes->add('hotspot/edit_profile/(:any)', 'DashboardController::edit_profile/$1');
$routes->add('hotspot/active', 'DashboardController::active');













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
