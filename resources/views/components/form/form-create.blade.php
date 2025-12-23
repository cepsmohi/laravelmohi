<form
    wire:submit="{{ $wiresubmit }}"
    id="{{ $formId }}"
    @isset($enctype) enctype="{{ $enctype }}" @endisset
>
    <div class="mt-8 fcol">
        <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-3xl">
            {{ $slot }}
            @if($submitCondi != null)
                <x-form.submit-button
                    form="{{ $formId }}"
                    icon="{{ $submitIcon }}"
                    tag="{{ $submitTag }}"
                />
            @endif
        </div>
    </div>
</form>
