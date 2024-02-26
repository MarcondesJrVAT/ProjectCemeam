<?php

namespace App\Policies;

use App\Http\Middleware\Authenticate;
use App\Models\Role;
use App\Models\User;

class UserPolicy
{
    public function __construct()
    {
        //
    }

    public function create_user(User $user): bool
    {
        return $user->hasAbility('create_user');
    }

    public function read_user(User $user): bool
    {
        return $user->hasAbility('read_user');
    }

    public function update_user(User $user): bool
    {
        return $user->hasAbility('update_user');
    }

    public function delete_user(User $user): bool
    {
        return $user->hasAbility('delete_user');
    }
}
