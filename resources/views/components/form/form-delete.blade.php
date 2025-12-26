@teleport('#modaldiv')
<div class="modalback bg-gray-900/90">
    <div class="modal glass bg-gray-500/80 p-4 rounded-3xl group">
        <div class="stitle text-white">Are you sure?</div>
        <div class="mt-4 frowb gap-4">
            <x-form.awiretag
                wireclick="delete{{ $object }}Confirm"
                icon="trash"
                tag="Delete"
                iconsize="w-5 h-5"
                color="bg-red-300"
            />
            <x-form.awiretag
                wireclick="delete{{ $object }}Cancel"
                icon="back"
                tag="Cancel"
            />
        </div>
    </div>
</div>
@endteleport
