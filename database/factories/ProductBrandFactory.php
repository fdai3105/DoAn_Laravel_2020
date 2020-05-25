<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\ProductBrand;
use Faker\Generator as Faker;

$factory->define(ProductBrand::class, function (Faker $faker) {
    return [
        'name' => $faker->company
    ];
});
