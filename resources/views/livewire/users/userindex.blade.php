<div>
    <x-app.buttons>
        <x-users.index.buttons/>
    </x-app.buttons>
    <div class="hidden md:block">
        <div class="p-2 frows">
            <x-ui.title title="Users"/>
        </div>
        <x-users.list :$users/>
    </div>
    <div class="block md:hidden">
        <div class="p-2 frow">
            <x-ui.title title="Users"/>
        </div>
        <x-users.cards :$users/>
    </div>
</div>
