<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDemoFeatureEnabled
{
    /**
     * Block risky routes when the public demo is running in constrained mode.
     */
    public function handle(Request $request, Closure $next, string $feature): Response
    {
        if (! config('demo.enabled')) {
            return $next($request);
        }

        if (! config("demo.features.{$feature}", false)) {
            abort(403, 'This feature is disabled in the public demo.');
        }

        return $next($request);
    }
}
