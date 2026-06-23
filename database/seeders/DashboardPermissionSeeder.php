<?php

namespace Database\Seeders;

use HasinHayder\Tyro\Models\Privilege;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Database\Seeder;

class DashboardPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get super-admin role
        $superAdminRole = Role::where('slug', 'super-admin')->first();

        // Create legacy permissions
        $legacySlugs = [];
        foreach (config('dashboard-permissions.legacy_permissions', []) as $slug => $permission) {
            $privilege = Privilege::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                ]
            );
            $legacySlugs[] = $slug;
        }

        // Create group-based permissions
        $groupSlugs = [];
        foreach (config('dashboard-permissions.groups', []) as $group => $config) {
            foreach ($config['actions'] as $action => $label) {
                $slug = "{$group}.{$action}";
                $privilege = Privilege::updateOrCreate(
                    ['slug' => $slug],
                    [
                        'name' => "{$config['name']}: {$label}",
                        'description' => "{$label} access for {$config['name']}.",
                    ]
                );
                $groupSlugs[] = $slug;
            }
        }

        // Assign all dashboard permissions to super-admin role
        if ($superAdminRole) {
            $allDashboardSlugs = array_merge($legacySlugs, $groupSlugs);
            foreach ($allDashboardSlugs as $slug) {
                $privilege = Privilege::where('slug', $slug)->first();
                if ($privilege) {
                    $superAdminRole->privileges()->syncWithoutDetaching([$privilege->id]);
                }
            }
        }
    }
}
