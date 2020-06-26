<?php

namespace App\Http\Controllers\admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.category.index', ['categoriesData' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return route('category.store');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::create($request->all());
        if ($category) {
            // return redirect()->route('categories.index');
            return response()->json(['status' => 'success']);
        }
        return redirect()->route('categories.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pro = Product::where('categories_id', $id)->get();
        return response()->json($pro);
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
        $editCategory = Category::find($id);
        $editCategory->update($request->all());
        if ($editCategory) {
            return response()->json(['status' => 'success']);
        }
        return redirect()->route('categories.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        return response()->json(['status' => 'success']);
    }

    /** 
     * Find all products in this brand.
     */
    public function findProducts($id)
    {
        $pro = Product::where('categories_id', $id)->get();
        return response()->json($pro);
    }
    
    public function display()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
