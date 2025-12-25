<div class="frows gap-2 group">
    @php
        use App\Models\Role;
        $roles = Role::all();
    @endphp
    <x-ui.icon icon="rank" width="w-10"/>
    @foreach($roles as $role)
        <div
            class="px-2 py-1 submit-button btncolor buttonhover"
            @if($role->isAssignedTo($user))
                wire:click="removeRole({{ $role->id }}, {{ $user->id }})"
            @endif
            @if(!$role->isAssignedTo($user))
                wire:click="assignRole({{ $role->id }}, {{ $user->id }})"
            @endif
        >
            <div class="p-1 bg-gray-200 rounded-full">
                <div
                    @class([
                        'w-3 h-3 rounded-full',
                        'bg-green-400' => $role->isAssignedTo($user),
                        'bg-gray-400' => !$role->isAssignedTo($user)
                    ])
                ></div>
            </div>
            <div>{{ $role->label }}</div>
        </div>
    @endforeach
</div>
