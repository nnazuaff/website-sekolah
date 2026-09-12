<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Validation\ValidationException;

class AttendanceSession extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_assignment_id', 'date', 'meeting_number', 'topic'];

    protected function casts(): array
    {
        return ['date' => 'date'];
    }

    protected static function booted(): void
    {
        static::created(function (self $session): void {
            $session->teacherAssignment->classroom->students()->where('status', 'active')->each(
                fn (Student $student) => $session->attendances()->create(['student_id' => $student->id, 'status' => 'hadir'])
            );
        });

        static::saving(function (self $session): void {
            $semester = TeacherAssignment::query()->findOrFail($session->teacher_assignment_id)->semester;
            $date = $session->date instanceof \DateTimeInterface ? $session->date->format('Y-m-d') : $session->date;

            if ($date < $semester->academicYear->start_date->format('Y-m-d') || $date > $semester->academicYear->end_date->format('Y-m-d')) {
                throw ValidationException::withMessages(['date' => 'Tanggal presensi berada di luar tahun ajaran penugasan.']);
            }

            $duplicateDate = static::query()
                ->where('teacher_assignment_id', $session->teacher_assignment_id)
                ->whereDate('date', $date)
                ->when($session->exists, fn ($query) => $query->whereKeyNot($session->getKey()))
                ->exists();

            if ($duplicateDate) {
                throw ValidationException::withMessages(['date' => 'Presensi untuk penugasan dan tanggal tersebut sudah ada.']);
            }

            $duplicateMeeting = static::query()
                ->where('teacher_assignment_id', $session->teacher_assignment_id)
                ->where('meeting_number', $session->meeting_number)
                ->when($session->exists, fn ($query) => $query->whereKeyNot($session->getKey()))
                ->exists();

            if ($duplicateMeeting) {
                throw ValidationException::withMessages(['meeting_number' => 'Nomor pertemuan tersebut sudah digunakan pada penugasan ini.']);
            }
        });
    }

    public function teacherAssignment(): BelongsTo
    {
        return $this->belongsTo(TeacherAssignment::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class);
    }
}
