<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Services\AuditLogger;

trait RoleTrait
{
    public $createRoleForm = false;
    public $createPermissionForm = false;
    public $deleteRoleForm = false;
    public $deletePermissionForm = false;

    public $name, $label, $group;
    public $role, $permission;

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
        $this->createPermissionForm = true;
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

    public function deleteRole(Role $role)
    {
        $this->role = $role;
        $this->deleteRoleForm = true;
    }

    public function deleteRoleConfirm()
    {
        $this->role?->delete();
        $this->role = null;
        return $this->deleteRoleForm = false;
    }

    public function deleteRoleCancel()
    {
        $this->role = null;
        return $this->deleteRoleForm = false;
    }

    public function deletePermission(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
        $this->deletePermissionForm = true;
    }

    public function deletePermissionConfirm()
    {
        $this->role->permissions()->detach($this->permission->id);
        $this->permission?->delete();
        $this->role = null;
        $this->permission = null;
        return $this->deletePermissionForm = false;
    }

    public function deletePermissionCancel()
    {
        $this->permission = null;
        return $this->deletePermissionForm = false;
    }
}
