<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginFromEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $route = $request->route();
        $routeParameters = $route->parameters();
        $fullRoute = $route->uri();

        foreach ($routeParameters as $key => $value) {
            $fullRoute = str_replace('{' . $key . '}', $value, $fullRoute);
        }

        $backLink = $fullRoute;

        dd($backLink);

        return $next($request);
    }
}
