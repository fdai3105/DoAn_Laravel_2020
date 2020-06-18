<?php

use App\Category;
use App\Product;
use App\ProductBrand;
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
Route::resource('product','ProductController');
Route::get('search', 'ProductController@search')->name('search');

/**
 * adminPanel
 */
Route::prefix('admin')->group(function () {
    Route::resource('/', 'admin\AdminController');
    
    Route::resource('products', 'admin\AdminProductController');
    Route::resource('brands', 'admin\AdminBrandController');
    Route::resource('categories', 'admin\AdminCategoryController');

    Route::get('brands/findProducts/{id}', 'admin\AdminBrandController@findProducts');
    Route::get('categoriesDisplay', 'admin\AdminCategoryController@display');
    Route::get('brandsDisplay', 'admin\AdminBrandController@display');
});

