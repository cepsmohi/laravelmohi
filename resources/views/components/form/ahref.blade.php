<a
    href="{{ $href ?? '#' }}"
    @class([
        'block buttonhover rounded-xl cursor-pointer',
        $color ?? 'btncolor'
    ])
    title="{{ $title ?? '' }}"
>
    @isset($icon)
        <x-ui.icon
            icon="{{ $icon }}"
            padding="p-0"
            :width="$width ?? 'w-10'"
        />
    @endisset
</a>
