<div class="p-2 fcols gap-2">
    @foreach($roles as $role)
        <div
            x-data="{ isOpen:false }"
            class="p-2 fcols gap-2 bg-gray-300 rounded-xl"
        >
            <div
                @click="isOpen = !isOpen"
                class="frows gap-2 cursor-pointer group"
            >
                <div
                    class="frows gap-2 cursor-pointer"
                >
                    <div class="stitle">{{ $role->label }}</div>
                </div>
                <x-ui.collapse/>
            </div>
            <x-ui.transtogglediv class="relative">
                <div class="p-2 frows gap-2 bg-gray-200 rounded-xl">
                    <x-roles.users :$role/>
                </div>
            </x-ui.transtogglediv>
        </div>
    @endforeach
</div>
