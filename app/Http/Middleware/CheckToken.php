<?php

namespace App\Http\Middleware;

use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\HttpException;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, \Closure $next): mixed
    {
        $this->checkToken($request);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function checkToken($request): void
    {
        if ($request->filled('access_token') && $request->access_token === env('API_ACCESS_TOKEN')) {
            return;
        }

        $this->unauthenticated();
    }

    /**
     * Handle an unauthenticated user.
     *
     * @return void
     *
     * @throws AuthenticationException
     */
    protected function unauthenticated(): void
    {
        throw new HttpException(401, 'Wrong access token');
    }

}
