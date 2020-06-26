<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Product;
use App\ProductBrand;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productsData = Product::all();
        return view('product', [
            'productsData' => $productsData
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {
        $product = Product::where('name', $name)->first();
        return view('product', [
            'product' => $product
        ]);
    }

    public function search(Request $request)
    {
        if (empty($request->key)) {
            return redirect()->back();
        }

        $product = Product::where('name', 'like', '%' . $request->key . '%')->take(5)->get();
        return view('search', [
            'key' => $request->key,
            'search' => $product
        ]);
        // return response()->json($product);
    }
}
