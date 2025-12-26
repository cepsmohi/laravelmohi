<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $fillable = ['name', 'label'];

    /**
     * Assign this role to a user.
     *
     * Usage:
     * $role->assignedTo($user);
     */
    public function isAssignedTo(User $user): bool
    {
        return $this->users()
            ->whereKey($user->getKey())
            ->exists();
    }

    /**
     * Users assigned to this role.
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function deleteable()
    {
        // Prevent deletion if role is assigned to any users
        if ($this->permissions()->exists()) {
            return false;
        }
        // Prevent deletion if role is assigned to any users
        if ($this->users()->exists()) {
            return false;
        }
        return true;
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
