<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function index()
    {
        return ('
            <h4>' . url('/') . '/api/product</h4>
            <h4>' . url('/') . '/api/product/{id}</h4>
            <h4>' . url('/') . '/api/category/</h4>
            <h4>' . url('/') . '/api/category/{id}</h4>
            <h4>' . url('/') . '/api/brand/</h4>
            <h4>' . url('/') . '/api/brand/{id}</h4>
        ');
    }
}
