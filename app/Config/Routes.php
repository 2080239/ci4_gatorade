<?php

use CodeIgniter\Router\RouteCollection;

$routes->match(['get','post'], 'register/step1', 'RegistrationController::step1');
$routes->match(['get','post'], 'register/step2', 'RegistrationController::step2');
$routes->match(['get','post'], 'register/step3', 'RegistrationController::step3');
$routes->match(['get','post'], 'register/step4', 'RegistrationController::step4');
$routes->get('register/complete', 'RegistrationController::complete');
// list all registrations
$routes->get('register/all', 'RegistrationController::all');

// convenience: /register -> step1
$routes->get('register', function() { return redirect()->to('/register/step1'); });

