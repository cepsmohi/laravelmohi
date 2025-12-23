<div
    x-data="{ isOpen:false }"
    class="fcols"
>
    <div
        @click="isOpen = !isOpen"
        class="frows gap-2 cursor-pointer"
    >
        <div
            class="frows gap-2 cursor-pointer"
        >
            <x-ui.icon icon="device" width="w-10"/>
            <div class="stitle">Used Devices</div>
        </div>
        <x-ui.collapse/>
    </div>
    <x-ui.transtogglediv class="relative">
        <x-users.sessions :$user/>
    </x-ui.transtogglediv>
</div>
