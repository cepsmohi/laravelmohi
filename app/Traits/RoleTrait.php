<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\User;
use App\Services\AuditLogger;

trait RoleTrait
{
    public $showRoleForm = false;

    public $name, $label;

    public function addRole()
    {
        $data = $this->validate([
            'name' => 'required',
            'label' => 'required'
        ]);
        Role::create($data);
        return redirect()
            ->route('admin.users.show', $this->user)
            ->with('success', 'Role created.');
    }

    public function assignRole(Role $role, User $user)
    {
        $user->roles()->attach($role->id);
        $this->logRoleChange($role, $user, 'assigned');
        return redirect()
            ->route('admin.users.show', $this->user)
            ->with('success', 'Role Assigned.');
    }

    public function logRoleChange(Role $role, User $user, $action)
    {
        AuditLogger::narrative(
            sprintf(
                'Admin %s %s role "%s" to %s.',
                auth()->user()?->email,
                $action,
                $role->label,
                $user->email
            )
        );
    }

    public function removeRole(Role $role, User $user)
    {
        $user->roles()->detach($role->id);
        $this->logRoleChange($role, $user, 'removed');
        return redirect()
            ->route('admin.users.show', $this->user)
            ->with('success', 'Role Removed.');
    }
}
