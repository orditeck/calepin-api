<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class AppendDebugToJson
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $debugOn = $request->exists('_debug');
        $request->request->remove('_debug'); // Remove from request
        $response = $next($request);

        if (
            $response instanceof JsonResponse &&
            $debugOn &&
            app()->bound('debugbar') &&
            app('debugbar')->isEnabled() &&
            is_object($response->getData())
        ) {
            $response->setData($response->getData(true) + [
                    '_debugbar' => app('debugbar')->getData(),
                ]);
        }

        return $response;
    }
}
