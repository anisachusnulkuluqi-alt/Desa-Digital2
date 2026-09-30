<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackWebsiteVisits
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (
            !$request->isMethod('get')
            || $request->user() !== null
            || $response->getStatusCode() >= 400
            || !str_starts_with((string) $response->headers->get('Content-Type'), 'text/html')
        ) {
            return $response;
        }

        $visitorId = $request->cookie('website_visitor_id') ?: Str::random(64);

        DB::table('website_visits')->insertOrIgnore([
            'visitor_hash' => hash('sha256', $visitorId),
            'visited_on' => now()->toDateString(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if (!$request->cookie('website_visitor_id')) {
            $response->withCookie(cookie('website_visitor_id', $visitorId, 525600));
        }

        return $response;
    }
}