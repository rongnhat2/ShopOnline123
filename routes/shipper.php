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

Route::namespace('Shipper')->group(function () {
  	Route::get('/login', 'LoginController@showLoginForm')->name('admin_ship.login');
  	Route::post('/login', 'LoginController@login')->name('admin_ship.postlogin');
  	Route::get('/order_index', 'OrderController@order_index')->name('admin_ship.order_index');
	Route::post('logout', 'LoginController@logout')->name('admin_ship.logout');
  	Route::group(['middleware' => ['auth']], function () {
      	Route::get('/home', 'HomeController@index');
  	});
});
