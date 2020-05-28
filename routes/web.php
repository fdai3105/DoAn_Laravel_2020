<?php

use App\Category;
use App\Product;
use App\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

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

Route::get('/', function () {
    $products = array();
    $products['product_brands'] = ProductBrand::all();
    $products['products'] = Product::all();

    $categories = array();
    $categories = Category::all();

    // return view('welcome', [
    //     'products' => $products,
    //     'categories' => $categories
    // ]);
    return redirect()->route('admin');
});

Route::resource('product', 'ProductController');
Route::resource('brand', 'BrandController');
Route::resource('category', 'CategoryController');
/**
 * adminPanel
 */
Route::get('admin', function () {
    $data['products'] = Product::all();
    $data['product_brands'] = ProductBrand::all();
    $data['product_category'] = Category::all();

    $productsData = Product::all();
    $categoriesData = Category::all();
    $brandsData = ProductBrand::all();

    return view('admin.product.admin', [
        'data' => $data,
        'categoriesData' => $categoriesData,
        'brandsData' => $brandsData,
        'productsData' => $productsData
    ]);
})->name('admin');

Route::get('admin/brand', function () {
    $brandsData = ProductBrand::all();

    return view('admin.brand.index', ['brandsData' => $brandsData]);
})->name('admin/brand');

Route::get('admin/category', function () {
    $categoryData = Category::all();
    return view('admin.category.index',['categoryData' => $categoryData]);
})->name('admin/category');
