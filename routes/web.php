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
Route::get('product/{name}', 'HomeController@productItem')->name('product');
Route::get('category/{name}', 'HomeController@categoryFilter')->name('category');
Route::get('brand/{name}', 'HomeController@brandFilter')->name('brand');
Route::get('search', 'HomeController@search')->name('search');


/**
 * adminPanel
 */
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        $products = Product::all();
        $categories = Category::all();
        $brands = ProductBrand::all();
        return view('admin.dashboard.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands
        ]);
    })->name('admin.index');
    
    Route::resource('products', 'ProductController');
    Route::resource('brands', 'BrandController');
    Route::resource('categories', 'CategoryController');

    Route::get('brands/findProducts/{id}', 'BrandController@findProducts');
    Route::get('categoriesDisplay','CategoryController@display');
    Route::get('brandsDisplay', 'BrandController@display');
});

