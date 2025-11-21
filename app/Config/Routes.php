<?php

use CodeIgniter\Router\RouteCollection;

// Default homepage route
$routes->get('/register', 'RegisterController::index');
$routes->get('/register/coach/step1', 'RegisterController::coachStep1');
$routes->post('/register/coach/step1', 'RegisterController::coachStep1Submit');
$routes->get('/register/coach/step2', 'RegisterController::coachStep2');
$routes->post('/register/coach/step2', 'RegisterController::coachStep2Submit');
$routes->get('/register/coach/step3', 'RegisterController::coachStep3');
$routes->post('/register/coach/step3', 'RegisterController::coachStep3Submit');
$routes->get('/register/coach/step4', 'RegisterController::coachStep4');
$routes->post('/register/coach/step4', 'RegisterController::coachStep4Submit');

// Activation AJAX endpoints
$routes->post('/register/coach/send-code', 'RegisterController::sendActivationCode');
$routes->post('/register/coach/activate-code', 'RegisterController::activateCode');

// Coach dashboard
$routes->get('/coach/dashboard', 'CoachController::dashboard');

// Parent registration flow
$routes->get('/register/parent/step1', 'RegisterController::parentStep1');
$routes->post('/register/parent/step1', 'RegisterController::parentStep1Submit');
$routes->get('/register/parent/step2', 'RegisterController::parentStep2');
$routes->post('/register/parent/step2', 'RegisterController::parentStep2Submit');
$routes->get('/register/parent/step3', 'RegisterController::parentStep3');
$routes->post('/register/parent/step3', 'RegisterController::parentStep3Submit');
$routes->get('/register/parent/step4', 'RegisterController::parentStep4');
$routes->post('/register/parent/step4', 'RegisterController::parentStep4Submit');
$routes->get('/register/parent/finish', 'RegisterController::parentFinish');

// Athlete registration flow
$routes->get('/register/athlete/step1', 'RegisterController::athleteStep1');
$routes->post('/register/athlete/step1', 'RegisterController::athleteStep1Submit');
$routes->get('/register/athlete/step2', 'RegisterController::athleteStep2');
$routes->post('/register/athlete/step2', 'RegisterController::athleteStep2Submit');
$routes->get('/register/athlete/step3', 'RegisterController::athleteStep3');
$routes->post('/register/athlete/step3', 'RegisterController::athleteStep3Submit');
$routes->get('/register/athlete/finish', 'RegisterController::athleteFinish');



// Admin auth and dashboard
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::loginPost');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/admin', 'AdminController::dashboard', ['filter' => 'admin']);

