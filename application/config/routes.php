<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;
$route['gallery'] = 'home/gallery';
$route['about'] = 'home/about';
$route['menu'] = 'home/menu';
$route['contact']['get'] = 'home/contact';
$route['contact']['post'] = 'home/contact_post';

$route['adminPanel/logout'] = 'adminPanel/home/logout';
$route['adminPanel/banner']['post'] = 'adminPanel/banner/get';
$route['adminPanel/gallery']['post'] = 'adminPanel/gallery/get';
$route['adminPanel/category']['post'] = 'adminPanel/category/get';
$route['adminPanel/menu']['post'] = 'adminPanel/menu/get';
$route['adminPanel/restaurant']['post'] = 'adminPanel/restaurant/get';
$route['adminPanel/orders']['post'] = 'adminPanel/orders/get';

$route['adminPanel/profile'] = 'adminPanel/home/profile';
$route['adminPanel/create_qr'] = 'adminPanel/home/create_qr';
$route['adminPanel/database'] = 'adminPanel/home/database';
$route['adminPanel/forgot-password'] = 'adminPanel/login/forgot_password';
$route['adminPanel/checkOtp'] = 'adminPanel/login/checkOtp';
$route['adminPanel/changePassword'] = 'adminPanel/login/changePassword';