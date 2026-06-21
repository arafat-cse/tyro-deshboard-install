<?php

namespace App\Http\Middleware;

use App\Support\DashboardAccess;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureDashboardPermission
{
    /**
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (DashboardAccess::isAdmin($user)) {
            return $next($request);
        }

        $permission = DashboardAccess::routePermission($request);

        if (! $permission && $request->route()?->hasParameter('resource')) {
            $permission = DashboardAccess::resourcePermission(
                $request->route('resource'),
                DashboardAccess::actionFromRoute($request->route()?->getName(), $request->method())
            );
        }

        abort_unless(DashboardAccess::can($user, $permission), 403);

        return $next($request);
    }
}
