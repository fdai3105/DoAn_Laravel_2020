<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'api'], function () {
    Route::get('/', 'ApiController@index');
    Route::apiResource('product', 'ProductController')->only(['index', 'show']);
    Route::apiResource('brand', 'ProductBrandController')->only(['index', 'show']);
    Route::get('brand/{id}/product', 'ProductBrandController@products');
    Route::apiResource('category', 'CategoryController')->only(['index', 'show']);
    Route::get('category/{id}/product', 'CategoryController@products');

    Route::post('auth/register', 'UserController@register');
    Route::post('auth/login', 'UserController@login');
    Route::group(['middleware' => 'jwt.verify'], function () {
        Route::get('user-info', 'UserController@getUserInfo');
        Route::post('user-edit', 'UserController@editUser');
    });
});
