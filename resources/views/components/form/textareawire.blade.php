<div class="{{ $width ?? 'w-full' }} {{ $mb ?? 'mb-7' }} relative">
    <label
        for="{{ $name }}"
        class="absolute -top-1.5 left-12 h-5 text-black bg-linear-to-b from-gray-50 via-gray-50 to-gray-50/30 px-2 text-[10px] rounded"
    >
        {{ $tag ?? 'Text area tag' }}
    </label>
    <textarea
        class="@error($name) bg-red-200 @enderror inputcss focus:border-1st dark:text-black {{ $uppercase ?? '' }}"
        id="{{ $name }}"
        wire:model.defer="{{ $name }}"
        rows="{{ $rows ?? '4' }}"
        placeholder="{{ $placeholder ?? '' }}"
        @if((isset($required) && !$required) || (isset($type) && ($type == 'date' || $type == 'time' || $type == 'datetime-local'))))
        @else
            required
        @endisset
    ></textarea>
    @isset($icon)
        <span class="frow absolute left-2 top-2 h-6 w-6 text-white drop-shadow">
            <img
                class="w-7 h-7"
                src="{{ asset('images/icon/' . $icon . '.svg') }}"
                alt="{{ $icon }}"
            />
        </span>
    @endisset
    @error($name)
    <div class="absolute -bottom-4 left-0 w-full truncate text-left text-xs text-red-700">
        {{ $message }}
    </div>
    @enderror
</div>
