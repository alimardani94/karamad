<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param $type
     * @return mixed
     */
    public function handle($request, Closure $next, $type)
    {
        $isAdmin = Auth::user()->isAdmin();

        if ($type == 'admin' and !$isAdmin) {
            return redirect()->route('dashboard.home');
        }
        if ($type == 'user' and $isAdmin) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}
