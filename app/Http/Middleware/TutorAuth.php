<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TutorAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('tutor_id')) {
            return redirect('/tutor/login');
        }
        return $next($request);
    }
}