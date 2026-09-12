<?php

use App\Enums\UserRole;
use App\Filament\Resources\AttendanceSessions\Tables\AttendanceSessionsTable;
use App\Models\AcademicYear;
use App\Models\AttendanceSession;
use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('only offers a teacher their own assignments in the attendance filter', function (): void {
    $academicYear = AcademicYear::create([
        'name' => '2026/2027',
        'start_date' => '2026-07-01',
        'end_date' => '2027-06-30',
        'is_active' => true,
    ]);
    $semester = Semester::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'Ganjil',
        'number' => 1,
        'is_active' => true,
    ]);
    $classroom = Classroom::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'X RPL 1',
        'grade_level' => 10,
        'is_active' => true,
    ]);
    $teacher = Teacher::factory()->create(['name' => 'Guru Sendiri']);
    $otherTeacher = Teacher::factory()->create(['name' => 'Guru Lain']);
    $subject = Subject::create(['code' => 'INF-101', 'name' => 'Informatika', 'minimum_passing_grade' => 75, 'is_active' => true]);
    $otherSubject = Subject::create(['code' => 'MAT-101', 'name' => 'Matematika', 'minimum_passing_grade' => 75, 'is_active' => true]);
    $assignment = TeacherAssignment::create(['teacher_id' => $teacher->id, 'subject_id' => $subject->id, 'classroom_id' => $classroom->id, 'semester_id' => $semester->id]);
    TeacherAssignment::create(['teacher_id' => $otherTeacher->id, 'subject_id' => $otherSubject->id, 'classroom_id' => $classroom->id, 'semester_id' => $semester->id]);
    $user = User::create(['name' => 'Guru', 'email' => 'guru@example.test', 'password' => 'password', 'role' => UserRole::Guru, 'teacher_id' => $teacher->id]);

    expect(AttendanceSessionsTable::assignmentFilterOptions($user))->toBe([
        $assignment->id => 'Guru Sendiri — Informatika — X RPL 1 — Ganjil',
    ]);
});

it('rejects duplicate attendance dates and meeting numbers before database insert', function (): void {
    $academicYear = AcademicYear::create([
        'name' => '2026/2027',
        'start_date' => '2026-07-01',
        'end_date' => '2027-06-30',
        'is_active' => true,
    ]);
    $semester = Semester::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'Ganjil',
        'number' => 1,
        'is_active' => true,
    ]);
    $classroom = Classroom::create([
        'academic_year_id' => $academicYear->id,
        'name' => 'X RPL 1',
        'grade_level' => 10,
        'is_active' => true,
    ]);
    $teacher = Teacher::factory()->create();
    $subject = Subject::create(['code' => 'INF-102', 'name' => 'Informatika Lanjutan', 'minimum_passing_grade' => 75, 'is_active' => true]);
    $assignment = TeacherAssignment::create(['teacher_id' => $teacher->id, 'subject_id' => $subject->id, 'classroom_id' => $classroom->id, 'semester_id' => $semester->id]);

    AttendanceSession::create([
        'teacher_assignment_id' => $assignment->id,
        'date' => '2026-09-08',
        'meeting_number' => 3,
        'topic' => 'Materi pertama',
    ]);

    expect(fn () => AttendanceSession::create([
        'teacher_assignment_id' => $assignment->id,
        'date' => '2026-09-08',
        'meeting_number' => 4,
        'topic' => 'Materi kedua',
    ]))->toThrow(\Illuminate\Validation\ValidationException::class);

    expect(fn () => AttendanceSession::create([
        'teacher_assignment_id' => $assignment->id,
        'date' => '2026-09-09',
        'meeting_number' => 3,
        'topic' => 'Materi ketiga',
    ]))->toThrow(\Illuminate\Validation\ValidationException::class);
});
