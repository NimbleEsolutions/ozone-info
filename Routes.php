<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->match(['get','post'],'login', 'Home::login_details', ['filter'=>'noauth']);
$routes->get('dashboard', 'Home::dashboard', ['filter'=>'auth']);
// User Model
$routes->match(['get','post'], 'user/create_user', 'User::create_user_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'user/import_users', 'User::import_users_details', ['filter'=>'auth']);
$routes->get('logout', 'Home::logout');

// Sales Modules
$routes->match(['get','post'], 'sales/pre-sales', 'Sales::pre_sales_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'sales/post-sales', 'Sales::post_sales_details', ['filter'=>'auth']);

//kunjika
$routes->match(['get','post'], 'sales/create_lead', 'Sales::create_lead', ['filter'=>'auth']);
$routes->match(['get','post'], 'sales/save_lead', 'Sales::save_lead', ['filter'=>'auth']);
$routes->get('sales/update_lead_open/(:any)', 'Sales::update_lead_open/$1', ['filter'=>'auth']);
$routes->get('sales/update_lead', 'Sales::update_lead', ['filter'=>'auth']);
$routes->match(['get','post'], 'sales/save_lead_update', 'Sales::save_lead_update', ['filter'=>'auth']);

$routes->match(['get','post'], 'master/create_customer', 'Master::create_new_customer', ['filter'=>'auth']);
$routes->match(['get','post'], 'master/save_customer', 'Master::save_customer', ['filter'=>'auth']);
$routes->get('master/update_cust/(:any)', 'Master::update_cust/$1', ['filter'=>'auth']);
$routes->get('master/update_customer', 'Master::update_customer', ['filter'=>'auth']);
$routes->get('master/update_customer_save', 'Master::update_customer_save', ['filter'=>'auth']);


$routes->get('master/customer_details', 'Master::customer_details', ['filter'=>'auth']);
$routes->match(['get','post'], 'master/new_customer', 'Master::new_customer', ['filter'=>'auth']);
$routes->match(['get','post'], 'master/save_new_customer', 'Master::save_new_customer', ['filter'=>'auth']);
$routes->get('master/up_cust/(:any)', 'Master::up_cust/$1', ['filter'=>'auth']);
$routes->get('master/up_customer', 'Master::up_customer', ['filter'=>'auth']);
$routes->get('master/up_customer_save', 'Master::up_customer_save', ['filter'=>'auth']);
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
