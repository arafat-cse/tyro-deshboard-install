<?php

namespace App\Support;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
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

    public static function canGroup(?Authenticatable $user, string $group, string|array $actions = 'view'): bool
    {
        return self::can($user, self::permissionsFor($group, $actions));
    }

    /**
     * @param  array<int, string>  $permissions
     */
    public static function canAny(?Authenticatable $user, array $permissions): bool
    {
        return self::can($user, $permissions);
    }

    /**
     * @return array<int, string>
     */
    public static function permissionsFor(string $group, string|array $actions = 'view'): array
    {
        $permissions = [];
        $groupConfig = self::groupConfig($group);

        foreach ((array) $actions as $action) {
            $permissions[] = "{$group}.{$action}";
        }

        foreach ($groupConfig['legacy'] ?? [] as $legacyPermission) {
            $permissions[] = $legacyPermission;
        }

        return array_values(array_unique($permissions));
    }

    /**
     * @return array<int, string>
     */
    public static function sidebarPermissions(): array
    {
        $permissions = [];

        foreach (config('dashboard-permissions.sidebar_groups', []) as $group) {
            $permissions = array_merge($permissions, self::permissionsFor($group, array_keys(self::groupConfig($group)['actions'] ?? ['view' => 'View'])));
        }

        return array_values(array_unique($permissions));
    }

    /**
     * @return array<string, mixed>
     */
    private static function groupConfig(string $group): array
    {
        return config('dashboard-permissions.groups', [])[$group] ?? [];
    }

    public static function routePermission(Request $request): string|array|null
    {
        $routeName = $request->route()?->getName();

        if (! $routeName) {
            return null;
        }

        if (Str::is('dashboard.about-management.*', $routeName)) {
            return self::permissionsFor(self::aboutSectionGroup($request->route('section')), 'view');
        }

        if ($routeName === 'dashboard.about-page.update') {
            return self::permissionsFor(self::aboutSectionGroup($request->input('_section')), 'edit');
        }

        foreach (config('dashboard-permissions.about_item_routes', []) as $pattern => $group) {
            if (Str::is($pattern, $routeName)) {
                return self::permissionsFor($group, self::actionFromRoute($routeName, $request->method()));
            }
        }

        foreach (config('dashboard-permissions.route_groups', []) as $pattern => $group) {
            if (Str::is($pattern, $routeName)) {
                return self::permissionsFor($group, self::actionFromRoute($routeName, $request->method()));
            }
        }

        return null;
    }

    public static function resourcePermission(?string $resource, string|array $action = 'view'): array
    {
        if (! $resource) {
            return [];
        }

        $resourceConfig = config("tyro-dashboard.resources.{$resource}", []);
        $group = $resourceConfig['permission_group']
            ?? config("dashboard-permissions.resources.{$resource}");

        if ($group) {
            return self::permissionsFor($group, $action);
        }

        $legacyPermission = $resourceConfig['permission'] ?? null;

        return $legacyPermission ? [$legacyPermission] : [];
    }

    public static function actionFromRoute(?string $routeName, string $method): string
    {
        $routeName = (string) $routeName;

        if (Str::endsWith($routeName, ['.create', '.store']) || $method === 'POST') {
            return 'create';
        }

        if (Str::endsWith($routeName, ['.edit', '.update']) || in_array($method, ['PUT', 'PATCH'], true)) {
            return 'edit';
        }

        if (Str::endsWith($routeName, ['.destroy', '.delete', '.bulk-destroy', '.flush']) || $method === 'DELETE') {
            return 'delete';
        }

        return 'view';
    }

    public static function aboutSectionGroup(?string $section): string
    {
        return config("dashboard-permissions.about_sections.{$section}", 'about.hero');
    }
}
