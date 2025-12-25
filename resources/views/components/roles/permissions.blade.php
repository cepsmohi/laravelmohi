<div
    x-data="{ isOpen:false }"
    class="p-2 fcols gap-1 bg-gray-100 rounded-xl"
>
    <div
        @click="isOpen = !isOpen"
        class="frows gap-2 cursor-pointer group"
    >
        <div
            class="frows gap-2 cursor-pointer"
        >
            <div class="stitle">Permissions</div>
        </div>
        <x-ui.collapse/>
    </div>
    <x-ui.transtogglediv :outside="false" class="relative">
        <div class="fcols gap-2">
            @foreach($role->permissions as $permission)
                <div class="frows gap-2">
                    <div class="w-8 text-right">{{ $permission->id }}</div>
                    <x-ui.vline/>
                    <div class="w-14 text-left">{{ $permission->group }}</div>
                    <x-ui.vline/>
                    <div class="w-28 text-left">{{ $permission->label }}</div>
                    <x-ui.vline/>
                    <div>{{ $permission->name }}</div>
                </div>
            @endforeach
        </div>
        <x-roles.permissions.create.options :$role :$showPermissionForm :$name :$label :$group/>
    </x-ui.transtogglediv>
</div>
