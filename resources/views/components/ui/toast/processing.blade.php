@if (session('processing'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 2000)"
        x-show="show"
        x-transition
        class="modalback bg-gray-500"
    >
        <div class="modal glass bg-gray-500/50 p-4 rounded-3xl">
            <div class="frows gap-2">
                <x-ui.icon icon="info"/>
                <div>{{ session('processing') }}</div>
            </div>
            <div class="mt-4 h-1 w-full bg-green-300 rounded overflow-hidden">
                <div
                    class="h-1 bg-green-600"
                    x-init="$el.style.width = '100%';
                            setTimeout(() => $el.style.width = '0%', 50)"
                    style="width: 100%; transition: width 2s linear;"
                ></div>
            </div>
        </div>
    </div>
@endif
