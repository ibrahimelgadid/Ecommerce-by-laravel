<?php

/*
|-------------------------------------
| Languages Routes
|-------------------------------------
*/
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});



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

Route::get('admin/dashboard','AdminCtrls\DashboardController@index');
Route::get('admin/login','Admin\LoginController@showLoginForm');
Route::post('admin/login','Admin\LoginController@login')->name('admin/login');

Route::get('admin/register','Admin\RegisterController@showRegisterForm');
Route::post('admin/register','Admin\RegisterController@Register')->name('admin/register');

Route::post('admin-password/email','Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin-password/reset','Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/reset','Admin\ResetPasswordController@reset');
Route::get('admin-password/reset/{token}','Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');

// Route::post('admin/logout', ['as' => 'admin/logout', 'uses' => 'Admin\LoginController@logout']);
Route::post('admin/logout','Admin\LoginController@logout')->name('admin/logout');

/*
|-------------------------------------
| Categories Routes
|-------------------------------------
*/

Route::resource('admin/categories','AdminCtrls\CategoriesController');
Route::get('admin/categories/activate/{id}','AdminCtrls\CategoriesController@activate');
Route::get('admin/categories/inActivate/{id}','AdminCtrls\CategoriesController@inActivate');
Route::post('admin/categories/search','AdminCtrls\CategoriesController@search')->name('admin/categories.search');


/*
|-------------------------------------
| Brands Routes
|-------------------------------------
*/
Route::resource('admin/brands','AdminCtrls\brandsController');
Route::get('admin/brands/activate/{id}','AdminCtrls\brandsController@activate');
Route::get('admin/brands/inActivate/{id}','AdminCtrls\brandsController@inActivate');
Route::post('admin/brands/search','AdminCtrls\brandsController@search')->name('admin/brands.search');
// ------------------------------------



/*
|-------------------------------------
| Products Routes
|-------------------------------------
*/
Route::resource('admin/products','AdminCtrls\productsController');
Route::get('admin/products/activate/{id}','AdminCtrls\productsController@activate');
Route::get('admin/products/inActivate/{id}','AdminCtrls\productsController@inActivate');
Route::post('admin/products/search','AdminCtrls\productsController@search')->name('admin/products.search');
Route::post('admin/products/upload_images/{id}','AdminCtrls\productsController@upload_images');
Route::get('admin/products/deleteGallaryImage/{id}','AdminCtrls\productsController@deleteGallaryImage');
Route::get('admin/products/deleteGallary/{id}','AdminCtrls\productsController@deleteGallary');

/*
|-------------------------------------
| Members Routes
|-------------------------------------
*/
Route::resource('admin/members','AdminCtrls\MembersController');
Route::get('admin/amembers','AdminCtrls\DashboardController@activeMembers');
Route::get('admin/pmembers','AdminCtrls\DashboardController@pendingMembers');

Route::get('admin/members/activate/{id}','AdminCtrls\MembersController@activate');
Route::get('admin/members/inActivate/{id}','AdminCtrls\MembersController@inActivate');
Route::post('admin/members/search','AdminCtrls\MembersController@search')->name('admin/members.search');

/*
|-------------------------------------
| Siders Routes
|-------------------------------------
*/
Route::resource('admin/sliders','AdminCtrls\SliderController');
Route::get('admin/sliders/activate/{id}','AdminCtrls\SliderController@activate');
Route::get('admin/sliders/inActivate/{id}','AdminCtrls\SliderController@inActivate');
Route::post('admin/sliders/search','AdminCtrls\SliderController@search')->name('admin/sliders.search');



/*
|-------------------------------------
| Profile Routes
|-------------------------------------
*/

Route::resource('profile','UserCtrls\ProfileController');


/*                                   
|------------------------------------|
| Home Routes                        |
|------------------------------------|
*/
Route::get('/', 'UserCtrls\HomeController@index');
Route::post('search','UserCtrls\HomeController@search');
Route::get('show/{id}','UserCtrls\HomeController@show');
Route::get('getProByCat/{id}','UserCtrls\HomeController@getProByCat');
Route::get('getProByBrand/{id}','UserCtrls\HomeController@getProByBrand');

/*
|-------------------------------------
| Cart Routes
|-------------------------------------
*/
Route::get('/cart', 'UserCtrls\CartController@index');
Route::post('/add_cart', 'UserCtrls\CartController@add_to_cart');
Route::put('/update_cart/{id}', 'UserCtrls\CartController@update_cart');
Route::delete('/delete_cart/{id}', 'UserCtrls\CartController@delete_cart');
Route::delete('/clear_cart', 'UserCtrls\CartController@clear_cart');

/*
|-------------------------------------
| Shipping Front Routes
|-------------------------------------
*/

Route::get('/thank', 'UserCtrls\CheckoutController@thank');
Route::post('/checkout', 'UserCtrls\CheckoutController@checkout');
Route::get('/paypal/payment', 'UserCtrls\CheckoutController@paypal');


/*
|-------------------------------------
| Checkout Routes
|-------------------------------------
*/

Route::resource('admin/shipping', 'AdminCtrls\ShippingController');

/*
|-------------------------------------
| Orders Routes
|-------------------------------------
*/
Route::get('admin/order/activate/{id}','AdminCtrls\OrderController@activate');
Route::get('admin/order/inActivate/{id}','AdminCtrls\OrderController@inActivate');
Route::get('admin/order/done/{id}','AdminCtrls\OrderController@done');
Route::post('admin/order/search','AdminCtrls\OrderController@search')->name('order.search');
Route::resource('admin/orders','AdminCtrls\OrderController');


/*
|-------------------------------------
| Orders Front Routes
|-------------------------------------
*/
Route::get('myorders','UserCtrls\HomeController@orders');