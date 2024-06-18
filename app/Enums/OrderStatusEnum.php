<?php

namespace App\Enums;

use ArchTech\Enums\Values;

enum OrderStatusEnum: string
{

    case NEW = 'new';
    case PENDING = 'pending';
    case PAID = 'paid';
    case SHIPPED = 'shipped';
    case DELIVERED = 'delivered';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    public static function labels(): array
    {
        return [
            self::NEW => 'new',
            self::PENDING => 'pending',
            self::PAID => 'paid',
            self::SHIPPED => 'shipped',
            self::DELIVERED => 'delivered',
            self::CANCELLED => 'cancelled',
            self::REFUNDED => 'refunded',
        ];
    }
}
