<div
    x-data="{ hidden: false }"
    x-init="window.addEventListener('scroll', () => hidden = window.scrollY > 10)"
    :class="hidden ? '-translate-y-full' : 'translate-y-0'"
    class="p-2 w-full text-5xl drop-shadow transform transition-transform duration-1000 ease-in-out"
>
    <div class="frows">
        <a class="w-auto frows gap-4  text-2xl md:text-5xl drop-shadow"
           href="{{ $href ?? route('dashboard') }}"
           wire:navigate>
            <img class="w-14 md:w-24"
                 src="{{ asset('favicon.svg') }}"
                 alt=""
            />
            <div class="font-theme uppercase text-primary dark:text-secondary">
                @php
                    $words = preg_split('/\s+/', $_ENV['APP_NAME']);
                @endphp
                <div>{{ $words[0] }}</div>
                <div>{{ $words[1] }}</div>
            </div>
        </a>
    </div>
</div>
