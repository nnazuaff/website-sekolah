<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Major extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'short_name', 'description', 'image', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function classrooms(): HasMany
    {
        return $this->hasMany(Classroom::class);
    }
}
