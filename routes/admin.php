<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::namespace('Admin')->group(function () {
   	Route::get('/login', 'LoginController@getLogin')->name('admin.getlogin');
   	Route::post('/login', 'LoginController@postlogin')->name('admin.postlogin');

   	Route::get('register', 'RegisterController@showRegisterForm')->name('admin.getregister');
   	Route::post('/register', 'RegisterController@store')->name('admin.register');

   	Route::get('change-password', 'PasswordController@getpassword')->name('admin.getpassword');
   	Route::post('post-password', 'PasswordController@postpassword')->name('admin.postpassword');

	Route::post('logout', 'LoginController@logout')->name('admin.logout');

   	Route::group(['middleware' => ['auth:admin']], function () {


        // analytic
        Route::get('/analytic', 'AnalyticController@analytic')->name('admin.analytic');
        
        // order
        Route::prefix('customer')->group(function () {
            Route::get('/', 'CustomerController@customer_data')->name('customer_data.index');
        });
        // order
        Route::middleware(['checkacl:order'])->prefix('order')->group(function () {
            Route::get('/', 'OrderController@new_order')->name('order.new_order');
            Route::get('/detail_order/{id}', 'OrderController@detail_order')->name('order.detail_order');
            Route::post('/detail_order/{id}', 'OrderController@assignment_order')->name('order.detail_order');
            Route::get('trans_order', 'OrderController@trans_order')->name('order.trans_order');
            Route::get('trans_detail/{id}', 'OrderController@trans_detail')->name('order.trans_detail');
            Route::get('trans_update/{c_id}/{id}', 'OrderController@trans_update')->name('order.trans_update');
            Route::get('history', 'OrderController@history')->name('order.history');
            Route::get('history_detail/{id}', 'OrderController@history_detail')->name('order.history_detail');
        });

        // History warehouse
        Route::prefix('history')->group(function () {
            Route::get('/', 'ItemController@warehouse')->name('item.warehouse');
        });

        // modulle shipper
        Route::middleware(['checkacl:order'])->prefix('shipper')->group(function () {
            Route::get('/', 'ShipperController@index')->name('shipper.index');
            Route::get('/create', 'ShipperController@create')->name('shipper.add');
            Route::post('/create', 'ShipperController@store')->name('shipper.store');
            Route::get('/edit/{id}', 'ShipperController@edit')->name('shipper.edit');
            Route::post('/edit/{id}', 'ShipperController@update')->name('shipper.edit');
            Route::get('/delete/{id}', 'ShipperController@delete')->name('shipper.delete');
        });

        // modulle item
        Route::middleware(['checkacl:item'])->prefix('item')->group(function () {
            Route::get('/', 'ItemController@index')->name('item.index');
            Route::get('/create', 'ItemController@create')->name('item.add');

            Route::post('/create', 'ItemController@store')->name('item.store');
            Route::get('/edit/{id}', 'ItemController@edit')->name('item.edit');

            Route::post('/edit/{id}', 'ItemController@update')->name('item.edit');
            Route::get('/delete/{id}', 'ItemController@delete')->name('item.delete');

            Route::get('/createQuantity/{id}/{c_id}', 'ItemController@createQuantity')->name('item.quantity');
            Route::post('/createQuantity/{id}/{c_id}', 'ItemController@storeQuantity')->name('item.quantity');

            Route::get('/{id}/createCopy', 'ItemController@createCopy')->name('item.copy');
            Route::post('/{id}/createCopy', 'ItemController@storeCopy')->name('item.copy');
            Route::get('/{id}/deleteCopy/{c_id}', 'ItemController@deleteCopy')->name('item.copydelete');

            Route::get('/{id}/createDetail', 'ItemController@createDetail')->name('item.detail');
            Route::post('/{id}/createDetail', 'ItemController@storeDetail')->name('item.detail');

            Route::get('/{id}/createImage', 'ItemController@createImage')->name('item.image');
            Route::post('/{id}/createImage', 'ItemController@storeImage')->name('item.image');
            Route::get('/{id}/deleteImage/{c_id}', 'ItemController@deleteImage')->name('item.imagedelete');
        });

        // modulle item description
        Route::middleware(['checkacl:item'])->prefix('item_description')->group(function () {
            // Danh mục
            Route::get('indexCategory', 'ItemdetailController@indexCategory')->name('item_description.indexCategory');
            Route::post('indexCategory', 'ItemdetailController@storeCategory')->name('item_description.storeCategory');
            Route::get('/deleteCategory/{id}', 'ItemdetailController@deleteCategory')->name('item_description.deleteCategory');
            // Chất liệu
            Route::get('indexComposition', 'ItemdetailController@indexComposition')->name('item_description.indexComposition');
            Route::post('indexComposition', 'ItemdetailController@storeComposition')->name('item_description.storeComposition');
            Route::get('/deleteComposition/{id}', 'ItemdetailController@deleteComposition')->name('item_description.deleteComposition');
            // Phong cách
            Route::get('indexStyle', 'ItemdetailController@indexStyle')->name('item_description.indexStyle');
            Route::post('indexStyle', 'ItemdetailController@storeStyle')->name('item_description.storeStyle');
            Route::get('/deleteStyle/{id}', 'ItemdetailController@deleteStyle')->name('item_description.deleteStyle');
            // Thuộc tính
            Route::get('indexProperty', 'ItemdetailController@indexProperty')->name('item_description.indexProperty');
            Route::post('indexProperty', 'ItemdetailController@storeProperty')->name('item_description.storeProperty');
            Route::get('/deleteProperty/{id}', 'ItemdetailController@deleteProperty')->name('item_description.deleteProperty');
        });

        // modulle carousel
        Route::prefix('carousel')->group(function () {
            Route::get('index', 'CarouselController@index')->name('carousel.index');
            Route::post('/create', 'CarouselController@store')->name('carousel.store');
            Route::get('/edit/{id}', 'CarouselController@edit')->name('carousel.edit');
            Route::post('/edit/{id}', 'CarouselController@update')->name('carousel.edit');
            Route::get('/delete/{id}', 'CarouselController@delete')->name('carousel.delete');
        });

        // modulle gallery
        Route::prefix('gallery')->group(function () {
            Route::get('gallery-index', 'ImageController@index')->name('gallery.index');
            Route::get('gallery-create', 'ImageController@create')->name('gallery.create');
            Route::post('gallery-store', 'ImageController@store')->name('gallery.store');
            Route::get('gallery-cropper', 'ImageController@cropper')->name('gallery.cropper');
            Route::get('getLibrary', 'ImageController@getLibrary')->name('gallery.getLibrary');
        });

        // modulle user
        Route::middleware(['checkacl:users'])->prefix('users')->group(function () {
            Route::get('/', 'UserController@index')->name('admin.index');
            Route::get('/create', 'UserController@create')->name('admin.add');
            Route::post('/create', 'UserController@store')->name('admin.store');
            Route::get('/edit/{id}', 'UserController@edit')->name('admin.edit');
            Route::post('/edit/{id}', 'UserController@update')->name('admin.edit');
            Route::get('/delete/{id}', 'UserController@delete')->name('admin.delete');
        });
        // module role
        Route::middleware(['checkacl:roles'])->prefix('roles')->group(function () {

            Route::get('/', 'RoleController@index')->name('role.index');
            Route::get('/create', 'RoleController@create')->name('role.add');
            Route::post('/create', 'RoleController@store')->name('role.store');
            Route::get('/edit/{id}', 'RoleController@edit')->name('role.edit');
            Route::post('/edit/{id}', 'RoleController@update')->name('role.edit');
            Route::get('/delete/{id}', 'RoleController@delete')->name('role.delete');
        });

        Route::get('home', 'HomeController@index')->name('admin.home');
   	});
});

