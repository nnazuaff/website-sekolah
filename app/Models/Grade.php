<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_assignment_id', 'student_id', 'assignment_score', 'midterm_score', 'final_exam_score', 'final_score', 'published_at'];

    protected function casts(): array
    {
        return ['assignment_score' => 'decimal:2', 'midterm_score' => 'decimal:2', 'final_exam_score' => 'decimal:2', 'final_score' => 'decimal:2', 'published_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::saving(function (self $grade): void {
            $assignment = TeacherAssignment::query()->findOrFail($grade->teacher_assignment_id);
            if (! Student::query()->whereKey($grade->student_id)->where('classroom_id', $assignment->classroom_id)->exists()) {
                throw ValidationException::withMessages(['student_id' => 'Siswa tidak terdaftar di rombel penugasan.']);
            }

            $scores = [$grade->assignment_score, $grade->midterm_score, $grade->final_exam_score];
            foreach ($scores as $score) {
                if ($score !== null && ($score < 0 || $score > 100)) {
                    throw ValidationException::withMessages(['assignment_score' => 'Nilai harus berada di antara 0 dan 100.']);
                }
            }
            if (! in_array(null, $scores, true)) {
                $grade->final_score = round(((float) $scores[0] * .3) + ((float) $scores[1] * .3) + ((float) $scores[2] * .4), 2);
            }
        });
    }

    public function teacherAssignment(): BelongsTo
    {
        return $this->belongsTo(TeacherAssignment::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
