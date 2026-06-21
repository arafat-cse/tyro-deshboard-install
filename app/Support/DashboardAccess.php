<?php

namespace App\Support;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Str;

class DashboardAccess
{
    public static function isAdmin(?Authenticatable $user): bool
    {
        if (! $user || ! method_exists($user, 'tyroRoleSlugs')) {
            return false;
        }

        $roleSlugs = $user->tyroRoleSlugs();

        foreach (config('tyro-dashboard.admin_roles', ['admin', 'super-admin']) as $role) {
            if (in_array($role, $roleSlugs, true)) {
                return true;
            }
        }

        return false;
    }

    public static function can(?Authenticatable $user, string|array|null $permissions): bool
    {
        if (self::isAdmin($user)) {
            return true;
        }

        if (! $user || ! method_exists($user, 'hasPrivilege')) {
            return false;
        }

        foreach ((array) $permissions as $permission) {
            if ($permission && $user->hasPrivilege($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param  array<int, string>  $permissions
     */
    public static function canAny(?Authenticatable $user, array $permissions): bool
    {
        return self::can($user, $permissions);
    }

    public static function routePermission(?string $routeName): string|array|null
    {
        if (! $routeName) {
            return null;
        }

        foreach (config('dashboard-permissions.routes', []) as $pattern => $permission) {
            if (Str::is($pattern, $routeName)) {
                return $permission;
            }
        }

        return null;
    }

    public static function resourcePermission(?string $resource): ?string
    {
        if (! $resource) {
            return null;
        }

        $resourceConfig = config("tyro-dashboard.resources.{$resource}", []);

        return $resourceConfig['permission']
            ?? config("dashboard-permissions.resources.{$resource}");
    }
}
