<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle($request, Closure $next, ?string $permission = null)
    {
        $user = auth()->user();
        
        // Blocked or inactive users are always denied
        if ($user->isBlocked() || $user->isInactive()) {
            abort(403, 'Your account is inactive or blocked.');
        }

        // Permission check
        if ($permission !== null && !$user->hasPermission($permission)) {
            abort(403, 'You do not have the required permission.');
        }

        return $next($request);
    }
}
