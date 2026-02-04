<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPcaProfile extends Model
{
    protected $fillable = [
        'user_id',
        'skin_tone_level',
        'undertone',
        'vein_color',
        'eye_color',
        'hair_color',
        'contrast_level',
        'hue',
        'value',
        'chroma',
        'season',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
