<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "wall/signin";
$route['admin_edit/(:any)'] = "wall/admin_edit/$1";
$route['admin_remove/(:any)'] = "wall/admin_remove/$1";
$route['admin_profile'] = "wall/admin_profile";
$route['admin_update_info/(:any)'] = "wall/admin_update_info/$1";
$route['admin_update_description/(:any)'] = "wall/admin_update_description/$1";
$route['admin_update_password/(:any)'] = "wall/admin_update_password/$1";
$route['login'] = "wall/login";
$route['dashboard'] = "wall/dashboard";
$route['admin_dashboard'] = "wall/admin_dashboard";
$route['profile'] = "wall/profile";
$route['update_info'] = "wall/update_info";
$route['update_password'] = "wall/update_password";
$route['update_description'] = "wall/update_description";
$route['register_user'] = "wall/register_user";
$route['register'] = "wall/register";
$route['404_override'] = '';
$route['post_comment/(:any)'] = "wall/add_comment/$1";
$route['post_message/(:any)'] = "wall/add_message/$1";
$route['signout'] = "wall/signout";
$route['show/(:any)'] = 'wall/user_wall/$1';

