<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::user();
                if ($user->isAdmin()) {
                    return redirect('/admin/pending-jobs');
                } elseif ($user->isEmployer()) {
                    return redirect('/jobs/my-jobs');
                } elseif ($user->isCandidate()) {
                    return redirect('/jobs');
                }
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}