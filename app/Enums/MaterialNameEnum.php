<?php

namespace App\Enums;

enum MaterialNameEnum: string
{
    case GOLD = 'золото';
    case PLATINUM = 'платина';
    case SILVER = 'серебро';
    case DIAMOND = 'алмаз';


    public function toString(): ?string
    {
        return match ($this) {
            self::GOLD => 'золото',
            self::PLATINUM => 'платина',
            self::SILVER => 'серебро',
            self::DIAMOND => 'алмаз',

        };
    }
}
