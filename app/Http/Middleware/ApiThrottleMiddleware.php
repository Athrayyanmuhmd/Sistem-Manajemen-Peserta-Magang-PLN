<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Illuminate\Cache\RateLimiter;
use Illuminate\Support\Facades\Auth;

class ApiThrottleMiddleware
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, int $maxAttempts = 60, int $decayMinutes = 1): SymfonyResponse
    {
        $key = $this->resolveRequestSignature($request);

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            $retryAfter = $this->limiter->availableIn($key);
            
            return response()->json([
                'success' => false,
                'message' => 'Too many requests. Please try again later.',
                'retry_after' => $retryAfter
            ], 429, [
                'X-RateLimit-Limit' => $maxAttempts,
                'X-RateLimit-Remaining' => 0,
                'Retry-After' => $retryAfter,
            ]);
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        $response = $next($request);

        $remaining = $maxAttempts - $this->limiter->attempts($key);
        
        return $response->withHeaders([
            'X-RateLimit-Limit' => $maxAttempts,
            'X-RateLimit-Remaining' => max(0, $remaining),
        ]);
    }

    /**
     * Resolve request signature.
     */
    protected function resolveRequestSignature(Request $request): string
    {
        if (Auth::check()) {
            return 'api_throttle:user:' . Auth::id();
        }

        return 'api_throttle:ip:' . $request->ip();
    }
}