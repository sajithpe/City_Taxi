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
$routes->setDefaultController('Users');
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
// $routes->get('/', 'Home::index');
$routes->get('/', 'Users::index');
// $routes->match(["GET","POST"], "register", "Users::register");
$routes->get("/register", 'Users::register');
$routes->post("/register", 'Users::register');
$routes->get("/home", 'Home::index');
$routes->get("/verify", 'Users::verify');
$routes->post("/verifyotp", 'Users::verifyotp');
$routes->post("/adminView", "Home::adminView");
$routes->post("/mkrequest", "RequestController::index");
$routes->get("/drList", "Home::dlist");


$routes->post("/usersList", 'UserControl::index');
$routes->post("/save-user", 'UserControl::save');
$routes->post("/getUser", 'UserControl::getuser');
$routes->post("/update-user", 'UserControl::updateUser');
$routes->post("/delete-user", 'UserControl::deleteUser');
$routes->post("/vTypeList", 'VTypeControl::index');
$routes->post("/delete-type", 'VTypeControl::deleteType');
$routes->post("/getVtype", 'VTypeControl::getType');
$routes->post("/save-vtype", 'VTypeControl::saveType');
$routes->post("/update-vType", 'VTypeControl::updateType');

// $routes->post("/driverList", 'DriverControl::index');

$routes->post("/vehicleList", 'VehicleControl::index');
$routes->post("/delete-v", 'VehicleControl::deleteVehicle');
$routes->post("/update-v", 'VehicleControl::updateVehicle');
$routes->post("/get-v", 'VehicleControl::getVehicle');
$routes->post("/save-v", 'VehicleControl::saveVehicle');
$routes->post("/all-drivers", 'VehicleControl::drivers');
$routes->post("/up-driver" , "VehicleControl::setDriver");






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
