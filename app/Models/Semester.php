<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = ['academic_year_id', 'name', 'number', 'is_active'];

    protected function casts(): array
    {
        return ['number' => 'integer', 'is_active' => 'boolean'];
    }

    protected static function booted(): void
    {
        static::saving(function (self $semester): void {
            if ($semester->is_active) {
                static::query()->whereKeyNot($semester->getKey())->update(['is_active' => false]);
            }
        });
    }

    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function teacherAssignments(): HasMany
    {
        return $this->hasMany(TeacherAssignment::class);
    }
}
