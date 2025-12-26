<div
    x-data="{ isOpen:false }"
    class="p-2 fcols gap-1 bg-gray-100 dark:bg-gray-500 rounded-xl"
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
    <x-ui.transtogglediv :outside="false" class="relative">
        <div class="fcols gap-2">
            @foreach($role->users as $user)
                <div class="frows gap-2">
                    <div class="w-8 text-right">{{ $user->id }}</div>
                    <x-ui.vline/>
                    <a
                        href="{{ route('admin.users.show', $user) }}"
                        class="w-32 text-left hover:underline"
                    >
                        {{ $user->name }}
                    </a>
                    <x-ui.vline/>
                    <div class="w-56 text-left">{{ $user->email }}</div>
                    <x-ui.vline/>
                    <div>{{ $user->status }}</div>
                </div>
            @endforeach
        </div>
    </x-ui.transtogglediv>
</div>
