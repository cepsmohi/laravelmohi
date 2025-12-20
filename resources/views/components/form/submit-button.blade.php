<div class="frows gap-2">
    <button
        @class([
            'submit-button buttonhover group',
            $width ?? '',
            $color ?? 'btncolor'
        ])
        id="submit-button-{{ $form }}"
        form="{{ $form }}"
        type="submit"
        value="Submit"
    >
        <x-ui.icon
            icon="{{ $icon }}"
            width="w-6"
            padding="p-0"
        />
        @isset($tag)
            <span class="whitespace-nowrap">
                {{ $tag }}
            </span>
        @endisset
    </button>
</div>
