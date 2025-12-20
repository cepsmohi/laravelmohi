@if (session('success'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 2000)"
        x-show="show"
        x-transition
        class="modalback bg-gray-500"
    >
        <div class="modal glass bg-gray-500/50 p-4 rounded-3xl">
            <div class="sa success">
                <div class="sa-success">
                    <div class="sa-success-tip"></div>
                    <div class="sa-success-long"></div>
                    <div class="sa-success-placeholder"></div>
                    <div class="sa-success-fix"></div>
                </div>
            </div>
            <x-ui.h3 :title="session('success')"/>
        </div>
    </div>
@endif
