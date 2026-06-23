<?php

namespace Database\Seeders;

use App\Models\User;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create superadmin user
        $superAdmin = User::updateOrCreate(
            ['email' => 'super@lifedecode.com'],
            [
                'name' => 'Super Admin',
                'password' => Hash::make('Abcd@1234'),
            ]
        );

        // Assign super-admin role to the user
        $superAdminRole = Role::where('slug', 'super-admin')->first();
        if ($superAdminRole) {
            $superAdmin->roles()->syncWithoutDetaching([$superAdminRole->id]);
        }

        // Create admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@lifedecode.com'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('Abcd@1234'),
            ]
        );

        // Assign admin role to the user
        $adminRole = Role::where('slug', 'admin')->first();
        if ($adminRole) {
            $admin->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        $this->call(DashboardPermissionSeeder::class);
        $this->call(LibrarySeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ToolsSeeder::class);
        $this->call(AboutSeeder::class);
    }
}
