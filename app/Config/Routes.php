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

$routes->group('/item-units', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'ItemUnits\GetController::index');
    $routes->get('create', 'ItemUnits\PostController::index');
    $routes->get('(:segment)/edit', 'ItemUnits\PutController::index/$1');

});
$routes->group('/user-categories', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'UserCategories\GetController::index');
    $routes->get('create', 'UserCategories\PostController::index');
    $routes->get('(:segment)/edit', 'UserCategories\PutController::index/$1');

});

$routes->group('/warehouses', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Warehouses\GetController::index');
    $routes->get('create', 'Warehouses\PostController::index');
    $routes->get('(:segment)/edit', 'Warehouses\PutController::index/$1');

});

$routes->group('/warehouse-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'WarehouseStatus\GetController::index');

});

$routes->group('/urgency-levels', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'UrgencyLevels\GetController::index');
    $routes->get('create', 'UrgencyLevels\PostController::index');
    $routes->get('(:segment)/edit', 'UrgencyLevels\PutController::index/$1');

});

$routes->group('/items', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Items\GetController::index');
    $routes->get('create', 'Items\PostController::index');
    $routes->get('(:segment)/edit', 'Items\PutController::index/$1');

});


$routes->group('/warehouse-locations', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'WarehouseLocations\GetController::index');
    $routes->get('create', 'WarehouseLocations\PostController::index');
    $routes->get('(:segment)/edit', 'WarehouseLocations\PutController::index/$1');
   
});
$routes->group('/invoices', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Invoices\GetController::index');
    $routes->get('create', 'Invoices\PostController::index');
    $routes->get('(:segment)/edit', 'Invoices\PutController::index/$1');

});

$routes->group('/invoice-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'InvoiceStatus\GetController::index');

});

$routes->group('/quotation-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'QuotationStatus\GetController::index');

});



$routes->group('/purchase-request-status', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'PurchaseRequestStatus\GetController::index');
});

$routes->group('/purchase-requests', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'PurchaseRequests\GetController::index');
    $routes->get('create', 'PurchaseRequests\PostController::index');
    $routes->get('(:segment)/edit', 'PurchaseRequests\PutController::index/$1');

});