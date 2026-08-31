<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    protected $fillable = ['name', 'slug', 'description', 'photo', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
}
