<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Cognitive Biases',
            'Mindset',
            'Mental Models',
            'Productivity',
            'Human Behavior',
            'Philosophy',
            'Case Studies',
        ];

        $categoryModels = collect($categories)
            ->mapWithKeys(function (string $category, int $index): array {
                $model = BlogCategory::updateOrCreate(
                    ['name' => $category],
                    [
                        'slug' => Str::slug($category),
                        'sort_order' => ($index + 1) * 10,
                        'is_active' => true,
                    ]
                );

                return [$category => $model];
            });

        $posts = [
            [
                'category' => 'Mental Models',
                'title' => 'The Mental Models That Will Change the Way You Make Decisions',
                'slug' => 'the-mental-models-that-will-change-the-way-you-make-decisions',
                'excerpt' => 'A collection of timeless mental models to help you think clearer, decide better, and avoid common traps.',
                'content' => 'Mental models are reusable ways of seeing problems clearly. They help you slow down, compare options, and avoid predictable thinking traps.',
                'published_on' => '2024-05-16',
                'read_minutes' => 10,
                'thumbnail_style' => '',
                'is_featured' => true,
                'is_popular' => false,
                'sort_order' => 10,
            ],
            [
                'category' => 'Cognitive Biases',
                'title' => '10 Cognitive Biases That Are Secretly Controlling Your Decisions',
                'slug' => '10-cognitive-biases-that-are-secretly-controlling-your-decisions',
                'excerpt' => 'Understand the hidden mental shortcuts that shape your choices, beliefs, and actions every single day.',
                'content' => 'Cognitive biases are mental shortcuts. They can help you move quickly, but they also distort judgment when you do not notice them.',
                'published_on' => '2024-05-15',
                'read_minutes' => 8,
                'thumbnail_style' => 'bias-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 20,
            ],
            [
                'category' => 'Mindset',
                'title' => 'Why Most People Never Achieve Their Goals (And How to Break the Cycle)',
                'slug' => 'why-most-people-never-achieve-their-goals-and-how-to-break-the-cycle',
                'excerpt' => 'It is not about motivation. It is about identity, systems, and understanding how your mind really works.',
                'content' => 'Goals often fail because the system around them never changes. Identity, environment, and feedback loops matter more than bursts of motivation.',
                'published_on' => '2024-05-12',
                'read_minutes' => 7,
                'thumbnail_style' => 'mindset-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 30,
            ],
            [
                'category' => 'Human Behavior',
                'title' => 'The Psychology of First Impressions: Why You Judge in Seconds',
                'slug' => 'the-psychology-of-first-impressions-why-you-judge-in-seconds',
                'excerpt' => 'The science behind snap judgments and how to make better decisions about people and situations.',
                'content' => 'First impressions are fast because the brain tries to conserve energy. The trick is learning when those quick judgments are useful and when they mislead.',
                'published_on' => '2024-05-10',
                'read_minutes' => 6,
                'thumbnail_style' => 'human-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 40,
            ],
            [
                'category' => 'Productivity',
                'title' => 'Deep Work in a Distracted World: A Practical Guide',
                'slug' => 'deep-work-in-a-distracted-world-a-practical-guide',
                'excerpt' => 'How to protect your focus, do meaningful work, and get more done in less time.',
                'content' => 'Deep work is less about forcing discipline and more about designing friction against shallow distractions.',
                'published_on' => '2024-05-08',
                'read_minutes' => 9,
                'thumbnail_style' => 'desk-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 50,
            ],
            [
                'category' => 'Philosophy',
                'title' => 'Stoicism in Daily Life: Ancient Wisdom for Modern Problems',
                'slug' => 'stoicism-in-daily-life-ancient-wisdom-for-modern-problems',
                'excerpt' => 'Timeless Stoic principles to help you stay calm, resilient, and focused no matter what.',
                'content' => 'Stoicism teaches control, perspective, and practice. It is a practical operating system for hard moments.',
                'published_on' => '2024-05-05',
                'read_minutes' => 7,
                'thumbnail_style' => 'philosophy-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 60,
            ],
            [
                'category' => 'Case Studies',
                'title' => 'How One Simple Habit Transformed My Thinking (A Real Case Study)',
                'slug' => 'how-one-simple-habit-transformed-my-thinking-a-real-case-study',
                'excerpt' => 'A personal experiment in changing one tiny habit that led to massive changes.',
                'content' => 'Small habits are powerful because they compound and quietly reshape identity.',
                'published_on' => '2024-05-02',
                'read_minutes' => 6,
                'thumbnail_style' => 'case-img',
                'is_featured' => false,
                'is_popular' => false,
                'sort_order' => 70,
            ],
            [
                'category' => 'Cognitive Biases',
                'title' => 'The Halo Effect: How It Affects Every Decision You Make',
                'slug' => 'the-halo-effect-how-it-affects-every-decision-you-make',
                'excerpt' => 'Why one strong impression can quietly influence your whole judgment.',
                'content' => 'The halo effect happens when one trait changes the way you judge everything else about a person, product, or idea.',
                'published_on' => '2024-05-01',
                'read_minutes' => 8,
                'thumbnail_style' => 'halo-img',
                'is_featured' => false,
                'is_popular' => true,
                'sort_order' => 80,
            ],
            [
                'category' => 'Mindset',
                'title' => 'The Reticular Activating System (RAS) Explained Simply',
                'slug' => 'the-reticular-activating-system-ras-explained-simply',
                'excerpt' => 'How your mind filters reality and decides what deserves attention.',
                'content' => 'The RAS acts like an attention filter. What you repeatedly prime tends to become easier to notice.',
                'published_on' => '2024-04-28',
                'read_minutes' => 9,
                'thumbnail_style' => 'ras-img',
                'is_featured' => false,
                'is_popular' => true,
                'sort_order' => 90,
            ],
            [
                'category' => 'Mindset',
                'title' => 'Why Overthinking Is Destroying Your Peace',
                'slug' => 'why-overthinking-is-destroying-your-peace',
                'excerpt' => 'A practical look at the loop between control, uncertainty, and mental noise.',
                'content' => 'Overthinking often feels productive because it mimics problem-solving, but it rarely changes the next useful action.',
                'published_on' => '2024-04-25',
                'read_minutes' => 7,
                'thumbnail_style' => 'overthink-img',
                'is_featured' => false,
                'is_popular' => true,
                'sort_order' => 100,
            ],
        ];

        foreach ($posts as $post) {
            $category = $categoryModels[$post['category']];

            BlogPost::updateOrCreate(
                ['title' => $post['title']],
                $post + [
                    'blog_category_id' => $category->id,
                    'is_published' => true,
                ]
            );
        }
    }
}
