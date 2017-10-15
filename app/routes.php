<?php 

$router->get('admin/user','UserController@index');


$router->get('admin/users','UsersController@index');
$router->get('admin/users/add','UsersController@add');
$router->post('admin/users/add','UsersController@store');
$router->get('admin/users/add/check_username','UsersController@checkUsername');
$router->get('admin/users/add/check_add_email','UsersController@checkAddEmail');
$router->get('admin/users/add/check_edit_email','UsersController@checkEditEmail');
$router->get('admin/users/edit/{id}','UsersController@edit');
$router->post('admin/users/edit/{id}','UsersController@update');
$router->get('admin/users/delete','UsersController@destroy');
$router->post('admin/users/search','UsersController@search');
$router->get('admin/users/active','UsersController@changeActive');
$router->post('admin/users/search','UsersController@search');
$router->get('admin/users/search','UsersController@search');

$router->get('admin/login','AuthController@getLogin');
$router->post('admin/login','AuthController@postLogin');
$router->post('admin/remember','AuthController@ajaxRemember');
$router->get('admin/logout','AuthController@getLogout');
$router->get('admin/mail','AuthController@getMail');
$router->get('admin/check','AuthController@getCheck');
$router->post('admin/check','AuthController@postCheck');
$router->post('admin/mail','AuthController@postMail');
$router->get('admin/newPass','AuthController@getNewPass');
$router->post('admin/newPass','AuthController@postNewPass');

//$router->get('admin/colors','ColorsController@index');
$router->get('','IndexController@index');

$router->get('*','ErrorController@error');
$router->post('*','ErrorController@error');





?>