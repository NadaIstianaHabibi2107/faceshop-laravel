<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductShade;

class ProductShadeSeeder extends Seeder
{
    public function run(): void
    {
        ProductShade::insert([
            [
                'product_id' => 1,
                'shade_name' => 'Warm Ivory',
                'tone'       => 'Fair',
                'undertone'  => 'Warm',
                'hex_color'  => '#F1D6C1',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'product_id' => 1,
                'shade_name' => 'Cool Beige',
                'tone'       => 'Fair',
                'undertone'  => 'Cool',
                'hex_color'  => '#E8CFC4',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'product_id' => 2,
                'shade_name' => 'Natural Beige',
                'tone'       => 'Medium',
                'undertone'  => 'Neutral',
                'hex_color'  => '#D2B48C',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'product_id' => 2,
                'shade_name' => 'Warm Sand',
                'tone'       => 'Medium',
                'undertone'  => 'Warm',
                'hex_color'  => '#C2A178',
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}
