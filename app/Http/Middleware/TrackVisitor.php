<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Carbon\Carbon;

class TrackVisitor
{
    public function handle($request, Closure $next)
    {
        $ip = $request->ip();
        $today = Carbon::today();

        if (!Visitor::where('ip_address', $ip)->whereDate('visit_date', $today)->exists()) {
            Visitor::create([
                'ip_address' => $ip,
                'visit_date' => $today,
            ]);
        }

        return $next($request);
    }
}
