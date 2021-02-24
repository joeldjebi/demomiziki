<?php

namespace Common\Auth\Traits;

use App\User;

trait GetsApiTokenForDevice
{
    public function getApiToken($tokenName, User $user): string
    {
        $user->tokens()->where('name', $tokenName)->delete();
        return $user->createToken($tokenName)->plainTextToken;
    }
}
