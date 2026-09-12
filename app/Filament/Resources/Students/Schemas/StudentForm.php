<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama Siswa')->required()->maxLength(255),
            Select::make('classroom_id')->label('Rombel')->relationship('classroom', 'name')->searchable()->preload()->required(),
            TextInput::make('nis')->label('NIS')->required()->maxLength(30)->unique(ignoreRecord: true),
            TextInput::make('nisn')->label('NISN')->maxLength(30)->unique(ignoreRecord: true),
            Select::make('gender')->label('Jenis Kelamin')->options(['L' => 'Laki-laki', 'P' => 'Perempuan'])->required(),
            DatePicker::make('birth_date')->label('Tanggal Lahir')->native(false),
            Textarea::make('address')->label('Alamat')->rows(3)->columnSpanFull(),
            Select::make('status')->label('Status')->options(['active' => 'Aktif', 'graduated' => 'Lulus', 'transferred' => 'Pindah', 'inactive' => 'Tidak Aktif'])->default('active')->required(),
        ]);
    }
}
