<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'brand',
        'category',
        'price',
        'stock',
        'skin_type',
        'description'
    ];

      public function shades()
    {
        return $this->hasMany(ProductShade::class);
    }


}
