<?php

namespace App;

class Seller extends User
{
    protected $fillable = [
        'name', 'email', 'password',
    ];
}
