<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'UserController::index', ['as' => 'login']);
$routes->post('/login', 'UserController::login', ['as' => 'login_post']);
$routes->get('/logout', 'UserController::logout', ['as' => 'logout']);

$routes->group('admin', ['filter' => 'auth'], function($routes){
    $routes->get('dashboard', 'AdminController::dashboard', ['admin_dashboard']);
    // ADMIN CONTROLLER
    $routes->group('admin', function($routes){
        $routes->get('/', 'AdminController::index', ['as' => 'admin_admin_index']);
        $routes->post('save', 'AdminController::save', ['as' => 'admin_admin_save']);
        $routes->post('delete', 'AdminController::delete', ['as' => 'admin_admin_delete']);
        $routes->post('update', 'AdminController::update', ['as' => 'admin_admin_update']);
    });
    // MERCHANT CONTROLLER
    $routes->group('merchant', function($routes){
        $routes->get('/', 'MerchantController::index', ['as' => 'admin_merchant_index']);
        $routes->post('save', 'MerchantController::save', ['as' => 'admin_merchant_save']);
        $routes->post('delete', 'MerchantController::delete', ['as' => 'admin_merchant_delete']);
        $routes->post('update', 'MerchantController::update', ['as' => 'admin_merchant_update']);
    });
    // USER CONTROLLER
    $routes->group('user', function($routes){
        $routes->get('/', 'UserController::user', ['as' => 'admin_user_index']);
        $routes->post('save', 'UserController::save', ['as' => 'admin_user_save']);
        $routes->post('delete', 'UserController::delete', ['as' => 'admin_user_delete']);
        $routes->post('update', 'UserController::update', ['as' => 'admin_user_update']);
    });
});

// MERCHANT ROUTES
$routes->group('merchant', ['filter' => 'auth'], function($routes){
    $routes->get('dashboard', 'MerchantController::dashboard', ['as' => 'merchant_dashboard']);
    // PRODUCT CONTROLLER  
    $routes->group('product', function($routes){
        $routes->get('/', 'ProdukController::index', ['as' => 'merchant_product_index']);
        $routes->post('save', 'ProdukController::save', ['as' => 'merchant_product_save']);
        $routes->post('delete', 'ProdukController::delete', ['as' => 'merchant_product_delete']);
        $routes->post('update', 'ProdukController::update', ['as' => 'merchant_product_update']);
    });
    // CATEGORY CONTROLLER
    $routes->group('category', function($routes){
        $routes->get('/', 'KategoriController::index', ['as' => 'merchant_category_index']);
        $routes->post('save', 'KategoriController::save', ['as' => 'merchant_category_save']);
        $routes->post('delete', 'KategoriController::delete', ['as' => 'merchant_category_delete']);
        $routes->post('update', 'KategoriController::update', ['as' => 'merchant_category_update']);
    });
    // FEEDBACK CONTROLLER
    $routes->group('feedback', function($routes){
        $routes->get('/', 'FeedbackController::index', ['as' => 'merchant_feedback_index']);
        $routes->post('delete', 'FeedbackController::delete', ['as' => 'merchant_feedback_delete']);
    });
    // TRANSACTION CONTROLLER
    $routes->group('transaction', function($routes){
        $routes->get('/', 'TransaksiController::index', ['as' => 'merchant_transaction_index']);
        $routes->get('(:any)', 'TransaksiController::detail/$1', ['as' => 'merchant_transaction_detail']);
        $routes->post('delete', 'TransaksiController::delete', ['as' => 'merchant_transaction_delete']);
    });
    // USER CONTROLLER
    $routes->group('user', function($routes){
        $routes->get('/', 'UserController::list', ['as' => 'merchant_user_list']);
        $routes->post('delete', 'UserController::delete', ['as' => 'merchant_user_delete']);
    });
    // SERVICE CONTROLLER
    $routes->group('service', function($route){
        $route->get('/', 'ServiceController::index', ['as' => 'merchant_service_index']);
        $route->post('save', 'ServiceController::save', ['as' => 'merchant_service_save']);
        $route->post('delete', 'ServiceController::delete', ['as' => 'merchant_service_delete']);
        $route->post('update', 'ServiceController::update', ['as' => 'merchant_service_update']);
    });
});


// TESTING ROUTES
$routes->get('/cek-session', function(){
    var_dump(session()->get('isLoggedIn'));
});
$routes->get('/reset-session', function(){
    session()->destroy();
});
$routes->get('cek-level', function(){
    var_dump(session()->get('level'));
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}