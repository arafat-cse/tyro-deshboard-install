<?php

use App\Models\AboutMetric;
use App\Models\AboutPage;
use Database\Seeders\AboutSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

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

test('dashboard can replace the about hero image dynamically', function () {
    Storage::fake('public');
    $this->withoutMiddleware();
    $this->seed(AboutSeeder::class);

    $aboutPage = AboutPage::firstOrFail();
    $payload = $aboutPage->only([
        'eyebrow',
        'title_line_one',
        'title_line_two',
        'hero_description',
        'hero_image_path',
        'mission_title',
        'mission_description',
        'creator_title',
        'creator_intro',
        'creator_body_one',
        'creator_body_two',
        'creator_signature',
        'creator_role',
        'creator_image_path',
        'credentials_title',
        'credentials_description',
        'social_title',
        'journey_title',
        'journey_description',
        'journey_button_text',
        'journey_button_url',
        'quote_text',
        'quote_author',
    ]);

    $this->put(route('dashboard.about-page.update'), $payload + [
        'hero_image' => UploadedFile::fake()->create('about-hero.jpg', 100, 'image/jpeg'),
    ])->assertRedirect();

    $aboutPage->refresh();

    expect($aboutPage->hero_image_path)->toStartWith('about/hero/');
    Storage::disk('public')->assertExists($aboutPage->hero_image_path);

    $this->get('/about')
        ->assertSuccessful()
        ->assertSee(Storage::disk('public')->url($aboutPage->hero_image_path), false);
});
