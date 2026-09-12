<?php

namespace App\Filament\Resources\Users\Tables;

use App\Enums\UserRole;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Nama')->searchable()->sortable(),
            TextColumn::make('email')->label('Email')->searchable(),
            TextColumn::make('role')->label('Role')->badge()->formatStateUsing(fn ($state) => $state?->label() ?? '-'),
            TextColumn::make('teacher.name')->label('Profil Guru')->placeholder('-'),
        ])->filters([SelectFilter::make('role')->label('Role')->options(UserRole::class)])
            ->recordActions([EditAction::make()]);
    }
}
