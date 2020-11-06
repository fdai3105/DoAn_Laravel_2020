<?php

namespace App\Http\Controllers;

use App\Category;
use App\Jobs\SendReminderEmail;
use App\Product;
use App\ProductBrand;

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
    public function navbar()
    {
        $categoriesData = Category::all();
        $brandsData = ProductBrand::all();
        return response()->json(['categories' => $categoriesData, 'brands' => $brandsData]);
    }

    public function sendReminderEmail()
    {
        // $user = new User();
        // $user->name = "Hoa";
        // $user->email = "mail@gmail.com";
        // $user->password = "password";
        // $user->level = "1";
        // $job =  (new SendReminderEmail($user))->delay(60);
        // $this->dispatch($job);


        dispatch(new SendReminderEmail())->delay(60);
    }
}
