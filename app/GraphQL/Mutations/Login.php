<?php

namespace App\GraphQL\Mutations;
use Illuminate\Support\Facades\Auth;

use GraphQL\Error\Error;

class Login
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $guard = Auth::guard();

        if (!$guard->attempt($args)) {
            throw new Error('Invalid credentials.');
        }

        /** @var \App\User $user */
        $user = Auth::user();

        return $user->createToken('cookie')->accessToken;
    }
}
