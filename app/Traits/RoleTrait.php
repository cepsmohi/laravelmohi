<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\AuditLogger;

trait RoleTrait
{
    public $showRoleForm = false;
    public $showPermissionForm = false;

    public $name, $label, $group;
    public $role;

    public function addRole()
    {
        $data = $this->validate([
            'name' => 'required',
            'label' => 'required'
        ]);
        Role::create($data);
        return redirect()
            ->route('admin.roles')
            ->with('success', 'Role created.');
    }

    public function openPermissionAddForm(Role $role)
    {
        $this->role = $role;
        $this->showPermissionForm = true;
    }

    public function addPermission()
    {
        $data = $this->validate([
            'name' => 'required',
            'label' => 'required',
            'group' => 'required'
        ]);
        $permission = Permission::create($data);
        $this->role->permissions()->attach($permission->id);
        $this->logPermissionCreated($permission, $this->role);
        return redirect()
            ->route('admin.roles')
            ->with('success', 'Permission created.');
    }

    public function logPermissionCreated(Permission $permission, Role $role)
    {
        AuditLogger::narrative(
            sprintf(
                'Admin %s generated "%s" permission for "%s".',
                auth()->user()?->email,
                $permission->label,
                $role->label
            )
        );
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
