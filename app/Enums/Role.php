<?php

namespace App\Enums;

enum Role
{
    case ADMIN;
    case TATAUSAHA;
    case KEPSEK;

    public function status(): string
    {
        return match ($this) {
            self::ADMIN => 'admin',
            self::TATAUSAHA => 'tatausaha',
            self::KEPSEK => 'kepsek',
        };
    }
}
