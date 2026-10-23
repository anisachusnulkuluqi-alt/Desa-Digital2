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

        $visitorId = $request->cookie('website_visitor_id');
        $isNewCookie = false;

        if (!$visitorId) {
            $visitorId = Str::random(64);
            $isNewCookie = true;
        }

        $today = now()->toDateString();
        $visitorHash = hash('sha256', $visitorId);
        $sessionKey = 'tracked_visit_' . $visitorHash . '_' . $today;

        // Jika dalam sesi yang sama pengunjung ini sudah tercatat hari ini, lewati tanpa query ulang
        if ($request->hasSession() && $request->session()->get($sessionKey)) {
            if ($isNewCookie) {
                $response->withCookie(cookie('website_visitor_id', $visitorId, 525600));
            }
            return $response;
        }

        try {
            DB::table('website_visits')->insertOrIgnore([
                'visitor_hash' => $visitorHash,
                'visited_on' => $today,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            if ($request->hasSession()) {
                $request->session()->put($sessionKey, true);
            }
        } catch (\Throwable) {
            // Abaikan jika tabel belum siap atau record sudah ada
        }

        if ($isNewCookie) {
            $response->withCookie(cookie('website_visitor_id', $visitorId, 525600));
        }

        return $response;
    }
}