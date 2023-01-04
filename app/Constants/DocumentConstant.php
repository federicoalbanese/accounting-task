<?php

namespace App\Constants;

class DocumentConstant
{
    const PRIORITY_HIGH = 'REGISTRAR';

    const PRIORITY_LOW = 'LOW';

    const PRIORITIES = [
        self::PRIORITY_HIGH,
        self::PRIORITY_LOW,
    ];

    const STATUS_INIT = 'INIT';

    const STAUTS_CONFIRMED = 'CONFIRMED';

    const STATUSES = [
        self::STATUS_INIT,
        self::STAUTS_CONFIRMED,
    ];
}