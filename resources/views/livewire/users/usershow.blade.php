<div>
    <x-app.buttons>
        <x-users.show.buttons/>
    </x-app.buttons>
    <div class="p-2 fcols gap-2">
        <div class="frows">
            <x-ui.icon icon="user" width="w-10"/>
            <x-ui.title :title="$user->name"/>
        </div>
        <x-users.show.roles :$user/>
        <x-users.show.cridentials :$user/>
        <x-users.show.entryinfo :$user/>
        <x-users.show.sessioninfo :$user/>
    </div>
</div>
