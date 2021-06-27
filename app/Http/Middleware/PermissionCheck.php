<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class PermissionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $route, $action)
    {

        $user = auth()->user();

        if ($user->role_id === 1) {
            return $next($request);
        } else {
            if ($user->permissions != "null") {
                $permissions = json_decode($user->permissions, true);

                if (isset($permissions[$route][$action])) {
                    return $next($request);
                } else {
                    return abort(403);
                }
            } else {
                $perms = Role::where('id', $user->role_id)->first();

                $permissions = json_decode($perms->permissions, true);

                if (isset($permissions[$route][$action])) {
                    return $next($request);
                } else {
                    return abort(403);
                }
            }
        }

    }
}
