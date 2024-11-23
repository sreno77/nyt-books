<?php

namespace App\Enums;

enum RewardType: string {
    case MONETARY = 'monetary';
    case FREEMONTH = 'freemonth';

    public static function values(): array{
        return array_column(self::cases(), 'value');
    }
}