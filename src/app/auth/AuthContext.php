<?php

namespace App\App\Auth;

use App\Model\Entities\User;

final class AuthContext
{
    private static ?User $user = null;

    public static function setUser(User $user): void
    {
        self::$user = $user;
    }

    public static function user(): ?User
    {
        return self::$user;
    }

    public static function id(): ?int
    {
        return self::$user?->getId();
    }

    public static function clear(): void
    {
        self::$user = null;
    }
}
