<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductShade extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'shade_name',
        'tone',
        'undertone',
        'hex_color',
    ];

    // Relasi: shade milik satu produk
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function tryOn($productId, $shadeId)
    {
        $shade = \App\Models\ProductShade::with('product')->findOrFail($shadeId);

        return view('virtual_tryon', [
            'productName' => $shade->product->name,
            'brand' => $shade->product->brand,
            'price' => $shade->product->price,
            'hex' => $shade->hex_color,
            'shadeName' => $shade->shade_name,
            'badge' => $shade->tone ?? 'Shade',
            'image' => $shade->product->image ? asset('storage/'.$shade->product->image) : '/assets/image/1.png',
        ]);
    }

    

}
