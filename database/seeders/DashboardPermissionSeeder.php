<?php

namespace Database\Seeders;

use HasinHayder\Tyro\Models\Privilege;
use Illuminate\Database\Seeder;

class DashboardPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (config('dashboard-permissions.legacy_permissions', []) as $slug => $permission) {
            Privilege::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                ]
            );
        }

        foreach (config('dashboard-permissions.groups', []) as $group => $config) {
            foreach ($config['actions'] as $action => $label) {
                Privilege::updateOrCreate(
                    ['slug' => "{$group}.{$action}"],
                    [
                        'name' => "{$config['name']}: {$label}",
                        'description' => "{$label} access for {$config['name']}.",
                    ]
                );
            }
        }
    }
}
