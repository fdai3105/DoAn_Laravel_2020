<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Model;
use App\Product;
use App\ProductBrand;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    $productBrands = ProductBrand::all()->pluck('id')->toArray();
    $categories = Category::all()->pluck('id')->toArray();

    return [
        'name' => $faker->name,
        'desc' => $faker->text,
        'image' => 'https://via.placeholder.com/640x480.png?text=fdaiBlog',
        'price' => $faker->randomDigitNotNull,
        
        'product_brands_id' => $faker->randomElement($productBrands),
        'categories_id' => $faker->randomElement($categories)
    ];
});
