<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBrand;
use Illuminate\Http\Request;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductBrand::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return ProductBrand::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return ProductBrand::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $productBrand = ProductBrand::findOrFail($id);
        $productBrand->update($request->all());
        return $productBrand;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductBrand::findOrFail($id)->delete();
    }

    public function search(Request $request, $id)
    {
        $keyWord = $request->input('s');
        $productBrand = Product::where("product_brands_id", $id)->where('name', 'like', "%$keyWord%")->get();
        return api_success(array($productBrand));
    }

    /**
     * Show all product in this brand
     */
    public function products($id)
    {
        $products = Product::where('product_brands_id', $id)->get();
        return $products;
    }
}
