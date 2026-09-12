<?php

namespace App\Filament\Resources\Grades\Schemas;

use App\Models\Student;
use App\Models\TeacherAssignment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class GradeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('teacher_assignment_id')->label('Penugasan')->options(fn () => TeacherAssignment::query()->visibleTo(auth()->user())->with(['teacher', 'subject', 'classroom', 'semester'])->get()->mapWithKeys(fn ($record) => [$record->id => $record->display_name])->all())->searchable()->live()->required(),
            Select::make('student_id')->label('Siswa')->options(function (Get $get): array {
                $classroomId = TeacherAssignment::query()->find($get('teacher_assignment_id'))?->classroom_id;

                return Student::query()->where('classroom_id', $classroomId ?? 0)->where('status', 'active')->orderBy('name')->pluck('name', 'id')->all();
            })->searchable()->required(),
            TextInput::make('assignment_score')->label('Nilai Tugas (30%)')->numeric()->minValue(0)->maxValue(100),
            TextInput::make('midterm_score')->label('Nilai UTS (30%)')->numeric()->minValue(0)->maxValue(100),
            TextInput::make('final_exam_score')->label('Nilai UAS (40%)')->numeric()->minValue(0)->maxValue(100),
            TextInput::make('final_score')->label('Nilai Akhir')->disabled()->dehydrated(false)->helperText('Dihitung otomatis: 30% tugas + 30% UTS + 40% UAS.'),
        ]);
    }
}
