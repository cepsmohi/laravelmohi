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
</div>
