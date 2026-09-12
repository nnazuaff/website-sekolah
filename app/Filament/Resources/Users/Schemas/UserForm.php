<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRole;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('name')->label('Nama')->required()->maxLength(255),
            TextInput::make('email')->label('Email')->email()->required()->unique(ignoreRecord: true),
            TextInput::make('password')->label('Password')->password()->revealable()->required(fn (string $operation) => $operation === 'create')->dehydrated(fn (?string $state) => filled($state)),
            Select::make('role')->label('Role')->options(collect(UserRole::cases())->mapWithKeys(fn (UserRole $role) => [$role->value => $role->label()])->all())->live()->required(),
            Select::make('teacher_id')->label('Profil Guru')->relationship('teacher', 'name')->searchable()->preload()->unique(ignoreRecord: true)
                ->required(fn (Get $get) => in_array($get('role'), [UserRole::Guru->value, UserRole::WaliKelas->value], true))
                ->helperText('Wajib dihubungkan untuk akun Guru atau Wali Kelas.'),
        ]);
    }
}
