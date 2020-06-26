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
Route::resource('category', 'CategoryController');
Route::resource('brand', 'BrandController');
Route::resource('product', 'ProductController');
Route::get('search', 'ProductController@search')->name('search');

// Route::get('signup', 'LoginController@getSignup')->name('signup');
Route::post('signup', 'LoginController@postSignup')->name('signup');
// Route::get('login', 'LoginController@getLogin')->name('login');
Route::post('login', 'LoginController@postLogin')->name('login');
Route::get('logout', 'LoginController@logout')->name('logout');

/**
 * adminPanel
 */
Route::group(['prefix' => 'admin','namespace' => 'admin'], function () {
    Route::get('login', ['as' => 'getLogin', 'uses' => 'AdminLoginController@getLogin']);
    Route::post('login', ['as' => 'postLogin', 'uses' => 'AdminLoginController@postLogin']);
    Route::get('logout', ['as' => 'getLogout', 'uses' => 'AdminLoginController@getLogout']);

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('/', 'AdminController');

        Route::resource('products', 'AdminProductController');
        Route::resource('brands', 'AdminBrandController');
        Route::resource('categories', 'AdminCategoryController');

        Route::get('categories/findProducts/{id}', 'AdminCategoryController@findProducts');
        Route::get('brands/findProducts/{id}', 'AdminBrandController@findProducts');
        Route::get('categoriesDisplay', 'AdminCategoryController@display');
        Route::get('brandsDisplay', 'AdminBrandController@display');
    });
});
