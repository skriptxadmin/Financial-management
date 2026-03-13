<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Guest\LoginController::index');
$routes->get('/forgot-password', 'Guest\ForgotPasswordController::index');
$routes->get('/set-password', 'Guest\SetPasswordController::index');



$routes->group('/', ['filter' => 'isUser:administrator,subscriber'], function ($routes) {
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('profile', 'User\ProfileController::index');
    $routes->get('logout', 'User\LogoutController::index');
});

$routes->group('/users', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Users\GetController::index');
    $routes->get('create', 'Users\PostController::index');
    $routes->get('(:segment)/edit', 'Users\PutController::index/$1');
   
});

$routes->group('/user-roles', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'UserRoles\GetController::index');
   
});

$routes->group('/companies', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Companies\GetController::index');
    $routes->get('create', 'Companies\PostController::index');
    $routes->get('(:segment)/edit', 'Companies\PutController::index/$1');
   
});

$routes->group('/company-categories', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyCategories\GetController::index');
   
});

$routes->group('/company-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyStatus\GetController::index');
   
});

$routes->group('/company-contact-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyContactStatus\GetController::index');
   
});


$routes->group('/company-contacts', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('(:segment)', 'CompanyContacts\GetController::index/$1');
    $routes->get('', 'CompanyContacts\GetController::index');
    $routes->get('(:segment)/create', 'CompanyContacts\PostController::index/$1');
    $routes->get('(:segment)/(:segment)/edit', 'CompanyContacts\PutController::index/$1/$2');
   
});

$routes->group('/item-categories', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'ItemCategories\GetController::index');
    $routes->get('create', 'ItemCategories\PostController::index');
    $routes->get('(:segment)/edit', 'ItemCategories\PutController::index/$1');
   
});