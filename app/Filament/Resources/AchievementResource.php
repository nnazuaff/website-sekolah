<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AchievementResource\Pages;
use App\Models\Achievement;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AchievementResource extends Resource
{
    protected static ?string $model = Achievement::class;

    protected static ?string $navigationIcon = 'heroicon-o-trophy';

    protected static ?string $navigationLabel = 'Prestasi';

    protected static ?string $pluralModelLabel = 'Prestasi';

    protected static ?string $modelLabel = 'Prestasi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label('Judul Prestasi')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('level')
                    ->label('Tingkat')
                    ->options([
                        'Kabupaten' => 'Kabupaten',
                        'Provinsi' => 'Provinsi',
                        'Nasional' => 'Nasional',
                        'Internasional' => 'Internasional',
                    ])
                    ->required(),

                Forms\Components\DatePicker::make('achievement_date')
                    ->label('Tanggal Raih'),

                Forms\Components\TextInput::make('year')
                    ->label('Tahun')
                    ->numeric()
                    ->length(4),

                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Kegiatan / Sertifikat')
                    ->image()
                    ->directory('achievements')
                    ->columnSpanFull(),

                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto'),

                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('level')
                    ->label('Tingkat')
                    ->badge()
                    ->sortable(),

                Tables\Columns\TextColumn::make('year')
                    ->label('Tahun')
                    ->sortable(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAchievements::route('/'),
            'create' => Pages\CreateAchievement::route('/create'),
            'edit' => Pages\EditAchievement::route('/{record}/edit'),
        ];
    }
}