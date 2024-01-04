<?php

namespace App\Http\Middleware;

use App\Http\Controllers\Controller;
use App\Models\Societies;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->token;

        $society = Societies::where("login_tokens", $token)->first();

        if (!$society || !$token) {
            return response()->json(["error"=> 'anautorized user']);
        }

                
        $request->attributes->set('society_id', $society->id);
        $request->attributes->set('regional_id', $society->regional_id);
        return $next($request);
    }
}
