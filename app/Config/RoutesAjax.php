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

$routes->group('ajax/item-units', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'ItemUnits\GetController::all');
    $routes->get('(:segment)', 'ItemUnits\GetController::get/$1');
    $routes->post('', 'ItemUnits\PostController::save');
    $routes->put('(:segment)', 'ItemUnits\PutController::save/$1');
    $routes->delete('(:segment)', 'ItemUnits\DeleteController::index/$1');
});

$routes->group('ajax/user-categories', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'UserCategories\GetController::all');
    $routes->get('(:segment)', 'UserCategories\GetController::get/$1');
    $routes->post('', 'UserCategories\PostController::save');
    $routes->put('(:segment)', 'UserCategories\PutController::save/$1');
    $routes->delete('(:segment)', 'UserCategories\DeleteController::index/$1');
});

$routes->group('ajax/warehouses', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'Warehouses\GetController::paginated');
    $routes->get('(:segment)', 'Warehouses\GetController::get/$1');
    $routes->post('', 'Warehouses\PostController::index');
    $routes->put('(:segment)', 'Warehouses\PutController::save/$1');
    $routes->delete('(:segment)', 'Warehouses\DeleteController::index/$1');
});

$routes->group('ajax/warehouse-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'WarehouseStatus\GetController::all');
    $routes->get('(:segment)', 'WarehouseStatus\GetController::get/$1');
    $routes->post('', 'WarehouseStatus\PostController::save');
    $routes->put('(:segment)', 'WarehouseStatus\PutController::save/$1');

    $routes->delete('(:segment)', 'WarehouseStatus\DeleteController::index/$1');;

});

    $routes->group('ajax/urgency-levels', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'UrgencyLevels\GetController::all');
    $routes->get('(:segment)', 'UrgencyLevels\GetController::get/$1');
    $routes->post('', 'UrgencyLevels\PostController::save');
    $routes->put('(:segment)', 'UrgencyLevels\PutController::save/$1');
    $routes->delete('(:segment)', 'UrgencyLevels\DeleteController::index/$1');
});

$routes->group('ajax/items', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'Items\GetController::paginated');
    $routes->get('(:segment)', 'Items\GetController::get/$1');
    $routes->post('', 'Items\PostController::save');
    $routes->put('(:segment)', 'Items\PutController::save/$1');

    $routes->delete('(:segment)', 'Items\DeleteController::index/$1');
});


$routes->group('ajax/warehouse-locations', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'WarehouseLocations\GetController::paginated');
    $routes->get('(:segment)', 'WarehouseLocations\GetController::get/$1');
    $routes->put('(:segment)/toggle/status', 'WarehouseLocations\ToggleController::status/$1');
    $routes->put('(:segment)/toggle/visible', 'WarehouseLocations\ToggleController::visible/$1');
    $routes->post('', 'WarehouseLocations\PostController::save');
    $routes->put('(:segment)', 'WarehouseLocations\PutController::save/$1');

    $routes->delete('(:segment)', 'WarehouseLocations\DeleteController::index/$1');
});

$routes->group('/invoices', ['filter' => 'isUser:administrator'], function ($routes) {
    $routes->get('', 'Invoices\GetController::index');
    $routes->get('create', 'Invoices\PostController::index');
    $routes->get('(:segment)/edit', 'Invoices\PutController::index/$1');

});

$routes->group('ajax/invoice-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'InvoiceStatus\GetController::all');
    $routes->get('(:segment)', 'InvoiceStatus\GetController::get/$1');
    $routes->post('', 'InvoiceStatus\PostController::save');
    $routes->put('(:segment)', 'InvoiceStatus\PutController::save/$1');

    $routes->delete('(:segment)', 'InvoiceStatus\DeleteController::index/$1');;

});

$routes->group('ajax/quotation-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'QuotationStatus\GetController::all');
    $routes->get('(:segment)', 'QuotationStatus\GetController::get/$1');
    $routes->post('', 'QuotationStatus\PostController::save');
    $routes->put('(:segment)', 'QuotationStatus\PutController::save/$1');

    $routes->delete('(:segment)', 'QuotationStatus\DeleteController::index/$1');;
});



$routes->group('ajax/purchase-request-status', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'PurchaseRequestStatus\GetController::all');
    $routes->get('(:segment)', 'PurchaseRequestStatus\GetController::get/$1');
    $routes->post('', 'PurchaseRequestStatus\PostController::save');
    $routes->put('(:segment)', 'PurchaseRequestStatus\PutController::save/$1');
    $routes->delete('(:segment)', 'PurchaseRequestStatus\DeleteController::index/$1');;

});

$routes->group('ajax/purchase-requests', ['filter' => 'isAjaxUser:administrator'], function ($routes) {
    $routes->get('', 'PurchaseRequests\GetController::paginated');
    $routes->get('(:segment)', 'PurchaseRequests\GetController::get/$1');
    $routes->put('(:segment)/toggle/status', 'PurchaseRequests\ToggleController::status/$1');
    $routes->put('(:segment)/toggle/visible', 'PurchaseRequests\ToggleController::visible/$1');
    $routes->post('', 'PurchaseRequests\PostController::save');
    $routes->put('(:segment)', 'PurchaseRequests\PutController::save/$1');

    $routes->delete('(:segment)', 'PurchaseRequests\DeleteController::index/$1');
});