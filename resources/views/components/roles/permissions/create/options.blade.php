@if(cusr()->hasPermission('roles.create'))
    <div class="frows">
        <div
            class="mt-2 hidden submit-button btncolor buttonhover group-hover:flex"
            wire:click="openPermissionAddForm({{ $role->id }})"
        >
            <x-ui.icon icon="plus"/>
            <div>New</div>
        </div>
    </div>
    @if($showPermissionForm)
        <x-roles.permissions.create.form :$name :$label :$group/>
    @endif
@endif
