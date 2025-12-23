<x-ui.table.body>
    @foreach($users as $user)
        <x-ui.table.body.tr :$loop>
            <x-ui.table.body.tdbl :$loop :value="$user->id"/>
            <x-ui.table.body.td :value="$user->name" :href="route('admin.users.show', $user)"/>
            <x-ui.table.body.td :value="$user->email"/>
            <x-ui.table.body.td :value="$user->phone"/>
            @php
                $roles = $user->roles->count() > 0
                    ? $user->roles->pluck('label')->implode(', ') . '.'
                    : 'Not assign yet';
            @endphp
            <x-ui.table.body.td :value="$roles"/>
            <x-ui.table.body.tdbr :$loop :value="$user->status"/>
        </x-ui.table.body.tr>
    @endforeach
</x-ui.table.body>
