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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // NOTE: lebih bagus pindah ke Controller, tapi boleh dulu untuk tahap cepat.
    public function tryOn($shadeId)
    {
        $shade = self::with('product')->findOrFail($shadeId);

        return view('virtual_tryon', [
            'productName' => $shade->product->name,
            'brand' => $shade->product->brand,
            'price' => $shade->product->price,
            'hex' => $shade->hex_color,
            'shadeName' => $shade->shade_name,
            'badge' => $shade->tone ?? 'Shade',
            'image' => !empty($shade->product->image)
                ? asset('storage/' . $shade->product->image)
                : '/assets/image/1.png',
        ]);
    }
}
