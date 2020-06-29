<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductBrand;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = ProductBrand::all();
        if ($request->ajax()) {
            return response()->json($brands);
        }
        return view('admin.brand.index', ['brandsData' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return route('brand.store');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $brand = ProductBrand::create($request->all());
            if ($brand) {
                // return redirect('admin/brand');
                return $brand;
            }
            return redirect()->route('brand.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = ProductBrand::find($id);
        return response()->json($brand);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brandForm = ProductBrand::findOrFail($id);
        return response()->json($brandForm);
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
        $editBrand = ProductBrand::find($id);
        $editBrand->update($request->all());
        if ($editBrand) {
            return redirect()->route('brands.index');
        }
        return redirect()->route('brands.edit');
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
        return response()->json(['status' => 'success']);
    }

    /** 
     * Find all products in this brand.
     */
    public function products($id)
    {
        $brandForm = Product::where('product_brands_id', $id)->get();
        return response()->json($brandForm);
    }
}
