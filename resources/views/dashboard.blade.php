<x-master title="Dashboard">
    <x-app.topbar :href="route('welcome')"/>
    @auth
        @if(cusr()->isAdmin())
            <div class="p-2 stitle">Admin Tasks</div>
        @endif
        <div class="frows gap-4 flex-wrap">
            @if(cusr()->hasPermission('users'))
                <x-ui.sqrbtn
                    condi="1"
                    header="Users"
                    footer="Control"
                    :color="cssbg('red')"
                    icon="users.png"
                    :href="route('admin.users')"
                />
            @endif
            @if(cusr()->hasPermission('roles'))
                <x-ui.sqrbtn
                    condi="1"
                    header="Roles"
                    footer="Manage"
                    :color="cssbg('blue')"
                    icon="roles.png"
                    :href="route('admin.roles')"
                />
            @endif
        </div>
    @endauth
</x-master>
