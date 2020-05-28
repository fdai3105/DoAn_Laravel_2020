<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id', 'users_id'];


    public $timestamp = true;

    function products(){
        return $this->belongsToMany('App\Product', 'order_details', 'order_id', 'product_id');
    }

    function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
