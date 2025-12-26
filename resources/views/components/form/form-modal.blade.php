@teleport('#modaldiv')
<div class="modalback bg-gray-900/80">
    <div class="modal bg-gray-300/70 dark:bg-gray-700/80 p-4 rounded-3xl">
        <x-form.closeform wireclick="$toggle('{{ $formCondition }}')"/>
        <form
            class="min-w-44"
            @if($submitCondition)
                wire:submit="{{ $submitFun }}"
            @endif
            id="{{ $formId }}"
            @isset($enctype) enctype="{{ $enctype }}" @endisset
        >
            <div class="relative fcols">
                <div class="mb-2 stitle text-grad">{!! $formTitle ?? '' !!}</div>
                {{ $slot }}
                @if($submitCondition)
                    <x-form.submit-button
                        form="{{ $formId }}"
                        icon="{{ $submitIcon ?? 'refresh' }}"
                        tag="{{ $submitTag ?? 'Update' }}"
                    />
                @endif
            </div>
        </form>
    </div>
</div>
@endteleport
