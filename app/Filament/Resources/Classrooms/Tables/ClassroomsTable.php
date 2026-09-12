<?php

namespace App\Filament\Resources\Classrooms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ClassroomsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Rombel')->searchable()->sortable(),
            TextColumn::make('grade_level')->label('Tingkat')->sortable(),
            TextColumn::make('major.short_name')->label('Jurusan')->placeholder('-'),
            TextColumn::make('academicYear.name')->label('Tahun Ajaran')->sortable(),
            TextColumn::make('homeroomTeacher.name')->label('Wali Kelas')->placeholder('-')->searchable(),
            IconColumn::make('is_active')->label('Aktif')->boolean(),
        ])->filters([
            SelectFilter::make('academic_year_id')->label('Tahun Ajaran')->relationship('academicYear', 'name'),
            SelectFilter::make('major_id')->label('Jurusan')->relationship('major', 'name'),
            SelectFilter::make('grade_level')->label('Tingkat')->options([10 => 'X', 11 => 'XI', 12 => 'XII']),
        ])->recordActions([EditAction::make()])
            ->toolbarActions([BulkActionGroup::make([DeleteBulkAction::make()])]);
    }
}
