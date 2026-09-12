<?php

use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('keeps academic master data connected from year to student', function (): void {
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
    $student = Student::create([
        'classroom_id' => $classroom->id,
        'nis' => '20260001',
        'name' => 'Siswa Akademik',
        'gender' => 'L',
        'status' => 'active',
    ]);
    $subject = Subject::create([
        'code' => 'INF-101',
        'name' => 'Informatika',
        'minimum_passing_grade' => 75,
        'is_active' => true,
    ]);

    expect($semester->academicYear->is($academicYear))->toBeTrue()
        ->and($student->classroom->is($classroom))->toBeTrue()
        ->and($classroom->academicYear->is($academicYear))->toBeTrue()
        ->and($subject->minimum_passing_grade)->toBe(75);
});
