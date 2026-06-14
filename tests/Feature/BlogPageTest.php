<?php

use Database\Seeders\BlogSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('blog page renders content', function () {
    $this->seed(BlogSeeder::class);

    $this->get('/blog')
        ->assertSuccessful()
        ->assertSee('Life Decode Blog')
        ->assertSee('The Halo Effect')
        ->assertSee('Popular Posts')
        ->assertSee('/blog/the-halo-effect-how-it-affects-every-decision-you-make', false);
});

test('blog detail page renders dynamic post content', function () {
    $this->seed(BlogSeeder::class);

    $this->get('/blog/the-halo-effect-how-it-affects-every-decision-you-make')
        ->assertSuccessful()
        ->assertSee('Back to Blog')
        ->assertSee('The Halo Effect: How It Affects Every Decision You Make')
        ->assertSee('Why one strong impression can quietly influence your whole judgment.');
});
