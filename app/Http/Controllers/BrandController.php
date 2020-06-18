<?php

namespace App\Http\Controllers;
use App\ProductBrand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brand = ProductBrand::all();
        return view('brand', [
            'brand' => $brand
        ]);
    }

    public function show($name) {
        $brand = ProductBrand::where('name', $name)->first();
        return view('brand', [
            'brand' => $brand
        ]);
    }
}
