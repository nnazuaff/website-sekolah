<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_assignment_id', 'day_of_week', 'start_time', 'end_time', 'room'];

    protected static function booted(): void
    {
        static::saving(function (self $schedule): void {
            if ($schedule->start_time >= $schedule->end_time) {
                throw ValidationException::withMessages(['end_time' => 'Jam selesai harus setelah jam mulai.']);
            }

            $assignment = TeacherAssignment::query()->findOrFail($schedule->teacher_assignment_id);
            $conflict = static::query()->whereKeyNot($schedule->getKey())
                ->where('day_of_week', $schedule->day_of_week)
                ->where('start_time', '<', $schedule->end_time)
                ->where('end_time', '>', $schedule->start_time)
                ->whereHas('teacherAssignment', function (Builder $query) use ($assignment): void {
                    $query->where('semester_id', $assignment->semester_id)
                        ->where(fn (Builder $query) => $query->where('teacher_id', $assignment->teacher_id)->orWhere('classroom_id', $assignment->classroom_id));
                })->exists();

            if ($conflict) {
                throw ValidationException::withMessages(['start_time' => 'Jadwal bertabrakan untuk guru atau rombel yang sama.']);
            }
        });
    }

    public function teacherAssignment(): BelongsTo
    {
        return $this->belongsTo(TeacherAssignment::class);
    }
}
