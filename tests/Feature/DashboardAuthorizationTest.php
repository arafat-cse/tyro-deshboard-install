<?php

use App\Models\User;
use HasinHayder\Tyro\Models\Privilege;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('regular dashboard users do not see admin only resource links', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('My Profile')
        ->assertDontSee('Administration')
        ->assertDontSee('Users')
        ->assertDontSee('Tools Management')
        ->assertDontSee('Library Items');
});

test('super admin users see the admin sidebar', function () {
    $role = Role::create([
        'name' => 'Super Admin',
        'slug' => 'super-admin',
    ]);
    $user = User::factory()->create();
    $user->assignRole($role);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('Administration')
        ->assertSee('Users')
        ->assertSee('Resources')
        ->assertSee('Tools Management');
});

test('roles can be granted only the dashboard privileges they need', function () {
    $role = Role::create([
        'name' => 'Manager',
        'slug' => 'manager',
    ]);
    $privilege = Privilege::create([
        'name' => 'Manage About Page',
        'slug' => 'manage-about-page',
    ]);
    $role->attachPrivilege($privilege);

    $user = User::factory()->create();
    $user->assignRole($role);

    $this->actingAs($user)
        ->get('/dashboard/about-management/about-hero')
        ->assertSuccessful()
        ->assertSee('About Management');

    $this->actingAs($user)
        ->get('/dashboard/home-management/hero')
        ->assertForbidden();

    $this->actingAs($user)
        ->get('/dashboard/users')
        ->assertForbidden();
});

test('user management can be granted without making the role a full admin', function () {
    $role = Role::create([
        'name' => 'HR Manager',
        'slug' => 'hr-manager',
    ]);
    $privilege = Privilege::create([
        'name' => 'Manage Users',
        'slug' => 'manage-users',
    ]);
    $role->attachPrivilege($privilege);

    $user = User::factory()->create();
    $user->assignRole($role);

    $this->actingAs($user)
        ->get('/dashboard/users')
        ->assertSuccessful()
        ->assertSee('Users')
        ->assertDontSee(route('tyro-dashboard.roles.index'), false);

    $this->actingAs($user)
        ->get('/dashboard/roles')
        ->assertForbidden();
});

test('permissioned non admin users see the permission based dashboard sidebar', function () {
    $role = Role::create([
        'name' => 'Demo',
        'slug' => 'demo',
    ]);

    foreach (['manage-system-settings', 'manage-home-page', 'manage-about-page', 'manage-tools-page', 'manage-library', 'manage-blog'] as $slug) {
        $role->attachPrivilege(Privilege::create([
            'name' => str($slug)->replace('-', ' ')->title()->toString(),
            'slug' => $slug,
        ]));
    }

    $user = User::factory()->create();
    $user->assignRole($role);

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertSuccessful()
        ->assertSee('System Settings')
        ->assertSee('Home Management')
        ->assertSee('About Management')
        ->assertSee('Tools Management')
        ->assertSee('Library Items')
        ->assertSee('Blog Posts')
        ->assertDontSee(route('tyro-dashboard.users.index'), false)
        ->assertDontSee(route('tyro-dashboard.roles.index'), false);
});
