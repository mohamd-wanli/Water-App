<?php

namespace App\Types;

class DistributerRequest
{

    public const PENDING = 'pending';
    public const APPROVED = 'approved';
    public const REJECTED = 'rejected';

    public static array $status = [
        self::PENDING,
        self::APPROVED,
        self::REJECTED,
    ];

}





