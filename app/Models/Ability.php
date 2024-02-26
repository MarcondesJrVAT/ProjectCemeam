<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ability extends Model
{
    use HasFactory;

    public function rolesRelationship(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
