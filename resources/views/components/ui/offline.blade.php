<div
    x-data="{ offline: !navigator.onLine }"
    x-init="
        window.addEventListener('offline', () => offline = true);
        window.addEventListener('online', () => offline = false);
    "
    x-show="offline"
    x-transition
    class="modalback bg-gray-500/80"
>
    <div class="modal glass bg-gray-500/50 p-4 rounded-3xl">
        <x-ui.h3 title="Offline?" position="w-full text-center"/>
        <div
            class="frow"
        >
            <x-ui.icon width="w-20" icon="internet"/>
        </div>
        <div class="mt-4 w-full frow">
            <div
                class="submit-button mx-3 bg-red-600/50 text-center"
            >
                Check your internet!!!
            </div>
        </div>
    </div>
</div>

