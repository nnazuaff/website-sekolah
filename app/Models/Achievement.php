<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'level',
        'achievement_date',
        'year',
        'photo',
    ];

    protected $casts = [
        'achievement_date' => 'date',
        'year' => 'integer',
    ];
}
