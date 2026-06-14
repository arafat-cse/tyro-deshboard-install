<?php

use App\Models\LibraryItem;
use Database\Seeders\LibrarySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('library page renders published seeded content dynamically', function () {
    $this->seed(LibrarySeeder::class);

    $this->get('/library')
        ->assertSuccessful()
        ->assertSee('10 Cognitive Biases That Control Your Decisions')
        ->assertSee('9 Results Found')
        ->assertSee('Cognitive Biases');
});

test('library item detail page shows item data', function () {
    $this->seed(LibrarySeeder::class);

    $item = LibraryItem::where('type', 'VIDEO')->firstOrFail();

    $this->get(route('life-decode.library.show', $item))
        ->assertSuccessful()
        ->assertSee($item->title)
        ->assertSee($item->description)
        ->assertSee($item->format)
        ->assertSee($item->primary_topic);
});

test('library item detail page embeds youtube content url', function () {
    $item = LibraryItem::create([
        'type' => 'VIDEO',
        'title' => 'YouTube Test Video',
        'description' => 'A video loaded from YouTube.',
        'primary_topic' => 'Testing',
        'format' => 'YouTube video',
        'difficulty' => 'Beginner',
        'duration_seconds' => 60,
        'content_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        'is_published' => true,
    ]);

    $this->get(route('life-decode.library.show', $item))
        ->assertSuccessful()
        ->assertSee('https://www.youtube.com/embed/dQw4w9WgXcQ')
        ->assertDontSee('Open Resource');
});
