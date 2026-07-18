<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address'
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
    }
}
