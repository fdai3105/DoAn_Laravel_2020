<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['id', 'name', 'price', 'quantity', 'total', 'order_details', 'product_id'];

    public $timestamp = true;

    public function order() {
        $this->belongsTo(Order::class, 'order_id');
    }

    public function product() {
        $this->hasMany(Product::class, 'product_id');
    }
}
