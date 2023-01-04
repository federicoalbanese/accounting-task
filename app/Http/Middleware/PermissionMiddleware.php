<?php

namespace App\Http\Middleware;

use App\Constants\RoleConstants;
use App\Models\User;
use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        if ($user = $request->user()) {
            // super admin is allowed to do any action
            if ($user->hasRole(RoleConstants::SUPER_ADMIN)) {
                return $next($request);
            }
            if ($user->hasPermissions($request->route()->getActionName())) {
                return $next($request);
            }

            abort(403);
        }

        return abort(401);
    }
}
