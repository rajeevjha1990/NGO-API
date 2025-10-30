<?php
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Admin_auth::login');
$routes->post('/auth/dologin', 'Admin_auth::dologin');
$routes->get('/auth/logout', 'Admin_auth::logout');
$routes->get('/auth/group_edit_requests', 'Admin_auth::group_edit_requests');
$routes->get('/adminauth/permission_granted/(:num)/(:num)', 'Admin_auth::permission_granted/$1/$2');
$routes->get('dashboard', 'Dashboard::index');


$routes->group('api/auth', function($routes) {
    $routes->match(['post','options'], 'login', 'Api\Auth::login');
    $routes->match(['post','options'], 'volunteer_register', 'Api\Auth::volunteer_register');
    $routes->match(['post','options'], 'get_volunteer', 'Api\Auth::get_volunteer');
    $routes->match(['post','options'], 'get_volunteer', 'Api\Auth::get_volunteer');
    $routes->match(['post','options'], 'logout', 'Api\Auth::logout');
    $routes->match(['post','options'], 'update_profile', 'Api\Auth::update_profile');
    $routes->match(['post','options'], 'get_profile', 'Api\Auth::get_profile');
});
$routes->group('api/common', function($routes) {
    $routes->match(['post','options'], 'qualifications', 'Api\Common::qualifications');
    $routes->match(['post','options'], 'getPrograms', 'Api\Common::getPrograms');
    $routes->match(['post','options'], 'new_group', 'Api\Common::new_group');
    $routes->match(['post','options'], 'epGropus', 'Api\Common::epGropus');
    $routes->match(['post','options'], 'getMembers', 'Api\Common::getMembers');
    $routes->match(['post','options'], 'update_role', 'Api\Common::update_role');
    $routes->match(['post','options'], 'request_edit_group', 'Api\Common::request_edit_group');
    $routes->match(['post','options'], 'getAllEditRequests', 'Api\Common::getAllEditRequests');
    $routes->match(['post','options'], 'get_groupdata', 'Api\Common::get_groupdata');

});
