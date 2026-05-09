<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

//inscription et login
$routes->get('/','InscriptionController::index');
$routes->get('/inscription-administratif','InscriptionController::index');//vue du formulaire
$routes->post('register-identity','InscriptionController::Identity');
$routes->get('/inscription-sante','InscriptionController::viewHealth');
$routes->post('register-healthy','InscriptionController::Health');

$routes->get('/login','InscriptionController::viewLogin');
$routes->post('authentification','InscriptionController::log_in');
$routes->get('/logout', 'InscriptionController::log_out');


// test dahsboard : 
$routes->get('dashboard', 'DashboardController::index');
$routes->get('success', 'DashboardController::success'); // Page de réussite