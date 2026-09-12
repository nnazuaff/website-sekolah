<?php

namespace App\Filament\Resources\AcademicYears\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AcademicYearForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Tahun Ajaran')->required()->maxLength(255)->unique(ignoreRecord: true),
            DatePicker::make('start_date')->label('Tanggal Mulai')->required()->native(false),
            DatePicker::make('end_date')->label('Tanggal Selesai')->required()->native(false)->afterOrEqual('start_date'),
            Toggle::make('is_active')->label('Tahun Ajaran Aktif')->helperText('Mengaktifkan ini akan menonaktifkan tahun ajaran lain.')->default(false),
        ]);
    }
}
