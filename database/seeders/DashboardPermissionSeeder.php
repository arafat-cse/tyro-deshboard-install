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
        foreach (config('dashboard-permissions.permissions', []) as $slug => $permission) {
            Privilege::updateOrCreate(
                ['slug' => $slug],
                [
                    'name' => $permission['name'],
                    'description' => $permission['description'],
                ]
            );
        }
    }
}
