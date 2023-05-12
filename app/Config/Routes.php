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
$routes->add('u/userlist', 'DashboardController::userlist');
$routes->add('u/extendexpire', 'DashboardController::extendexpire');
$routes->add('u/adduser', 'DashboardController::adduser');
$routes->add('u/generateusers', 'DashboardController::generateusers');
$routes->add('u/edituser', 'DashboardController::edituser');
$routes->add('u/userprofiles', 'DashboardController::userprofiles');
$routes->add('u/adduserprofile', 'DashboardController::adduserprofile');
$routes->add('u/printvoucher', 'DashboardController::printvoucher');
$routes->add('u/paymentsettings', 'DashboardController::paymentsettings');
$routes->add('u/paymentreport', 'DashboardController::paymentreport');
$routes->add('u/paymentpage', 'DashboardController::paymentpage');
$routes->add('traffic', 'DashboardController::traffic');

$routes->add('u/pppprofiles', 'PPPController::ppp_profile');
$routes->add('u/pppsecrets', 'PPPController::ppp_secret');







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
