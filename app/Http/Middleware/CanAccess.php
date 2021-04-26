<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanAccess
{
    public function handle(Request $request, Closure $next)
    {
      if(Auth::guard('professor')->check() || Auth::check())
      {
        return $next($request);
      }

        return redirect('/');
    }
}
