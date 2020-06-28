<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    protected $table = 'product_brands';

    protected $fillable = ['name'];

    public $timestamp = true;

    public function products()
    {
        return $this->hasMany(Product::class, 'product_brands_id');
    }
}
