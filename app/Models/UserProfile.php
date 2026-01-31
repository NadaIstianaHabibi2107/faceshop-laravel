<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'skin_type',
        'tone',
        'undertone',
        'skin_problem',
        'vein_color',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
