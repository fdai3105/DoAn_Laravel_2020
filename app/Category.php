<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    public $timestamp = true;

    public function product()
    {
        return $this->hasMany(Product::class, 'product_id');
    }
}
