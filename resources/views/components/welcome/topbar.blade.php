<div class="container fixed top-0 z-50">
    <div
        x-data="{ scrolled: false }"
        x-init="
            window.addEventListener('scroll', () => {
                scrolled = window.scrollY > 120
            })
        "
        :class="scrolled ? 'bg-gray-100 dark:bg-gray-800' : 'bg-transparent'"
        class="frowb transition-colors duration-1000 ease-in-out"
    >
        <div
            x-data="{ show: false }"
            x-init="
                window.addEventListener('scroll', () => {
                    show = window.scrollY > 112
                })
            "
            x-show="show"
            x-transition:enter="transition-opacity transition-transform duration-1000 ease-out"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition-opacity transition-transform duration-1000 ease-in"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="p-2 w-full text-5xl drop-shadow"
        >
            <div class="drop-shadow">
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
        <div class="p-2 w-full frowe gap-2">
            <x-welcome.darkmode/>
            <x-ui.vline height="h-10"/>
            <x-welcome.auth/>
        </div>
    </div>
</div>
