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
        <x-app.scroll-logo/>
        <div class="p-2 w-full frowe gap-2">
            <x-welcome.darkmode/>
            <x-ui.vline height="h-10"/>
            <x-welcome.auth/>
        </div>
    </div>
</div>
