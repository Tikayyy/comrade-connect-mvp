<?php

namespace App\Services;

use App\Models\User;

class AuthService
{
    const TOKEN_NAME = "auth";

    public function createTokenByUser(User $user): string
    {
        return $user->createToken(self::TOKEN_NAME)->plainTextToken;
    }
}
