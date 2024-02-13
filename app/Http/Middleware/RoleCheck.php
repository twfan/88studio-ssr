<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        // Get the route URI
        $uri = $request->route()->uri();
        $backLink = '';

        $route = $request->route();
        $routeParameters = $route->parameters();
        $fullRoute = $route->uri();

        foreach ($routeParameters as $key => $value) {
            $fullRoute = str_replace('{' . $key . '}', $value, $fullRoute);
        }

        $backLink = $fullRoute;


        // Extract the prefix from the URI
        $prefix = explode('/', $uri)[0];

        foreach ($roles as $role) {
            if (Auth::check() && Auth::user()->role == $role) {
                return $next($request);
            }
            Auth::logout();
            if ($prefix === 'member') {
                return redirect()->route('member.login')->with([
                    'status' => 'You need to login first to access this page.',
                    'backLink' => $backLink
                ]);
            } else {
                return redirect()->route('login')->with('status', 'You are not authorized to access this page.');
            }
        }
        return $next($request);
    }
}
