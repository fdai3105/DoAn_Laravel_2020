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

    public function categoryFilter($name)
    {
        $productsData = Product::all();
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();

        $categoryFilter = Category::where('name', $name)->first();
        return view('category', [
            'categoryFilter' => $categoryFilter,
            'productsData' => $productsData,
            'categoriesData' => $categoriesData,
            'brandsData' => $brandsData,
        ]);
    }

    public function brandFilter($name)
    {
        $productsData = Product::all();
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();

        $brandFilter = ProductBrand::where('name', $name)->first();
        return view('brand', [
            'brandFilter' => $brandFilter,
            'productsData' => $productsData,
            'categoriesData' => $categoriesData,
            'brandsData' => $brandsData,
        ]);
    }

    public function productItem($name)
    {
        $productsData = Product::all();
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();

        $product = Product::where('name', $name)->first();
        return view('product', [
            'product' => $product,
            'categoriesData' => $categoriesData,
            'brandsData' => $brandsData,
        ]);
    }

    public function search(Request $request)
    {
        $productsData = Product::all();
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();
        
        if (empty($request->key)) {
            return redirect()->back();
        }

        $product = Product::where('name', 'like', '%' . $request->key . '%')->get();
        return view('search', [
            'key' => $request->key,
            'search' => $product,
            'productsData' => $productsData,
            'categoriesData' => $categoriesData,
            'brandsData' => $brandsData,
        ]);
    }
}
