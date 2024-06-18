<?php

namespace App\Enums;


enum StoneNameEnum: string
{

    case DIAMOND = 'диамант';
    case SAPPHIRE = 'сапфир';
    case RUBY = 'рубин';
    case EMERALD = 'изумруд';
    case ALEXANDRITE = 'александрит';
    case CHAROITE = 'харолит';
    case AGATE = 'агат';
    case AMBER = 'янтарь';
    case SERPENTINITE = 'серпентинит';
    case RHODONITE = 'родонит';
    case DIOPSIDE = 'диопсид';
    case AMETHYST = 'аметист';
    case AQUAMARINE = 'аквамарин';
    case CITRINE = 'цитрин';
    case GARNET = 'гранат';
    case OPAL = 'опал';
    case MALACHITE = 'малахит';
    case NONE = 'нет';

    public static function labels(): array
    {
        return [
            self::DIAMOND => 'Diamond',
            self::SAPPHIRE => 'Sapphire',
            self::RUBY => 'Ruby',
            self::EMERALD => 'Emerald',
            self::ALEXANDRITE => 'Alexandrite',
            self::CHAROITE => 'Charoite',
            self::AGATE => 'Agate',
            self::AMBER => 'Amber',
            self::SERPENTINITE => 'Serpentinize',
            self::RHODONITE => 'Rhodonite',
            self::DIOPSIDE => 'Diopside',
            self::AMETHYST => 'Amethyst',
            self::AQUAMARINE => 'Aquamarine',
            self::CITRINE => 'Citrine',
            self::GARNET => 'Garnet',
            self::OPAL => 'Opal',
            self::MALACHITE => 'Malachite',
            self::NONE => 'None',
        ];
    }
}
