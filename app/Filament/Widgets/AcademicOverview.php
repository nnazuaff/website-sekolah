<?php

namespace App\Filament\Widgets;

use App\Enums\UserRole;
use App\Models\AttendanceSession;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\TeacherAssignment;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AcademicOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $user = auth()->user();
        if (! $user) {
            return [];
        }

        if (in_array($user->role, [UserRole::SuperAdmin, UserRole::OperatorTu], true)) {
            return [
                Stat::make('Siswa Aktif', Student::query()->where('status', 'active')->count()),
                Stat::make('Rombel Aktif', Classroom::query()->where('is_active', true)->count()),
                Stat::make('Jadwal Hari Ini', Schedule::query()->where('day_of_week', now()->dayOfWeekIso)->count()),
                Stat::make('Nilai Belum Terbit', Grade::query()->whereNull('published_at')->count()),
            ];
        }

        $assignments = TeacherAssignment::query()->visibleTo($user);
        $assignmentIds = (clone $assignments)->pluck('id');

        return [
            Stat::make('Penugasan Saya', $assignmentIds->count()),
            Stat::make('Jadwal Hari Ini', Schedule::query()->whereIn('teacher_assignment_id', $assignmentIds)->where('day_of_week', now()->dayOfWeekIso)->count()),
            Stat::make('Sesi Presensi', AttendanceSession::query()->whereIn('teacher_assignment_id', $assignmentIds)->count()),
            Stat::make('Nilai Draf', Grade::query()->whereIn('teacher_assignment_id', $assignmentIds)->whereNull('published_at')->count()),
        ];
    }
}
