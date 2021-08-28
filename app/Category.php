<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'description'
    ];

    // Borrar campos pivot de la respuesta
/*
"data": [
    {
        "id": 1,
        "name": "est",
        "description": "In distinctio quis placeat dolor labore aliquam suscipit.",
        "quantity": 1,
        "status": "no disponible",
        "image": "1.jpg",
        "seller_id": 34,
        "deleted_at": null,
        "created_at": "2021-08-20T22:22:30.000000Z",
        "updated_at": "2021-08-20T22:22:30.000000Z",
        "pivot": {
        "category_id": 2,        ========> Como eliminar estos campos pivot
        "product_id": 1          ========> Como eliminar estos campos pivot
        }
    }
*/

    protected $hidden = [
      'pivot'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
