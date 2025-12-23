<td class="p-2 text-left">
    @isset($href)
        <a class="hover:underline" href="{{ $href }}">{{ $value }}</a>
    @else
        {{ $value }}
    @endisset
</td>
