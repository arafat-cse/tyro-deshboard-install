<?php

use App\Models\AboutMetric;
use Database\Seeders\AboutSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('about page renders seeded content dynamically', function () {
    $this->seed(AboutSeeder::class);

    $this->get('/about')
        ->assertSuccessful()
        ->assertSee('Decode life.')
        ->assertSee('Our Mission')
        ->assertSee('The Creator')
        ->assertSee('Credentials &amp; Approach', false)
        ->assertSee('Find Life Decode Everywhere')
        ->assertSee('Our Journey So Far')
        ->assertSee('@LifeDecode');
});

test('about page hides unpublished metric items', function () {
    $this->seed(AboutSeeder::class);

    AboutMetric::where('value', '500K+')->firstOrFail()->update([
        'is_published' => false,
    ]);

    $this->get('/about')
        ->assertSuccessful()
        ->assertDontSee('500K+')
        ->assertSee('250+');
});
