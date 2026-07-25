<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('student_id')) {
            return redirect('/student/login');
        }
        return $next($request);
    }
}