<?php

use App\Models\ToolItem;
use Database\Seeders\ToolsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('tools page renders seeded content dynamically', function () {
    $this->seed(ToolsSeeder::class);

    $this->get('/tools')
        ->assertSuccessful()
        ->assertSee('Practical tools.')
        ->assertSee('Daily Mind Audit')
        ->assertSee('Browse by Category')
        ->assertSee('The Mental Clarity Toolkit')
        ->assertSee('Choose a tool');
});

test('tools page hides unpublished items', function () {
    $this->seed(ToolsSeeder::class);

    ToolItem::where('title', 'Daily Mind Audit')->firstOrFail()->update([
        'is_published' => false,
    ]);

    $this->get('/tools')
        ->assertSuccessful()
        ->assertDontSee('Daily Mind Audit')
        ->assertSee('Cognitive Bias Cheat Sheet');
});
