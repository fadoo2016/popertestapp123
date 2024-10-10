<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class LogRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
		$user = Auth::user();
		$role = Auth::check() ? $user->role : 'guest';
		$uid = Auth::check() ? ' | UserID:' . $user->id:'';
		Log::info('Client:'.$request->header('X-Forwarded-For').' | request_id:' .$request->header('X-Request-Id'). ' | role: ' .$role . $uid . ' | request:'.$request->url(). ' | params:', $request->all());
        return $next($request);
    }
}
