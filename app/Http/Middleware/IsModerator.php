<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsModerator
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || (!$user->is_moderator && !$user->is_admin)) {
            abort(403, 'Unauthorized. Moderator or Admin privileges required.');
        }

        return $next($request);
    }
}
