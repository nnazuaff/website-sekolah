<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\AcademicYear;
use App\Models\AttendanceSession;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use App\Models\User;
use Carbon\CarbonImmutable;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademicDemoSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function (): void {
            $this->ensureSupportingData();

            $academicYear = AcademicYear::query()->updateOrCreate(
                ['name' => '2026/2027'],
                ['start_date' => '2026-07-01', 'end_date' => '2027-06-30', 'is_active' => true],
            );

            AcademicYear::query()->updateOrCreate(
                ['name' => '2025/2026'],
                ['start_date' => '2025-07-01', 'end_date' => '2026-06-30', 'is_active' => false],
            );

            $semester = Semester::query()->updateOrCreate(
                ['academic_year_id' => $academicYear->id, 'number' => 1],
                ['name' => 'Ganjil', 'is_active' => true],
            );

            Semester::query()->updateOrCreate(
                ['academic_year_id' => $academicYear->id, 'number' => 2],
                ['name' => 'Genap', 'is_active' => false],
            );

            $subjects = $this->seedSubjects();
            $teachers = Teacher::query()->where('is_active', true)->orderBy('id')->take(12)->get();
            $majors = Major::query()->where('is_active', true)->orderBy('id')->take(2)->get();
            $classrooms = $this->seedClassrooms($academicYear, $majors, $teachers);

            $this->seedStaffAccounts($teachers);
            $this->seedStudents($classrooms);
            $assignments = $this->seedAssignments($semester, $classrooms, $subjects, $teachers);
            $this->seedSchedules($assignments);
            $this->seedAttendance($assignments);
            $this->seedGrades($assignments);
        });
    }

    private function ensureSupportingData(): void
    {
        $teacherCount = Teacher::query()->count();
        if ($teacherCount < 12) {
            Teacher::factory()->count(12 - $teacherCount)->create();
        }

        $defaultMajors = [
            ['name' => 'Rekayasa Perangkat Lunak', 'slug' => 'rekayasa-perangkat-lunak', 'short_name' => 'RPL'],
            ['name' => 'Teknik Komputer dan Jaringan', 'slug' => 'teknik-komputer-dan-jaringan', 'short_name' => 'TKJ'],
        ];

        foreach ($defaultMajors as $major) {
            Major::query()->firstOrCreate(
                ['slug' => $major['slug']],
                [...$major, 'description' => 'Jurusan demo untuk sistem akademik.', 'image' => null, 'is_active' => true],
            );
        }
    }

    private function seedSubjects()
    {
        $subjects = [
            ['code' => 'BIN-01', 'name' => 'Bahasa Indonesia', 'group' => 'Umum', 'minimum_passing_grade' => 75],
            ['code' => 'BIG-01', 'name' => 'Bahasa Inggris', 'group' => 'Umum', 'minimum_passing_grade' => 75],
            ['code' => 'MTK-01', 'name' => 'Matematika', 'group' => 'Umum', 'minimum_passing_grade' => 75],
            ['code' => 'PKN-01', 'name' => 'Pendidikan Pancasila', 'group' => 'Umum', 'minimum_passing_grade' => 75],
            ['code' => 'INF-01', 'name' => 'Informatika', 'group' => 'Kejuruan', 'minimum_passing_grade' => 78],
            ['code' => 'DDK-01', 'name' => 'Dasar-Dasar Kejuruan', 'group' => 'Kejuruan', 'minimum_passing_grade' => 78],
            ['code' => 'PBO-01', 'name' => 'Pemrograman Berorientasi Objek', 'group' => 'Kejuruan', 'minimum_passing_grade' => 80],
            ['code' => 'BD-01', 'name' => 'Basis Data', 'group' => 'Kejuruan', 'minimum_passing_grade' => 80],
        ];

        foreach ($subjects as $subject) {
            Subject::query()->updateOrCreate(['code' => $subject['code']], [...$subject, 'is_active' => true]);
        }

        return Subject::query()->whereIn('code', array_column($subjects, 'code'))->orderBy('id')->get();
    }

    private function seedClassrooms(AcademicYear $academicYear, $majors, $teachers)
    {
        $classrooms = collect();

        foreach ([10 => 'X', 11 => 'XI', 12 => 'XII'] as $gradeLevel => $gradeLabel) {
            foreach ($majors as $majorIndex => $major) {
                $name = "{$gradeLabel} {$major->short_name} 1";
                $classrooms->push(Classroom::query()->updateOrCreate(
                    ['academic_year_id' => $academicYear->id, 'name' => $name],
                    [
                        'major_id' => $major->id,
                        'homeroom_teacher_id' => $teachers[($gradeLevel + $majorIndex) % $teachers->count()]->id,
                        'grade_level' => $gradeLevel,
                        'is_active' => true,
                    ],
                ));
            }
        }

        return $classrooms;
    }

    private function seedStaffAccounts($teachers): void
    {
        $passwordHash = User::query()->whereNotNull('password')->value('password');
        if (! $passwordHash) {
            return;
        }

        User::query()->updateOrCreate(
            ['email' => 'operator.akademik@example.com'],
            ['name' => 'Operator Akademik', 'password' => $passwordHash, 'role' => UserRole::OperatorTu, 'teacher_id' => null],
        );

        $usedTeacherIds = User::query()->whereNotNull('teacher_id')->pluck('teacher_id')->all();
        $profiles = [
            ['email' => 'guru1@example.com', 'role' => UserRole::Guru],
            ['email' => 'guru2@example.com', 'role' => UserRole::Guru],
            ['email' => 'guru3@example.com', 'role' => UserRole::Guru],
            ['email' => 'guru4@example.com', 'role' => UserRole::Guru],
            ['email' => 'walikelas1@example.com', 'role' => UserRole::WaliKelas],
            ['email' => 'walikelas2@example.com', 'role' => UserRole::WaliKelas],
        ];

        foreach ($profiles as $profile) {
            $existing = User::query()->where('email', $profile['email'])->first();
            $teacher = $existing?->teacher_id
                ? $teachers->firstWhere('id', $existing->teacher_id)
                : $teachers->first(fn (Teacher $teacher) => ! in_array($teacher->id, $usedTeacherIds, true));

            if (! $teacher) {
                continue;
            }

            $usedTeacherIds[] = $teacher->id;
            User::query()->updateOrCreate(
                ['email' => $profile['email']],
                ['name' => $teacher->name, 'password' => $passwordHash, 'role' => $profile['role'], 'teacher_id' => $teacher->id],
            );
        }
    }

    private function seedStudents($classrooms): void
    {
        $firstNames = ['Ahmad', 'Aisyah', 'Bima', 'Citra', 'Dimas', 'Farah', 'Galang', 'Hana', 'Ilham', 'Jihan', 'Kevin', 'Laila', 'Miko', 'Nabila', 'Putra'];
        $lastNames = ['Pratama', 'Ramadhani', 'Saputra', 'Lestari', 'Nugroho', 'Permata', 'Wijaya', 'Maharani'];

        foreach ($classrooms->values() as $classIndex => $classroom) {
            foreach (range(1, 15) as $studentIndex) {
                $sequence = ($classIndex * 15) + $studentIndex;
                Student::query()->updateOrCreate(
                    ['nis' => '26'.str_pad((string) $sequence, 4, '0', STR_PAD_LEFT)],
                    [
                        'nisn' => '006'.str_pad((string) $sequence, 7, '0', STR_PAD_LEFT),
                        'classroom_id' => $classroom->id,
                        'name' => $firstNames[($sequence - 1) % count($firstNames)].' '.$lastNames[($sequence + $classIndex) % count($lastNames)],
                        'gender' => $sequence % 2 === 0 ? 'P' : 'L',
                        'birth_date' => CarbonImmutable::parse('2009-01-01')->addDays($sequence * 7),
                        'address' => 'Jl. Pendidikan No. '.$sequence.', Kecamatan Sekolah',
                        'status' => 'active',
                    ],
                );
            }
        }
    }

    private function seedAssignments(Semester $semester, $classrooms, $subjects, $teachers)
    {
        $assignments = collect();
        $teachingTeachers = $teachers->values();

        foreach ($classrooms->values() as $classIndex => $classroom) {
            foreach ($subjects->values() as $subjectIndex => $subject) {
                $teacher = $teachingTeachers[($classIndex + $subjectIndex) % $teachingTeachers->count()];
                $assignments->push(TeacherAssignment::query()->firstOrCreate([
                    'teacher_id' => $teacher->id,
                    'subject_id' => $subject->id,
                    'classroom_id' => $classroom->id,
                    'semester_id' => $semester->id,
                ]));
            }
        }

        return TeacherAssignment::query()
            ->with(['classroom.students'])
            ->whereKey($assignments->pluck('id'))
            ->get();
    }

    private function seedSchedules($assignments): void
    {
        $startTimes = ['07:30:00', '09:30:00'];
        $endTimes = ['09:00:00', '11:00:00'];

        foreach ($assignments->values() as $index => $assignment) {
            $subjectPosition = $index % 8;
            Schedule::query()->firstOrCreate(
                ['teacher_assignment_id' => $assignment->id],
                [
                    'day_of_week' => ($subjectPosition % 5) + 1,
                    'start_time' => $startTimes[intdiv($subjectPosition, 5)],
                    'end_time' => $endTimes[intdiv($subjectPosition, 5)],
                    'room' => 'Ruang '.$assignment->classroom->name,
                ],
            );
        }
    }

    private function seedAttendance($assignments): void
    {
        $attendanceRows = [];
        $now = now();

        foreach ($assignments->values() as $assignmentIndex => $assignment) {
            foreach ([1, 2] as $meeting) {
                $session = AttendanceSession::query()->firstOrCreate(
                    ['teacher_assignment_id' => $assignment->id, 'meeting_number' => $meeting],
                    [
                        'date' => CarbonImmutable::parse('2026-08-03')->addDays(($assignmentIndex % 20) + (($meeting - 1) * 21)),
                        'topic' => $meeting === 1 ? 'Pengenalan materi dan tujuan pembelajaran' : 'Latihan dan pembahasan materi',
                    ],
                );

                foreach ($assignment->classroom->students as $studentIndex => $student) {
                    $statusIndex = ($studentIndex + $meeting + $assignmentIndex) % 20;
                    $status = match (true) {
                        $statusIndex === 0 => 'alpa',
                        $statusIndex === 1 => 'sakit',
                        $statusIndex === 2 => 'izin',
                        default => 'hadir',
                    };
                    $attendanceRows[] = [
                        'attendance_session_id' => $session->id,
                        'student_id' => $student->id,
                        'status' => $status,
                        'note' => $status === 'hadir' ? null : 'Data presensi demo',
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }
            }
        }

        foreach (array_chunk($attendanceRows, 500) as $chunk) {
            DB::table('attendances')->upsert($chunk, ['attendance_session_id', 'student_id'], ['status', 'note', 'updated_at']);
        }
    }

    private function seedGrades($assignments): void
    {
        $gradeRows = [];
        $now = now();

        foreach ($assignments->values() as $assignmentIndex => $assignment) {
            foreach ($assignment->classroom->students->values() as $studentIndex => $student) {
                $assignmentScore = 68 + (($studentIndex * 3 + $assignmentIndex) % 29);
                $midtermScore = 70 + (($studentIndex * 5 + $assignmentIndex) % 27);
                $finalExamScore = 72 + (($studentIndex * 7 + $assignmentIndex) % 25);
                $finalScore = round(($assignmentScore * .3) + ($midtermScore * .3) + ($finalExamScore * .4), 2);

                $gradeRows[] = [
                    'teacher_assignment_id' => $assignment->id,
                    'student_id' => $student->id,
                    'assignment_score' => $assignmentScore,
                    'midterm_score' => $midtermScore,
                    'final_exam_score' => $finalExamScore,
                    'final_score' => $finalScore,
                    'published_at' => ($assignmentIndex + $studentIndex) % 3 === 0 ? $now : null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }

        foreach (array_chunk($gradeRows, 500) as $chunk) {
            DB::table('grades')->upsert(
                $chunk,
                ['teacher_assignment_id', 'student_id'],
                ['assignment_score', 'midterm_score', 'final_exam_score', 'final_score', 'published_at', 'updated_at'],
            );
        }
    }
}
