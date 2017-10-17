<?php 
$router->get('admin/user','UserController@index');

// ==============USERS==============

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


// ====================PRODUCTS_INFO==================
$router->get('admin/product_info','AdminProductInfoController@index');
$router->get('admin/product_info/add','AdminProductInfoController@add');
$router->post('admin/product_info/add','AdminProductInfoController@store');
$router->get('admin/product_info/delete','AdminProductInfoController@destroy');
$router->get('admin/product_info/edit','AdminProductInfoController@edit');
$router->post('admin/product_info/edit','AdminProductInfoController@update');
$router->get('admin/product_info/active','AdminProductInfoController@changeProductInfoActive');


// ====================PRODUCTS==================
$router->get('admin/products','AdminProductsController@index');
$router->get('admin/products/delete','AdminProductsController@destroy');
$router->get('admin/products/add','AdminProductsController@add');
$router->post('admin/products/add','AdminProductsController@store');
$router->get('admin/products/edit','AdminProductsController@edit');


//======================REGISTER==============
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