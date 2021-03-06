<?php

namespace App;

use App\Scopes\SellerScope;
use App\Transformers\SellerTransformer;
use App\Transformers\TransactionTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends User
{
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public $transformer = SellerTransformer::class;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope(new SellerScope);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
