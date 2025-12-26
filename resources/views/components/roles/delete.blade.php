@if($role->deleteable())
    <div class="mt-2 frows">
        <x-form.awire
            wireclick="deleteRole({{ $role->id }})"
            icon="trash"
            width="w-6 h-6"
            title="Delete Role"
            rounded="rounded-[5px]"
        />
    </div>
@endif
