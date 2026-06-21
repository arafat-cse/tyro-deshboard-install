<?php

use App\Models\User;
use HasinHayder\Tyro\Models\Privilege;
use HasinHayder\Tyro\Models\Role;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function userWithDashboardPrivileges(array $privilegeSlugs): User
{
    $role = Role::create([
        'name' => 'Scoped Manager',
        'slug' => 'scoped-manager-'.str()->random(6),
    ]);

    foreach ($privilegeSlugs as $slug) {
        $role->attachPrivilege(Privilege::create([
            'name' => str($slug)->replace(['.', '-'], ' ')->title()->toString(),
            'slug' => $slug,
        ]));
    }

    $user = User::factory()->create();
    $user->assignRole($role);

    return $user;
}

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

test('about sections can be granted as view only privileges', function () {
    $user = userWithDashboardPrivileges(['about.hero.view']);

    $this->actingAs($user)
        ->get('/dashboard/about-management/about-hero')
        ->assertSuccessful()
        ->assertSee('About Hero')
        ->assertSee('About Management')
        ->assertDontSee('Our Mission');

    $this->actingAs($user)
        ->get('/dashboard/about-management/our-mission')
        ->assertForbidden();

    $this->actingAs($user)
        ->put('/dashboard/about-page', ['_section' => 'about-hero'])
        ->assertForbidden();
});

test('resource create access is separate from resource view access', function () {
    $user = userWithDashboardPrivileges(['library.view']);

    $this->actingAs($user)
        ->get('/dashboard/resources/library-items')
        ->assertSuccessful()
        ->assertSee('Library Items');

    $this->actingAs($user)
        ->get('/dashboard/resources/library-items/create')
        ->assertForbidden();
});

test('role form renders grouped action privileges', function () {
    foreach (['about.hero.view', 'about.hero.create', 'about.hero.edit', 'about.hero.delete'] as $slug) {
        Privilege::create([
            'name' => str($slug)->replace(['.', '-'], ' ')->title()->toString(),
            'slug' => $slug,
        ]);
    }

    $role = Role::create([
        'name' => 'Super Admin',
        'slug' => 'super-admin',
    ]);
    $user = User::factory()->create();
    $user->assignRole($role);

    $this->actingAs($user)
        ->get('/dashboard/roles/create')
        ->assertSuccessful()
        ->assertSee('About: Hero')
        ->assertSee('about.hero.view')
        ->assertSee('about.hero.create')
        ->assertSee('about.hero.edit')
        ->assertSee('about.hero.delete');
});
