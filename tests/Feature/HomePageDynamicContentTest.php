<?php

use Database\Seeders\BlogSeeder;
use Database\Seeders\LibrarySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('home page renders library and blog content dynamically', function () {
    $this->seed(LibrarySeeder::class);
    $this->seed(BlogSeeder::class);

    $this->get('/')
        ->assertSuccessful()
        ->assertSee('10 Cognitive Biases That Control Your Decisions')
        ->assertSee('Cognitive Biases')
        ->assertSee('The Mental Models That Will Change the Way You Make Decisions')
        ->assertSee('/library/1', false)
        ->assertSee('/blog/the-mental-models-that-will-change-the-way-you-make-decisions', false);
});
