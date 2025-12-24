<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SessionTrait
{
    public function logoutDevice(string $sessionId)
    {
        DB::table('sessions')
            ->where('id', $sessionId)
            ->delete();

        return redirect()
            ->route('admin.users.show', $this->user)
            ->with('success', 'Device logged out.');
    }
}
