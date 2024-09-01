<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role_id === 1 && $request->offer->id === Auth::id()) {
            return $next($request);
        }
        return response()->json(['errors' => ['You do not have permission!']], 403);
    }
}
