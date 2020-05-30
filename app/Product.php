<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'desc', 'image', 'price', 'product_brands_id', 'categories_id'];

    public $timestamp = true;

    public function productBrand()
    {
        return $this->belongsTo(ProductBrand::class, 'product_brands_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    function orders()
    {
        return $this->belongsToMany('App\Order', 'order_details', 'order_id', 'product_id');
    }
}
