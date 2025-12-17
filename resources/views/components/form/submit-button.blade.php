<div class="frows gap-2">
    <button
        @class([
            'submit-button buttonhover glass group',
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
        <span class="whitespace-nowrap">
            {{ $tag }}
        </span>
    </button>
</div>
