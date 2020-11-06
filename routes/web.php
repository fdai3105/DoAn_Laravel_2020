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

Route::get('/', 'HomeController@index');
Route::get('navbarData', 'HomeController@navbar'); // use in ajax
Route::get('/test', 'HomeController@sendReminderEmail'); // use in ajax
Route::resource('category', 'CategoryController');
Route::resource('brand', 'BrandController');
Route::resource('product', 'ProductController');
Route::get('search', 'ProductController@search')->name('search');

Route::post('login', 'LoginController@postLogin')->name('login');
Route::post('signup', 'LoginController@postSignup')->name('signup');
Route::get('logout', 'LoginController@logout')->name('logout');

Route::group(['middleware' => 'user'], function () {
    Route::resource('user', 'UserController');
    Route::resource('address', 'AddressController');

    Route::post('cart', 'CartController@addToCart');
    Route::get('cart', 'CartController@index');
    Route::post('changeQty', 'CartController@changeQty');
    Route::post('decreaseQty', 'CartController@decreaseQty');
    Route::post('incrementQty', 'CartController@incrementQty');
    Route::post('removeCart', 'CartController@removeCart');
    Route::post('checkout', 'CartController@checkout');
});


/**
 * adminPanel
 */
Route::group(['prefix' => 'admin', 'namespace' => 'admin'], function () {
    Route::get('login', ['as' => 'getLogin', 'uses' => 'AdminLoginController@getLogin']);
    Route::post('login', ['as' => 'postLogin', 'uses' => 'AdminLoginController@postLogin']);
    Route::get('logout', ['as' => 'getLogout', 'uses' => 'AdminLoginController@getLogout']);

    Route::group(['middleware' => 'admin'], function () {
        Route::group(['middleware' => 'locale'], function () {
            Route::get('change-language/{language}', 'AdminController@changeLanguage')
                ->name('change-language');
        });

        Route::resource('/', 'AdminController');
        Route::resource('products', 'AdminProductController');
        Route::resource('brands', 'AdminBrandController');
        Route::resource('categories', 'AdminCategoryController');
        Route::resource('users', 'AdminUserController');
        Route::resource('order', 'AdminOrderController');

        Route::get('categories/{id}/products', 'AdminCategoryController@products');
        Route::get('brands/{id}/products', 'AdminBrandController@products');

        Route::get('doanhthu', 'AdminController@doanhThu');
        Route::get('countOrderByMonth', 'AdminController@countOrderByMonth');
        Route::get('countCate', 'AdminController@countCate');
    });
});
