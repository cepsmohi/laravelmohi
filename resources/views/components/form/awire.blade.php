<div
    id="{{ randtxt() }}"
    wire:click="{{ $wireclick }}"
    wire:loading.attr="disabled"
    wire:offline.attr="disabled"
    @if (isset($wireconfirm)) wire:confirm="{{ $wireconfirm }}" @endif
    @if (isset($aclick)) @click="{{ $aclick }}" @endif
    @class([
        'block buttonhover rounded-xl cursor-pointer',
        $color ?? 'btncolor',
        $rounded ?? 'rounded-xl'
    ])
    title="{{ $title ?? '' }}"
>
    @isset($icon)
        <div
            wire:loading.remove
            wire:target="{{ $wireclick }}"
        >
            <x-ui.icon
                icon="{{ $icon ?? 'icon' }}"
                padding="p-0"
                :width="$width ?? 'w-10'"
            />
        </div>
        <div
            wire:loading
            wire:target="{{ $wireclick }}"
        >
            <img
                @class([
                    'overflow-hidden drop-shadow-xl',
                    $width ?? 'w-10',
                    $padding ?? 'p-1',
                    $rounded ?? 'rounded-xl'
                ])
                src="{{ asset('images/icon/loading.gif') }}"
                alt="loading"
            />
        </div>
    @endisset
</div>
