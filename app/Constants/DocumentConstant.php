<?php

namespace App\Constants;

class DocumentConstant
{
    const PRIORITY_HIGH = 'HIGH';

    const PRIORITY_LOW = 'LOW';

    const PRIORITIES = [
        self::PRIORITY_HIGH,
        self::PRIORITY_LOW,
    ];

    const STATUS_INIT = 'INIT';

    const STATUS_CONFIRMED = 'CONFIRMED';

    const STATUSES = [
        self::STATUS_INIT,
        self::STATUS_CONFIRMED,
    ];
}