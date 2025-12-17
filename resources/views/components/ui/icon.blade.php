<div class="block dark:hidden">
    <img
        @class([
            'overflow-hidden drop-shadow-xl',
            $width ?? 'w-6',
            $padding ?? '',
            $rounded ?? 'rounded-xl'
        ])
        src="{{ asset('images/icon/' . $icon. ($ext ?? '.svg')) }}"
        alt="{{ $icon }}"
    />
</div>
<div class="hidden dark:block">
    @php
        $icon = $icon.'-dark';
    @endphp
    <img
        @class([
            'overflow-hidden drop-shadow-xl',
            $width ?? 'w-6',
            $padding ?? '',
            $rounded ?? 'rounded-xl'
        ])
        src="{{ asset('images/icon/' . $icon. ($ext ?? '.svg')) }}"
        alt="{{ $icon }}"
    />
</div>
