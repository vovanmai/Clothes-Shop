<?php 
// ========================PUBLIC SHOP===========
$router->get('','PublicController@index');
$router->get('men','PublicController@getProductInfoByGender');
$router->get('women','PublicController@getProductInfoByGender');
$router->get('cat/{id}','PublicController@cat');
$router->get('detail/{id}','PublicController@detail');
// ==============USERS==============
$router->get('admin','AdminProductInfoController@index');
$router->get('admin/users','UsersController@index');
$router->get('admin/users/add','UsersController@add');
$router->post('admin/users/add','UsersController@store');
$router->get('admin/users/add/check_username','UsersController@checkUsername');
$router->get('admin/users/add/check_add_email','UsersController@checkAddEmail');
$router->get('admin/users/add/check_edit_email','UsersController@checkEditEmail');
$router->get('admin/users/edit/{id}','UsersController@edit');
$router->post('admin/users/edit/{id}','UsersController@update');
$router->get('admin/users/delete/{id}','UsersController@destroy');
$router->post('admin/users/search','UsersController@search');
$router->post('admin/users/active','UsersController@changeActive');
$router->post('admin/users/search','UsersController@search');
$router->get('admin/users/search','UsersController@search');

//=====================COLORS====================
$router->get('admin/colors','ColorsController@index');
$router->get('admin/colors/add','ColorsController@add');
$router->post('admin/colors/add','ColorsController@store');
$router->post('admin/colors/edit','ColorsController@update');
$router->get('admin/colors/delete','ColorsController@destroy');

//=====================SIZES====================
$router->get('admin/sizes','SizesController@index');
$router->get('admin/sizes/add','SizesController@add');
$router->post('admin/sizes/add','SizesController@store');
$router->post('admin/sizes/edit','SizesController@update');
$router->get('admin/sizes/delete','SizesController@destroy');

// ====================PRODUCTS_INFO==================
$router->get('admin/product_info','AdminProductInfoController@index');
$router->get('admin/product_info/add','AdminProductInfoController@add');
$router->post('admin/product_info/add','AdminProductInfoController@store');
$router->get('admin/product_info/delete/{id}','AdminProductInfoController@destroy');
$router->get('admin/product_info/edit/{id}','AdminProductInfoController@edit');
$router->post('admin/product_info/edit','AdminProductInfoController@update');
$router->get('admin/product_info/active','AdminProductInfoController@changeProductInfoActive');


// ====================PRODUCTS==================
$router->get('admin/products','AdminProductsController@index');
$router->get('admin/products/delete/{id}','AdminProductsController@destroy');
$router->get('admin/products/add','AdminProductsController@add');
$router->post('admin/products/add','AdminProductsController@store');
$router->get('admin/products/edit/{id}','AdminProductsController@edit');
$router->post('admin/products/edit','AdminProductsController@update');


//======================REGISTER==============
$router->get('admin/login','AuthController@getLogin');
$router->post('admin/login','AuthController@postLogin');
$router->post('admin/remember','AuthController@remember');
$router->get('admin/logout','AuthController@getLogout');
$router->get('admin/mail','AuthController@getMail');
$router->get('admin/check','AuthController@getCheck');
$router->post('admin/check','AuthController@postCheck');
$router->post('admin/mail','AuthController@postMail');
$router->get('admin/newPass','AuthController@getNewPass');
$router->post('admin/newPass','AuthController@postNewPass');

//=====================ORDERS===================
$router->get('admin/orders','OrdersController@index');
$router->get('admin/orders/delete/{id}','OrdersController@destroy');
$router->post('admin/orders/search','OrdersController@search');
$router->get('admin/orders/activePaid','OrdersController@changeActivePaid');
$router->get('admin/orders/activeShipped','OrdersController@changeActiveShipped');
$router->get('admin/orders/search','OrdersController@search');
$router->get('admin/orders/updateStatus','OrdersController@updateStatus');
$router->get('admin/orders/detail/{id}','OrdersController@detail');
$router->post('admin/orders/destroyAll','OrdersController@destroyAll');


//=====================PUBLIC===================

$router->post('register','PublicController@addRegister');
$router->post('login','PublicController@postLogin');
$router->get('logout','PublicController@postLogout');

$router->get('home','PublicController@index');
$router->get('detail/{id}','PublicController@detail');
$router->get('men','PublicController@getProductInfoByGender');
$router->get('women','PublicController@getProductInfoByGender');
$router->post('search','PublicController@searchProduct');
$router->get('search','PublicController@searchProduct');
$router->post('getCat','PublicController@getCat');
$router->post('getGender','PublicController@getGender');
$router->post('detail/PlusNumber','PublicController@PlusNumber');
$router->post('detail/SubNumber','PublicController@SubNumber');
$router->post('detail/addCart','PublicController@addCart');
$router->get('detail/related/{cat}/{product}','PublicController@relatedProducts');
$router->get('cart','PublicController@cart');
$router->get('cart/delete/{id}','PublicController@delete');
$router->get('cart/updateCart','PublicController@updateCart');

$router->get('buy','PublicController@buy');
$router->post('buy/check','PublicController@check');
//$router->post('detail/quantity','ShopController@quantity');







//==================ERROR=======================
$router->get('*','ErrorController@error');
$router->post('*','ErrorController@error');

?>
