<x-master title="Dashboard">
    <x-app.topbar :href="route('welcome')"/>
    @auth
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
    @endauth
</x-master>
