<x-ui.table.body>
    @php
        $sessions = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderByDesc('last_activity')
            ->get();
    @endphp
    @forelse($sessions as $session)
        <x-ui.table.body.tr :$loop>
            <x-ui.table.body.tdbl :$loop :value="$session->ip_address"/>
            <td class="p-2 text-left">
                @if ($session->id == session()->getId())
                    <div class="w-4 h-4 rounded-full bg-purple-500"></div>
                @endif
            </td>
            <x-ui.table.body.td :value="$session->user_agent"/>
            @php
                $time = date('Y-m-d H:i:s', $session->last_activity);
            @endphp
            <x-ui.table.body.td :value="$time"/>
            <x-ui.table.body.tdbr :$loop wireclick="logoutDevice('{{ $session->id }}')" icon="logout"/>
        </x-ui.table.body.tr>
    @empty
        <tr
            @class([
                'hover:bg-gray-50 hover:dark:bg-gray-300/80',
                'bg-gray-200/80 dark:bg-gray-600/80',
            ])
        >
            <td class="p-2 text-left" colspan="4">Not logged in</td>
        </tr>
    @endforelse
</x-ui.table.body>
