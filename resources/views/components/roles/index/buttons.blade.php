@auth
    @if(cusr()->hasPermission('roles.create'))
        <x-form.awire
            wireclick="$toggle('showRoleForm')"
            icon="add"
            title="New Role"
        />
    @endif
@endauth
<x-form.ahref
    :href="route('dashboard')"
    icon="back"
    title="All Roles"
/>
