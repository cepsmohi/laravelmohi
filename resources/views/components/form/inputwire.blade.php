<div class="{{ $hidden ?? '' }} {{ $width ?? 'w-full' }} {{ $mb ?? 'mb-4' }} relative">
    <input
        class="@error($name) bg-red-200 @enderror inputcss {{ $uppercase ?? '' }}"
        id="{{ $name }}"
        type="{{ $type ?? 'text' }}"
        @isset($step) step="{{ $step }}" @endisset
        wire:model.blur="{{ $name }}"
        @isset($wirekeydown) wire:keydown.enter="{{ $wirekeydown }}" @endisset
        @isset($wirekeyup) wire:keyup.enter="{{ $wirekeyup }}" @endisset
        @isset($onchange) wire:change="{{ $onchange }}" @endisset
        @isset($autocomplete) autocomplete="{{ $autocomplete }}" @endisset
        @if(!isset($required) && !isset($type)) required @endif
        @isset($pattern) oninput="{{ $pattern }}" @endisset
        {{ $disabled ?? '' }}
        {{ $autofocus ?? '' }}
    />
    <x-form.input.icon :$icon/>
    <x-form.input.placeholder :placeholder="$placeholder ?? ''"/>
    <x-form.input.hints :hints="$hints ?? ''"/>
    <x-form.input.error :$name/>
</div>
