<x-ui.table.body>
    @php
        $sessions = \Illuminate\Support\Facades\DB::table('sessions')
            ->where('user_id', $user->id)
            ->orderByDesc('last_activity')
            ->get();
    @endphp
    @foreach($sessions as $session)
        <x-ui.table.body.tr :$loop>
            <x-ui.table.body.tdbl :$loop :value="$session->ip_address"/>
            <x-ui.table.body.td :value="$session->user_agent"/>
            @php
                $time = date('Y-m-d H:i:s', $session->last_activity);
            @endphp
            <x-ui.table.body.td :value="$time"/>
            <x-ui.table.body.tdbr :$loop wireclick="logoutDevice('{{ $session->id }}')" icon="logout"/>
        </x-ui.table.body.tr>
    @endforeach
</x-ui.table.body>
