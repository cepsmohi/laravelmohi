@if (session('alert'))
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition
        class="modalback bg-gray-500"
    >
        <div class="modal glass bg-gray-500/50 p-4 rounded-3xl">
            <div class="sa error">
                <div class="sa-error">
                    <div class="sa-error-x">
                        <div class="sa-error-left"></div>
                        <div class="sa-error-right"></div>
                    </div>
                    <div class="sa-error-placeholder"></div>
                    <div class="sa-error-fix"></div>
                </div>
            </div>
            <x-ui.h3 :title="session('alert')"/>
            <div class="mt-4 w-full frow">
                <div
                    class="submit-button mx-3 bg-red-600 text-white text-center"
                    @click="show = false"
                >
                    Got it...
                </div>
            </div>
        </div>
    </div>
@endif
