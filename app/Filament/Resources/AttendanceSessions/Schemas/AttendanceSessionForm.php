<?php

namespace App\Filament\Resources\AttendanceSessions\Schemas;

use App\Models\AttendanceSession;
use App\Models\Student;
use App\Models\TeacherAssignment;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;

class AttendanceSessionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('teacher_assignment_id')->label('Penugasan')->options(fn () => TeacherAssignment::query()->visibleTo(auth()->user())->with(['teacher', 'subject', 'classroom', 'semester'])->get()->mapWithKeys(fn ($record) => [$record->id => $record->display_name])->all())->searchable()->live()->afterStateUpdated(function (Set $set, ?string $state): void {
                $set('attendance_entries', Student::query()
                    ->whereHas('classroom.teacherAssignments', fn ($query) => $query->whereKey($state))
                    ->where('status', 'active')
                    ->orderBy('name')
                    ->get()
                    ->map(fn (Student $student): array => ['student_id' => $student->id, 'status' => 'hadir', 'note' => null])
                    ->all());
            })->required(),
            DatePicker::make('date')->label('Tanggal')->native(false)->required(),
            TextInput::make('meeting_number')->label('Pertemuan Ke')->numeric()->minValue(1)->required(),
            TextInput::make('topic')->label('Topik Materi')->maxLength(255),
            Repeater::make('attendance_entries')->label('Daftar Kehadiran')->schema([
                Select::make('student_id')->label('Siswa')->options(fn (Get $get): array => Student::query()->whereHas('classroom.teacherAssignments', fn ($query) => $query->whereKey($get('../../teacher_assignment_id')))->where('status', 'active')->orderBy('name')->pluck('name', 'id')->all())->disabled()->dehydrated()->required(),
                Select::make('status')->label('Status')->options(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'])->required(),
                TextInput::make('note')->label('Catatan')->maxLength(255),
            ])->columns(3)->addable(false)->deletable(false)->reorderable(false)->visible(fn (?AttendanceSession $record) => blank($record))->columnSpanFull(),
            Repeater::make('attendances')->label('Daftar Kehadiran')->relationship()->schema([
                Select::make('student_id')->label('Siswa')->relationship('student', 'name')->disabled(),
                Select::make('status')->label('Status')->options(['hadir' => 'Hadir', 'izin' => 'Izin', 'sakit' => 'Sakit', 'alpa' => 'Alpa'])->required(),
                TextInput::make('note')->label('Catatan')->maxLength(255),
            ])->columns(3)->addable(false)->deletable(false)->reorderable(false)->visible(fn (?AttendanceSession $record) => filled($record))->columnSpanFull(),
        ]);
    }
}
