<tr
    @class([
        'hover:bg-gray-50 hover:dark:bg-gray-300/80',
        'bg-gray-200/80 dark:bg-gray-600/80' => $loop->odd,
        'bg-gray-300/80 dark:bg-gray-700/80' => $loop->even,
    ])
>
    {{ $slot }}
</tr>
