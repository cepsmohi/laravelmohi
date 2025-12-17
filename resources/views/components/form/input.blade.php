<div class="{{ $hidden ?? '' }} {{ $width ?? 'w-full' }} {{ $mb ?? 'mb-4' }} relative">
    <input
        class="@error($name) bg-red-200 @enderror inputcss group"
        id="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        @isset($step) step="{{ $step }}" @endisset
        name="{{ $name }}"
        @isset($autocomplete) autocomplete="{{ $autocomplete }}" @endisset
        @if(!isset($required) && !isset($type)) required @endif
        @if (isset($value)) value="{{ $value }}" @endif
        @isset($pattern) oninput="{{ $pattern }}" @endisset
        {{ $disabled ?? '' }}
        {{ $autofocus ?? '' }}
    />
    <x-form.input.icon :$icon/>
    <x-form.input.placeholder :placeholder="$placeholder ?? ''"/>
    <x-form.input.hints :hints="$hints ?? ''"/>
    <x-form.input.error :$name/>
</div>
