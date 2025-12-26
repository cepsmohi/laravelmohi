<div>
    <x-app.buttons>
        <x-roles.index.buttons/>
    </x-app.buttons>
    <div class="hidden md:block">
        <div class="p-2 frows">
            <x-ui.title title="Roles"/>
        </div>
        <x-roles.list :$roles/>
    </div>
    @if($createRoleForm)
        <x-roles.create.form :$name :$label/>
    @endif
    @if($deleteRoleForm)
        <x-form.form-delete object="Role"/>
    @endif
    @if($createPermissionForm)
        <x-roles.permissions.create.form :$name :$label :$group/>
    @endif
    @if($deletePermissionForm)
        <x-form.form-delete object="Permission"/>
    @endif
</div>
