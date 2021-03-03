<?php defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error_404';
$route['translate_uri_dashes'] = TRUE;
$route['adminPanel/logout'] = 'adminPanel/home/logout';
$route['adminPanel/banner']['post'] = 'adminPanel/banner/get';
$route['adminPanel/gallery']['post'] = 'adminPanel/gallery/get';
$route['adminPanel/category']['post'] = 'adminPanel/category/get';
$route['adminPanel/menu']['post'] = 'adminPanel/menu/get';