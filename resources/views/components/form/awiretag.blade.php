<div
    class="frows print:hidden"
    title="{{ $title ?? '' }}"
>
    <button
        @class([
            'submit-button buttonhover group',
            $color ?? 'btncolor',
        ])
        id="{{ randtxt() }}"
        wire:click="{{ $wireclick }}"
        wire:loading.attr="disabled"
        wire:offline.attr="disabled"
        @if (isset($wireconfirm)) wire:confirm="{{ $wireconfirm }}" @endif
        @if (isset($aclick)) @click="{{ $aclick }}" @endif
    >
        @isset($icon)
            <x-ui.iconwithloading
                :$icon
                :$wireclick
                :width="$iconsize ?? 'w-6'"
            />
        @endisset
        <span class="whitespace-nowrap">
            {{ $tag }}
        </span>
    </button>
</div>
