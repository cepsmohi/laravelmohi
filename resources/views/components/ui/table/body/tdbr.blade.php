<td
    @class([
        'p-2 text-left',
        'rounded-br-xl' => $loop->last
    ])
>
    @isset($value)
        {{ $value }}
    @endisset
    @isset($icon)
        <div
            wire:click="{{ $wireclick }}"
            class="frow cursor-pointer"
        >
            <x-ui.icon :$icon/>
        </div>
    @endisset
</td>
