<?php

namespace App\Filament\Resources\Schedules\Schemas;

use App\Models\TeacherAssignment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('teacher_assignment_id')->label('Penugasan')->options(fn () => TeacherAssignment::query()->visibleTo(auth()->user())->with(['teacher', 'subject', 'classroom', 'semester'])->get()->mapWithKeys(fn ($record) => [$record->id => $record->display_name])->all())->searchable()->required(),
            Select::make('day_of_week')->label('Hari')->options([1 => 'Senin', 2 => 'Selasa', 3 => 'Rabu', 4 => 'Kamis', 5 => 'Jumat', 6 => 'Sabtu'])->required(),
            TimePicker::make('start_time')->label('Jam Mulai')->seconds(false)->required(),
            TimePicker::make('end_time')->label('Jam Selesai')->seconds(false)->after('start_time')->required(),
            TextInput::make('room')->label('Ruangan')->maxLength(100),
        ]);
    }
}
