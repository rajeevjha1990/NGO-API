<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//Auth APIs (login, get user)
// $routes->group('api', ['filter' => 'auth'], function($routes) {
//     $routes->post('consumer/get-profile', 'Consumer::getProfile');
//     // Add all protected routes here
// });

$routes->group('api/auth', function($routes) {
    $routes->match(['post','options'], 'login', 'Api\Auth::login');
    $routes->match(['post','options'], 'volunteer_register', 'Api\Auth::volunteer_register');
    $routes->match(['post','options'], 'get_volunteer', 'Api\Auth::get_volunteer');
    $routes->match(['post','options'], 'get_volunteer', 'Api\Auth::get_volunteer');
    $routes->match(['post','options'], 'logout', 'Api\Auth::logout');
    $routes->match(['post','options'], 'update_profile', 'Api\Auth::update_profile');
});
$routes->group('api/common', function($routes) {
    $routes->match(['post','options'], 'qualifications', 'Api\Common::qualifications');
});
