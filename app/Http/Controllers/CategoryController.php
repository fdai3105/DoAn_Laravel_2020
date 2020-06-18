<?php

namespace App\Http\Controllers;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('category', [
            'category' => $category
        ]);
    }

    public function show($name)
    {
        $category = Category::where('name', $name)->first();
        return view('category', [
            'category' => $category
        ]);
    }
}
