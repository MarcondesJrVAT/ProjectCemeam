<?php

namespace App\Policies;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    public function __construct()
    {
        //
    }

    public function create_role(User $user): bool
    {
        return $user->hasAbility('create_role');
    }

    public function read_role(User $user): bool
    {
        return $user->hasAbility('read_role');
    }

    public function update_role(User $user): bool
    {
        return $user->hasAbility('update_role');
    }

    public function delete_role(User $user): bool
    {
        return $user->hasAbility('delete_role');
    }
}
