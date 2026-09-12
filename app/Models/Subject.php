<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name', 'group', 'minimum_passing_grade', 'is_active'];

    protected function casts(): array
    {
        return ['minimum_passing_grade' => 'integer', 'is_active' => 'boolean'];
    }

    public function teacherAssignments(): HasMany
    {
        return $this->hasMany(TeacherAssignment::class);
    }
}
