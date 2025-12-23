<a
    class="card buttonhover glass block h-52 group"
    href="{{ route('admin.users.show', $user) }}"
>
    <div class="px-4 py-3 border-b group-hover:rounded-t-2xl frowb">
        <x-ui.h3 :title="$user->name"/>
        @if($user->status == 'active')
            <x-ui.icon icon="tick"/>
        @endif
        @if($user->status == 'blocked')
            <x-ui.icon icon="stop"/>
        @endif
    </div>
    <div class="px-4 py-2 pt-3 frows gap-2">
        <x-ui.icon icon="rank"/>
        @forelse($user->roles as $role)
            <div
                @class([
                    'px-2 py-1 text-xs rounded-full border',
                    'bg-green-100 text-green-700' => $role->name == 'user',
                    'bg-red-100 text-red-700' => $role->name == 'admin'
                ])
            >
                {{ ucfirst($role->label) }}
            </div>
        @empty
            <div>Not asssigned yet</div>
        @endforelse
    </div>
    <div class="px-4 py-2 frows gap-1">
        <x-ui.icon icon="phone"/>
        <div>{{ $user->phone }}</div>
    </div>
    <div class="px-4 py-2 frows gap-1">
        <x-ui.icon icon="mail"/>
        <div>{{ $user->email }}</div>
    </div>
</a>
