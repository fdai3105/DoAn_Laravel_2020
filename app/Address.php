<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'city', 'district', 'ward', 'street',
    ];

    public function user() {
        return $this->hasOne(User::class, 'address_id');
    }

}
