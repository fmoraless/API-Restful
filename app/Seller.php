<?php

namespace App;

class Seller extends User
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
