<?php

namespace Database\Seeders;

use App\Models\ToolItem;
use App\Models\ToolPage;
use App\Models\ToolSection;
use Illuminate\Database\Seeder;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toolPage = ToolPage::firstOrCreate([], [
            'eyebrow' => 'Tools & Resources',
            'title_line_one' => 'Practical tools.',
            'title_line_two' => 'Real transformation.',
            'description' => 'Hand-picked frameworks, worksheets, and checklists to help you understand better, decide smarter, and live with more clarity and purpose.',
        ]);

        $sections = [
            [
                'type' => 'hero_points',
                'title' => 'Hero Points',
                'sort_order' => 10,
                'items' => [
                    ['title' => 'Science-backed frameworks', 'icon_text' => 'F', 'sort_order' => 10],
                    ['title' => 'Simple & actionable tools', 'icon_text' => 'T', 'sort_order' => 20],
                    ['title' => 'Designed for daily application', 'icon_text' => 'D', 'sort_order' => 30],
                    ['title' => 'Improve your mind and behavior', 'icon_text' => 'M', 'sort_order' => 40],
                ],
            ],
            [
                'type' => 'tool_cards',
                'title' => 'Popular Tools',
                'button_text' => 'View All Tools',
                'button_url' => '#',
                'sort_order' => 20,
                'items' => [
                    ['title' => 'Daily Mind Audit', 'description' => 'Reflect on your thoughts, emotions, and actions every day.', 'icon_text' => 'A', 'style_class' => 'gold-bg', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 10],
                    ['title' => 'Cognitive Bias Cheat Sheet', 'description' => 'Identify and avoid the hidden biases that control your decisions.', 'icon_text' => 'B', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 20],
                    ['title' => 'Focus & Distract Tracker', 'description' => 'Track your focus, eliminate distractions, and build deep work habits.', 'icon_text' => 'F', 'style_class' => 'green-bg', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 30],
                    ['title' => 'Habit Building Template', 'description' => 'Build better habits with this simple step-by-step tracking system.', 'icon_text' => 'H', 'style_class' => 'purple-bg', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 40],
                    ['title' => 'Emotional Intelligence Worksheet', 'description' => 'Improve self-awareness, empathy, and emotional control.', 'icon_text' => 'E', 'style_class' => 'pink-bg', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 50],
                    ['title' => 'Life Direction Framework', 'description' => 'Clarify your goals, values, and next steps in life.', 'icon_text' => 'L', 'style_class' => 'gold-bg', 'button_text' => 'Download', 'button_url' => '#', 'sort_order' => 60],
                ],
            ],
            [
                'type' => 'categories',
                'title' => 'Browse by Category',
                'button_text' => 'View All Categories',
                'button_url' => '#',
                'sort_order' => 30,
                'items' => [
                    ['title' => 'Cognitive Tools', 'description' => 'Understand your mind and thinking patterns.', 'icon_text' => 'C', 'meta_one' => '12 Tools', 'sort_order' => 10],
                    ['title' => 'Mindset & Growth', 'description' => 'Build a growth mindset and mental resilience.', 'icon_text' => 'M', 'style_class' => 'green-bg', 'meta_one' => '15 Tools', 'sort_order' => 20],
                    ['title' => 'Focus & Productivity', 'description' => 'Improve focus, time management and productivity.', 'icon_text' => 'F', 'meta_one' => '14 Tools', 'sort_order' => 30],
                    ['title' => 'Behavior Change', 'description' => 'Tools to build better habits and break bad ones.', 'icon_text' => 'B', 'style_class' => 'green-bg', 'meta_one' => '10 Tools', 'sort_order' => 40],
                    ['title' => 'Emotional Intelligence', 'description' => 'Develop emotional awareness and strong relationships.', 'icon_text' => 'E', 'style_class' => 'pink-bg', 'meta_one' => '9 Tools', 'sort_order' => 50],
                    ['title' => 'Life Design', 'description' => 'Design a meaningful life aligned with your values.', 'icon_text' => 'L', 'style_class' => 'gold-bg', 'meta_one' => '8 Tools', 'sort_order' => 60],
                ],
            ],
            [
                'type' => 'toolkits',
                'title' => 'Featured Toolkits',
                'button_text' => 'View All Toolkits',
                'button_url' => '#',
                'sort_order' => 40,
                'items' => [
                    ['title' => 'The Mental Clarity Toolkit', 'description' => 'A complete system to clear mental noise, reduce overthinking, and think with clarity.', 'meta_one' => '5 Frameworks', 'meta_two' => '8 Worksheets', 'meta_three' => '3 Checklists', 'button_text' => 'Explore Toolkit', 'button_url' => '#', 'sort_order' => 10],
                    ['title' => 'The Self Improvement Toolkit', 'description' => 'Practical tools to upgrade your habits, mindset, and daily actions.', 'style_class' => 'green-img', 'meta_one' => '6 Frameworks', 'meta_two' => '10 Worksheets', 'meta_three' => '4 Checklists', 'button_text' => 'Explore Toolkit', 'button_url' => '#', 'sort_order' => 20],
                    ['title' => 'The Life Design Toolkit', 'description' => 'Align your goals, values, purpose and build a life you truly want.', 'style_class' => 'purple-img', 'meta_one' => '4 Frameworks', 'meta_two' => '6 Worksheets', 'meta_three' => '2 Checklists', 'button_text' => 'Explore Toolkit', 'button_url' => '#', 'sort_order' => 30],
                ],
            ],
            [
                'type' => 'how_steps',
                'title' => 'How It Works',
                'sort_order' => 50,
                'items' => [
                    ['title' => 'Choose a tool', 'description' => 'Pick a tool that matches your current challenge or goal.', 'icon_text' => 'S', 'meta_one' => '1', 'sort_order' => 10],
                    ['title' => 'Download & review', 'description' => 'Download the resource and go through the instructions.', 'icon_text' => 'D', 'meta_one' => '2', 'sort_order' => 20],
                    ['title' => 'Take action', 'description' => 'Apply the framework in your daily life consistently.', 'icon_text' => 'A', 'meta_one' => '3', 'sort_order' => 30],
                    ['title' => 'Track & improve', 'description' => 'Review your progress and refine your approach.', 'icon_text' => 'T', 'meta_one' => '4', 'sort_order' => 40],
                ],
            ],
        ];

        foreach ($sections as $sectionData) {
            $items = $sectionData['items'];
            unset($sectionData['items']);

            $section = ToolSection::updateOrCreate(
                [
                    'tool_page_id' => $toolPage->id,
                    'type' => $sectionData['type'],
                    'title' => $sectionData['title'],
                ],
                $sectionData + ['is_published' => true]
            );

            foreach ($items as $item) {
                ToolItem::updateOrCreate(
                    [
                        'tool_section_id' => $section->id,
                        'title' => $item['title'],
                    ],
                    $item + ['is_published' => true]
                );
            }
        }
    }
}
