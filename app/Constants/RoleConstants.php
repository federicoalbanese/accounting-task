<?php

namespace App\Constants;

class RoleConstants
{
    const REGISTRAR = 'REGISTRAR';

    const REVIEWER = 'REVIEWER';

    const SUPER_ADMIN = 'SUPER_ADMIN';

    const ROLES = [
        self::REGISTRAR,
        self::REVIEWER,
        self::SUPER_ADMIN,
    ];
}