<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\ValidationException;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['attendance_session_id', 'student_id', 'status', 'note'];

    protected static function booted(): void
    {
        static::saving(function (self $attendance): void {
            $classroomId = AttendanceSession::query()->findOrFail($attendance->attendance_session_id)->teacherAssignment->classroom_id;
            if (! Student::query()->whereKey($attendance->student_id)->where('classroom_id', $classroomId)->exists()) {
                throw ValidationException::withMessages(['student_id' => 'Siswa tidak terdaftar di rombel penugasan.']);
            }
        });
    }

    public function attendanceSession(): BelongsTo
    {
        return $this->belongsTo(AttendanceSession::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
