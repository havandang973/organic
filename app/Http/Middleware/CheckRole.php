<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        if(Auth::check()) {
            if(Auth::user()->role === $role) {
                return redirect()->route('admin.login')->withErrors(['email' => 'Bạn không có quyền truy cập.']);
            }
        }
        return $next($request);
    }
}
