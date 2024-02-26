<?php

namespace App\Policies;

use App\Models\User;

class AbilityPolicy
{
    public function create_ability(User $user): bool
    {
        return $user->hasAbility('create_ability');
    }

    public function read_ability(User $user): bool
    {
        return $user->hasAbility('read_ability');
    }

    public function update_ability(User $user): bool
    {
        return $user->hasAbility('update_ability');
    }

    public function delete_ability(User $user): bool
    {
        return $user->hasAbility('delete_ability');
    }
}
