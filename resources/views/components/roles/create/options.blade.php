@if(cusr()->hasPermission('roles.create'))
    <div
        class="hidden px-2 py-1 submit-button border border-dashed buttonhover cursor-pointer group-hover:flex"
        wire:click="$toggle('showRoleForm')"
    >
        <div class="w-5 h-5 bg-gray-200 dark:bg-gray-600 rounded-full frow">
            +
        </div>
        <div>New</div>
    </div>
    @if($showRoleForm)
        <x-roles.create.form :$name :$label/>
    @endif
@endif
