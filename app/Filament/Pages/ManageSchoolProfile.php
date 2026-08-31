<?php

namespace App\Filament\Pages;

use App\Models\SchoolProfile;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class ManageSchoolProfile extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;

    protected string $view = 'filament.pages.manage-school-profile';

    protected static ?string $navigationLabel = 'Profil Sekolah';

    protected static string|UnitEnum|null $navigationGroup = 'Pengaturan Sekolah';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Profil Sekolah';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            $this->getRecord()?->attributesToArray()
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Form::make([
                    Section::make('Informasi Sekolah')
                        ->schema([
                            TextInput::make('name')
                                ->label('Nama Sekolah')
                                ->required()
                                ->maxLength(255),

                            Textarea::make('description')
                                ->label('Deskripsi')
                                ->rows(4)
                                ->columnSpanFull(),

                            RichEditor::make('history')
                                ->label('Sejarah')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Visi dan Misi')
                        ->schema([
                            Textarea::make('vision')
                                ->label('Visi')
                                ->rows(4)
                                ->columnSpanFull(),

                            RichEditor::make('mission')
                                ->label('Misi')
                                ->columnSpanFull(),
                        ]),

                    Section::make('Kepala Sekolah')
                        ->schema([
                            TextInput::make('principal_name')
                                ->label('Nama Kepala Sekolah')
                                ->maxLength(255),

                            FileUpload::make('principal_photo')
                                ->label('Foto Kepala Sekolah')
                                ->image()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('school-profile')
                                ->maxSize(2048),

                            RichEditor::make('principal_greeting')
                                ->label('Sambutan Kepala Sekolah')
                                ->columnSpanFull(),
                        ])
                        ->columns(2),

                    Section::make('Kontak Sekolah')
                        ->schema([
                            Textarea::make('address')
                                ->label('Alamat')
                                ->rows(3)
                                ->columnSpanFull(),

                            TextInput::make('phone')
                                ->label('Telepon')
                                ->tel()
                                ->maxLength(30),

                            TextInput::make('email')
                                ->label('Email')
                                ->email()
                                ->maxLength(255),
                        ])
                        ->columns(2),

                    Section::make('Identitas Visual')
                        ->schema([
                            FileUpload::make('logo')
                                ->label('Logo Sekolah')
                                ->image()
                                ->imageEditor()
                                ->disk('public')
                                ->directory('school-profile')
                                ->maxSize(2048),
                        ]),
                ])
                    ->livewireSubmitHandler('save')
                    ->footer([
                        Actions::make([
                            Action::make('save')
                                ->label('Simpan Profil')
                                ->submit('save'),
                        ]),
                    ]),
            ])
            ->record($this->getRecord())
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $record = $this->getRecord();

        if (! $record) {
            $record = new SchoolProfile;
        }

        $record->fill($data);
        $record->save();

        if ($record->wasRecentlyCreated) {
            $this->form
                ->record($record)
                ->saveRelationships();
        }

        Notification::make()
            ->success()
            ->title('Profil sekolah berhasil disimpan')
            ->send();
    }

    public function getRecord(): ?SchoolProfile
    {
        return SchoolProfile::query()->first();
    }
}
