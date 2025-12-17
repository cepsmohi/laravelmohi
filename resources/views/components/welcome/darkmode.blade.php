<div
    x-data
    class="px-2 frowe relative print:hidden"
>
    <div class="w-full frowe gap-2 my-1">
        <div
            @click="isDarkMode = !isDarkMode"
            class="w-8 h-8 buttonhover frow rounded-full cursor-pointer shadow-inner
                   transition-all duration-500 ease-out backdrop-blur-xl"
            :class="isDarkMode ? 'bg-zinc-400/20' : 'bg-yellow-500/20'"
        >
            <!-- Animated container for icons -->
            <div class="relative w-7 h-7 flex items-center justify-center">
                <!-- Moon -->
                <div
                    x-cloak
                    x-show="isDarkMode"
                    x-transition:enter="transform transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 scale-0 rotate-[-180deg] translate-x-2"
                    x-transition:enter-end="opacity-100 scale-100 rotate-0 translate-x-0"
                    x-transition:leave="transform transition-all duration-500 ease-in"
                    x-transition:leave-start="opacity-100 scale-100 rotate-0 translate-x-0"
                    x-transition:leave-end="opacity-0 scale-0 rotate-[180deg] -translate-x-2"
                    class="absolute inset-0 flex items-center justify-center"
                >
                    <x-ui.icon icon="moon" padding="p-0" width="w-6"/>
                </div>
                <!-- Sun -->
                <div
                    x-cloak
                    x-show="!isDarkMode"
                    x-transition:enter="transform transition-all duration-500 ease-out"
                    x-transition:enter-start="opacity-0 scale-0 rotate-[180deg] -translate-x-2"
                    x-transition:enter-end="opacity-100 scale-100 rotate-0 translate-x-0"
                    x-transition:leave="transform transition-all duration-500 ease-in"
                    x-transition:leave-start="opacity-100 scale-100 rotate-0 translate-x-0"
                    x-transition:leave-end="opacity-0 scale-0 rotate-[-180deg] translate-x-2"
                    class="absolute inset-0 flex items-center justify-center"
                >
                    <x-ui.icon icon="sun" padding="p-0" width="w-6"/>
                </div>
            </div>
        </div>
    </div>
</div>
