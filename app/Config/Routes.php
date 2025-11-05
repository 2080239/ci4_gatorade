<?php

use CodeIgniter\Router\RouteCollection;

// Default homepage route
$routes->get('/', 'Home::index');

$routes->match(['get','post'], 'register/step1', 'RegistrationController::step1');
$routes->match(['get','post'], 'register/step2', 'RegistrationController::step2');
$routes->match(['get','post'], 'register/step3', 'RegistrationController::step3');
$routes->match(['get','post'], 'register/step4', 'RegistrationController::step4');
$routes->get('register/complete', 'RegistrationController::complete');

$routes->get('register/all', 'RegistrationController::all', ['filter' => 'admin']);


$routes->match(['get','post'], 'login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');


$routes->get('register', function() { return redirect()->to('/register/step1'); });

