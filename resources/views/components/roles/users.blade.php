<div
    x-data="{ isOpen:false }"
    class="fcols gap-1"
>
    <div
        @click="isOpen = !isOpen"
        class="frows gap-2 cursor-pointer group"
    >
        <div
            class="frows gap-2 cursor-pointer"
        >
            <div class="stitle">Users</div>
        </div>
        <x-ui.collapse/>
    </div>
    <x-ui.transtogglediv class="relative">
        <div class="fcols gap-2">
            @foreach($role->users as $user)
                <div class="frows gap-2">
                    <div>{{ $user->id }}</div>
                    <x-ui.vline/>
                    <a
                        href="{{ route('admin.users.show', $user) }}"
                        class="hover:underline"
                    >
                        {{ $user->name }}
                    </a>
                    <x-ui.vline/>
                    <div>{{ $user->email }}</div>
                    <x-ui.vline/>
                    <div>{{ $user->status }}</div>
                </div>
            @endforeach
        </div>
    </x-ui.transtogglediv>
</div>
