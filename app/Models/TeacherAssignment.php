<?php

namespace App\Models;

use App\Enums\UserRole;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherAssignment extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'subject_id', 'classroom_id', 'semester_id'];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class);
    }

    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    public function attendanceSessions(): HasMany
    {
        return $this->hasMany(AttendanceSession::class);
    }

    public function grades(): HasMany
    {
        return $this->hasMany(Grade::class);
    }

    public function scopeVisibleTo(Builder $query, User $user): Builder
    {
        if (in_array($user->role, [UserRole::SuperAdmin, UserRole::OperatorTu], true)) {
            return $query;
        }

        if ($user->role === UserRole::WaliKelas) {
            return $query->whereHas('classroom', fn (Builder $query) => $query->where('homeroom_teacher_id', $user->teacher_id));
        }

        return $query->where('teacher_id', $user->teacher_id ?? 0);
    }

    public function getDisplayNameAttribute(): string
    {
        return collect([$this->teacher?->name, $this->subject?->name, $this->classroom?->name, $this->semester?->name])->filter()->join(' — ');
    }
}
