<?php

namespace App\Http\Middleware;
use App\Models\Manga;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsMangaAuthor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Manga::where('author_id', Auth::id());

        if (!$user->exists()) {
             abort(404);
        } 
        return $next($request);
    }
}
