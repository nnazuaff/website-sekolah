<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['title', 'description', 'image', 'taken_at'];

    protected $casts = ['taken_at' => 'date'];
}
