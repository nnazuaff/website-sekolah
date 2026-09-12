<?php

use App\Enums\UserRole;
use App\Filament\Resources\Majors\MajorResource;
use App\Models\User;
use Filament\Panel;

it('only allows academic staff roles to access the admin panel', function (): void {
    $panel = Panel::make()->id('admin');

    expect((new User(['role' => UserRole::SuperAdmin->value]))->canAccessPanel($panel))->toBeTrue()
        ->and((new User(['role' => UserRole::OperatorTu->value]))->canAccessPanel($panel))->toBeTrue()
        ->and((new User(['role' => UserRole::Guru->value]))->canAccessPanel($panel))->toBeTrue()
        ->and((new User(['role' => UserRole::WaliKelas->value]))->canAccessPanel($panel))->toBeTrue()
        ->and((new User)->canAccessPanel($panel))->toBeFalse();
});

it('denies teachers access to the major management resource', function (): void {
    auth()->setUser(new User(['role' => UserRole::Guru->value]));

    expect(MajorResource::canViewAny())->toBeFalse()
        ->and(MajorResource::canCreate())->toBeFalse();
});

it('allows academic managers to manage majors', function (): void {
    auth()->setUser(new User(['role' => UserRole::OperatorTu->value]));

    expect(MajorResource::canViewAny())->toBeTrue()
        ->and(MajorResource::canCreate())->toBeTrue();
});
