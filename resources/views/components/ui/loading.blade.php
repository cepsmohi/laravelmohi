<div>
    <img
        class="{{ $width ?? 'w-6' }}"
        src="{{ asset('images/icon/loading.gif') }}"
        alt="loading gif"
        @isset($wireclick)
            wire:loading wire:target="{{ $wireclick }}"
        @endisset
    />
</div>
