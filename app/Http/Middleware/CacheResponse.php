<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CacheResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->isMethod('get')) {
            $cacheKey = $this->getCacheKey($request);
            if (Cache::has($cacheKey)) {
                return response()->json(json_decode(Cache::get($cacheKey)));
            } else {
                $response = $next($request);
                
                Cache::put($cacheKey, $response->getContent(), 60);
                return $response;
            }
        }
        return $next($request);
    }

    protected function getCacheKey(Request $request)
    {
        // Create a unique cache key based on the request's URI
        return 'route_' . Str::slug($request->url()) . '_' . md5($request->getQueryString());
    }
}
