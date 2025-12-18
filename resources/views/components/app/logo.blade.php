<div class="p-2 w-full text-5xl">
    <div class="frows">
        <a class="frows gap-4 text-xl drop-shadow"
           href="{{ $href ?? route('dashboard') }}"
           wire:navigate>
            <img class="w-10"
                 src="{{ asset('favicon.svg') }}"
                 alt=""
            />
            <div class="font-theme uppercase text-primary dark:text-secondary frows gap-2">
                @php
                    $words = preg_split('/\s+/', $_ENV['APP_NAME']);
                @endphp
                <div>{{ $words[0] }}</div>
                <div>{{ $words[1] }}</div>
            </div>
        </a>
    </div>
</div>
