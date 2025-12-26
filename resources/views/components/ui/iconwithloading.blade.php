<div
    wire:loading.remove
    wire:target="{{ $wireclick }}"
>
    <x-ui.icon :icon="$icon" :$width/>
</div>
<x-ui.loading :$wireclick/>
