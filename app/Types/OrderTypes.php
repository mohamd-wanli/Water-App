<?php

namespace App\Types;

class OrderTypes
{
    public const Pending = 'Pending';
    public const USER = 'user';
    public const ADMIN = 'admin';
    public const SUPER_ADMIN = 'super admin';

    public static array $statuses = [
        self::Pending,
        self::USER,
        self::ADMIN,
        self::SUPER_ADMIN
    ];
}
