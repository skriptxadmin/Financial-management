<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('ajax/guest', function ($routes) {
    $routes->post('login', 'Guest\LoginController::login');
    $routes->post('forgot-password', 'Guest\ForgotPasswordController::forgot_password');
    $routes->post('set-password', 'Guest\SetPasswordController::set_password');
});

$routes->group('ajax/user-roles', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'UserRoles\GetController::all');
    $routes->get('(:segment)', 'UserRoles\GetController::get/$1');
    $routes->post('', 'UserRoles\PostController::save');
    $routes->put('(:segment)', 'UserRoles\PutController::save/$1');

    $routes->delete('(:segment)', 'UserRoles\DeleteController::index/$1');
});

$routes->group('ajax/users', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'Users\GetController::paginated');
    $routes->get('(:segment)', 'Users\GetController::get/$1');
    $routes->put('(:segment)/toggle/block', 'Users\ToggleController::block/$1');
    $routes->put('(:segment)/toggle/visible', 'Users\ToggleController::visible/$1');
    $routes->post('', 'Users\PostController::save');
    $routes->put('(:segment)', 'Users\PutController::save/$1');

    $routes->delete('(:segment)', 'Users\DeleteController::index/$1');
});

$routes->group('ajax/companies', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'Companies\GetController::paginated');
    $routes->get('(:segment)', 'Companies\GetController::get/$1');
    $routes->put('(:segment)/toggle/status', 'Companies\ToggleController::status/$1');
    $routes->put('(:segment)/toggle/visible', 'Companies\ToggleController::visible/$1');
    $routes->post('', 'Companies\PostController::save');
    $routes->put('(:segment)', 'Companies\PutController::save/$1');

    $routes->delete('(:segment)', 'Companies\DeleteController::index/$1');
});

$routes->group('ajax/company-categories', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyCategories\GetController::all');
    $routes->get('(:segment)', 'CompanyCategories\GetController::get/$1');
    $routes->post('', 'CompanyCategories\PostController::save');
    $routes->put('(:segment)', 'CompanyCategories\PutController::save/$1');
    $routes->delete('(:segment)', 'CompanyCategories\DeleteController::index/$1');
});

$routes->group('ajax/company-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyStatus\GetController::all');
    $routes->get('(:segment)', 'CompanyStatus\GetController::get/$1');
    $routes->post('', 'CompanyStatus\PostController::save');
    $routes->put('(:segment)', 'CompanyStatus\PutController::save/$1');

    $routes->delete('(:segment)', 'CompanyStatus\DeleteController::index/$1');;

});

$routes->group('ajax/company-contact-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyContactStatus\GetController::all');
    $routes->get('(:segment)', 'CompanyContactStatus\GetController::get/$1');
    $routes->post('', 'CompanyContactStatus\PostController::save');
    $routes->put('(:segment)', 'CompanyContactStatus\PutController::save/$1');

    $routes->delete('(:segment)', 'CompanyContactStatus\DeleteController::index/$1');;

});

$routes->group('ajax/company-contacts', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'CompanyContacts\GetController::paginated');
    $routes->get('(:segment)', 'CompanyContacts\GetController::get/$1');
    $routes->put('(:segment)/toggle/status', 'CompanyContacts\ToggleController::status/$1');
    $routes->put('(:segment)/toggle/visible', 'CompanyContacts\ToggleController::visible/$1');
    $routes->put('(:segment)/toggle/working', 'CompanyContacts\ToggleController::working/$1');
    $routes->post('', 'CompanyContacts\PostController::save');
    $routes->put('(:segment)', 'CompanyContacts\PutController::save/$1');

    $routes->delete('(:segment)', 'CompanyContacts\DeleteController::index/$1');
});

$routes->group('ajax/item-categories', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'ItemCategories\GetController::all');
    $routes->get('(:segment)', 'ItemCategories\GetController::get/$1');
    $routes->post('', 'ItemCategories\PostController::save');
    $routes->put('(:segment)', 'ItemCategories\PutController::save/$1');
    $routes->delete('(:segment)', 'ItemCategories\DeleteController::index/$1');
});
