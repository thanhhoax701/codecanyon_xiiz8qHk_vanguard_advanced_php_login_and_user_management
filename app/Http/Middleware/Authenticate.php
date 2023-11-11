<?php

namespace Vanguard\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Authenticate
{
    public function __construct(private Guard $auth)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->auth->guest()) {
            return $request->expectsJson()
                ? response('Unauthorized.', 401)
                : redirect()->guest('login');
        }

        return $next($request);
    }
}
