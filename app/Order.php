<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['id', 'users_id', 'total', 'note'];

    public $timestamp = true;

    // thừa??
    // function products()
    // {
    //     return $this->belongsToMany('App\Product', 'order_details', 'orders_id', 'product_id');
    // }

    function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orders_id');
    }

    function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i');
    }

}
