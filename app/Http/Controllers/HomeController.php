<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\ProductBrand;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $productsData = Product::all();
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();
        return view('body', [
            'productsData' => $productsData,
            'categoriesData' => $categoriesData,
            'brandsData' => $brandsData,
        ]);
    }

    // call by ajax to use many time
    // in home.blade.php 
    public function navbar() {
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();
        return response()->json(['categories' => $categoriesData, 'brands' => $brandsData]);
    }
}
