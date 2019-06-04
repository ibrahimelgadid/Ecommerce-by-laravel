<?php

/*
|-------------------------------------
| Web Routes
|-------------------------------------
*/

Auth::routes();




/*
|--------------------------------------
| Admin Web Routes
|--------------------------------------
*/
Route::get('admin/dashboard','AdminController@index')->name('admin.dashboard');;
Route::get('admin','Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin','Admin\LoginController@login');

Route::get('admin/register','Admin\RegisterController@showRegisterForm')->name('admin.register');
Route::post('admin/register','Admin\RegisterController@Register');

Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset','Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

// Route::get('admin/logout','Admin\LoginController@logout')->name('admin.logout');

/*
|-------------------------------------
| Categories Routes
|-------------------------------------
*/

Route::resource('categories','CategoriesController');
Route::get('categories/activate/{id}','CategoriesController@activate');
Route::get('categories/inActivate/{id}','CategoriesController@inActivate');
Route::post('categories/search','CategoriesController@search')->name('categories.search');


/*
|-------------------------------------
| Brands Routes
|-------------------------------------
*/
Route::resource('brands','brandsController');
Route::get('brands/activate/{id}','brandsController@activate');
Route::get('brands/inActivate/{id}','brandsController@inActivate');
Route::post('brands/search','brandsController@search')->name('brands.search');
// ------------------------------------



/*
|-------------------------------------
| Products Routes
|-------------------------------------
*/
Route::resource('products','productsController');
Route::get('products/activate/{id}','productsController@activate');
Route::get('products/inActivate/{id}','productsController@inActivate');
Route::post('products/search','productsController@search')->name('products.search');
Route::post('products/upload_images/{id}','productsController@upload_images');
Route::get('products/deleteGallaryImage/{id}','productsController@deleteGallaryImage');
Route::get('products/deleteGallary/{id}','productsController@deleteGallary');

/*
|-------------------------------------
| Members Routes
|-------------------------------------
*/
Route::resource('members','MembersController');
Route::get('members/activate/{id}','MembersController@activate');
Route::get('members/inActivate/{id}','MembersController@inActivate');
Route::post('members/search','MembersController@search')->name('members.search');

/*
|-------------------------------------
| Siders Routes
|-------------------------------------
*/
Route::resource('sliders','SliderController');
Route::get('sliders/activate/{id}','SliderController@activate');
Route::get('sliders/inActivate/{id}','SliderController@inActivate');
Route::post('sliders/search','SliderController@search')->name('sliders.search');


/*                                   
|------------------------------------|
| Home Routes                        |
|------------------------------------|
*/
Route::get('/', 'HomeController@index');
Route::post('search','HomeController@search');
Route::get('show/{id}','HomeController@show');
Route::get('getProByCat/{id}','HomeController@getProByCat');
Route::get('getProByBrand/{id}','HomeController@getProByBrand');

/*
|-------------------------------------
| Cart Routes
|-------------------------------------
*/
Route::get('/cart', 'CartController@index');
Route::post('/add_cart', 'CartController@add_to_cart');
Route::put('/update_cart/{id}', 'CartController@update_cart');
Route::delete('/delete_cart/{id}', 'CartController@delete_cart');
Route::delete('/clear_cart', 'CartController@clear_cart');

/*
|-------------------------------------
| Shipping Routes
|-------------------------------------
*/
Route::get('/thank', 'ShippingController@thank');
Route::post('/checkout', 'ShippingController@checkout');
Route::resource('/shipping', 'ShippingController');
Route::get('/paypal/payment', 'ShippingController@paypal');

/*
|-------------------------------------
| Orders Routes
|-------------------------------------
*/
Route::get('order/activate/{id}','OrderController@activate');
Route::get('order/inActivate/{id}','OrderController@inActivate');
Route::get('order/done/{id}','OrderController@done');
Route::post('order/search','OrderController@search')->name('order.search');
Route::get('orders/all','HomeController@orders');
Route::resource('orders','OrderController');