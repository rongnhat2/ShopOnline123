<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('User')->group(function () {
    Route::get('/', 'FrontController@index')->name('user.index');
    Route::get('product-detail/{slug}', 'FrontController@product_detail')->name('customer.product_detail');
    Route::get('shopping-cart', 'FrontController@shopping_cart')->name('customer.shopping_cart');
    Route::get('purchase/user', 'FrontController@purchase')->name('customer.purchase');
    Route::get('purchase/history', 'FrontController@history')->name('customer.history');
    Route::get('purchase/history-detail/{id}', 'FrontController@historyDetail')->name('customer.historyDetail');
    Route::get('contact-us', 'FrontController@contact')->name('customer.contact');

    Route::get('shop-list/{slug}', 'FrontController@shop_list')->name('customer.shop_list');
    Route::get('checkout', 'FrontController@checkout')->name('customer.checkout');
    Route::get('submit-cart', 'FrontController@submit_cart')->name('customer.submit_cart');

    Route::get('vnpayment', 'PaymentController@get_pay')->name('customer.get_pay');
    Route::post('payment', 'PaymentController@create_pay')->name('customer.create_pay');
    Route::get('return-vnpay', 'PaymentController@return_pay')->name('customer.return_vnpay');

    Route::post('search', 'FrontController@search')->name('customer.search');

    Route::post('add-to-cart', 'CartController@add_to_cart')->name('customer.add_to_cart');
    Route::post('update-cart/{id}/{item_id}', 'CartController@update_cart')->name('customer.update_cart');
    Route::get('delete-cart/{id}/{item_id}', 'CartController@delete_cart')->name('customer.delete_cart');


    Route::get('clear', 'CartController@clear')->name('customer.clear');
    
    // AJAX
    Route::get('product_view', 'FrontController@view')->name('product.view');
    // Route::get('product_quantity', 'FrontController@quantity')->name('product.quantity');
    // END AJAX

   	Route::get('/login', 'LoginController@getLogin')->name('user.login');
   	Route::post('/login', 'LoginController@postlogin')->name('user.postlogin');

   	Route::get('register', 'RegisterController@showRegisterForm')->name('user.getregister');
   	Route::post('/register', 'RegisterController@store')->name('user.register');

   	Route::get('change-password', 'ResetPasswordController@forgotPass')->name('user.getpassword');
    Route::post('reset-password', 'ResetPasswordController@sendMail')->name('user.postpassword');
    Route::get('update-password', 'ResetPasswordController@resetPass')->name('user.updatepassword');
    Route::post('update-password', 'ResetPasswordController@postResetPassword')->name('user.updatepassword');


    Route::post('post-update', 'FrontController@updateData')->name('user.update');

    Route::post('logout', 'LoginController@logout')->name('user.logout');

  	Route::group(['middleware' => ['auth']], function () {

  	});
});
