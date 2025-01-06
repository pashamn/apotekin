<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
   public function handle(Request $request, Closure $next, $level)
{
    if (!auth()->check() || auth()->user()->level !== $level) {
        return redirect('/')->with('error', 'Unauthorized access');
    }

    return $next($request);
}
}