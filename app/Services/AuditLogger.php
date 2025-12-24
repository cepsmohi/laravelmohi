<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class AuditLogger
{
    public static function narrative(string $message): void
    {
        Log::channel('audit')->info($message, [
            'actor_id' => auth()->id(),
            'actor_email' => auth()->user()?->email,
            'ip' => request()->ip(),
            'user_agent' => substr((string) request()->userAgent(), 0, 255),
            'timestamp' => now()->toISOString(),
        ]);
    }
}
