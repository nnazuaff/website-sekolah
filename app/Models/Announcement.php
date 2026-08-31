<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'published_at', 'expired_at', 'is_active'];

    protected $casts = ['published_at' => 'datetime', 'expired_at' => 'datetime', 'is_active' => 'boolean'];

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where('is_active', true)
            ->where('published_at', '<=', Carbon::now())
            ->where(fn (Builder $query) => $query->whereNull('expired_at')->orWhere('expired_at', '>', Carbon::now()));
    }
}
