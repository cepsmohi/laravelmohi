@isset($icon)
    <span class="frow absolute left-2 top-2 h-6 w-6 text-white drop-shadow">
        <img
            class="w-6 h-6"
            src="{{ asset('images/icon/' . $icon . '.svg') }}"
            alt="{{ $icon }}"
        />
    </span>
@endisset
