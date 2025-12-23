@auth
    @if(cusr()->hasPermission('users.create'))
        <x-form.ahref
            :href="route('admin.users.create')"
            icon="user-plus"
            title="New User"
        />
    @endif
@endauth
<x-form.ahref
    :href="route('dashboard')"
    icon="back"
    title="All Users"
/>
