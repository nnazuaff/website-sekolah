<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case OperatorTu = 'operator_tu';
    case Guru = 'guru';
    case WaliKelas = 'wali_kelas';

    public function label(): string
    {
        return match ($this) {
            self::SuperAdmin => 'Super Admin',
            self::OperatorTu => 'Operator TU',
            self::Guru => 'Guru',
            self::WaliKelas => 'Wali Kelas',
        };
    }
}
