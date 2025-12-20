<a
    @class([
        'sqrbtn glass buttonhover print:hidden select-none',
        'hidden' => $condi == 0,
        $color ?? ''
    ])
    id="{{ randtxt() }}"
    href="{{ $href ?? '#' }}"
    @isset($target)
        target="{{ $target }}"
    @endisset
>
    @if(isset($notify) && $notify > 0)
        <div class="adtr -top-4 -right-4 w-7 h-7 rounded-full bg-red-600 frow text-white">
            {{ $notify }}
        </div>
    @endif
    <div class="w-full h-4 stitle text-[9px] md:text-xs mt-2 truncate text-center">{!! $header ?? ' ' !!}</div>
    <img
        class="mt-1 w-9 h-9 md:w-12 md:h-12"
        src="{{ asset('images/icon/' . $icon) }}"
        alt="icon"
    />
    <div class="w-full h-4 stitle text-[9px] md:text-xs mt-2 truncate text-center">{!! $footer ?? ' ' !!}</div>
</a>
