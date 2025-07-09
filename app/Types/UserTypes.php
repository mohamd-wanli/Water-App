<?php

namespace App\Types;

class UserTypes
{
    /**
     * Create a new class instance.
     */

    public const DISTRIBUTOR = 'distributor';
    public const USER = 'user';
    public const ADMIN = 'admin';


    public static array $statuses = [
        self::DISTRIBUTOR,
        self::USER,
        self::ADMIN,

    ];
}
