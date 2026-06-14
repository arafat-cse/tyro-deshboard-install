<?php

namespace Database\Seeders;

use App\Models\LibraryItem;
use Illuminate\Database\Seeder;

class LibrarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'type' => 'VIDEO',
                'title' => '10 Cognitive Biases That Control Your Decisions',
                'description' => 'A practical walkthrough of the invisible biases shaping everyday choices.',
                'primary_topic' => 'Cognitive Biases',
                'secondary_topic' => 'Psychology',
                'format' => 'In-depth lesson',
                'difficulty' => 'Beginner',
                'published_on' => '2024-05-15',
                'meta_label' => '18 min',
                'duration_seconds' => 1125,
                'thumbnail_class' => 'creator-thumb',
                'label_class' => '',
                'sort_order' => 10,
            ],
            [
                'type' => 'VIDEO',
                'title' => 'The Reticular Activating System (RAS) Explained Simply',
                'description' => 'How your mind filters reality and decides what deserves attention.',
                'primary_topic' => 'Mindset',
                'secondary_topic' => 'Neuroscience',
                'format' => 'Explainer',
                'difficulty' => 'Intermediate',
                'published_on' => '2024-05-12',
                'meta_label' => '22 min',
                'duration_seconds' => 1330,
                'thumbnail_class' => 'hero-thumb',
                'label_class' => '',
                'sort_order' => 20,
            ],
            [
                'type' => 'ARTICLE',
                'title' => 'The Halo Effect: How It Affects Every Decision You Make',
                'description' => 'Why one strong impression can quietly influence your whole judgment.',
                'primary_topic' => 'Cognitive Biases',
                'secondary_topic' => 'Behavior',
                'format' => 'Deep dive',
                'difficulty' => 'Advanced',
                'published_on' => '2024-05-10',
                'meta_label' => '12 min read',
                'duration_seconds' => 0,
                'thumbnail_class' => '',
                'label_class' => 'article-label',
                'sort_order' => 30,
            ],
            [
                'type' => 'VIDEO',
                'title' => 'Why Most People Never Achieve Their Goals',
                'description' => 'The hidden systems and identity traps behind unfulfilled goals.',
                'primary_topic' => 'Mindset',
                'secondary_topic' => 'Self Improvement',
                'format' => 'Strategy video',
                'difficulty' => 'Beginner',
                'published_on' => '2024-05-08',
                'meta_label' => '21 min',
                'duration_seconds' => 1307,
                'thumbnail_class' => 'mindset-thumb',
                'label_class' => '',
                'sort_order' => 40,
            ],
            [
                'type' => 'RESOURCE',
                'title' => 'Life Audit Worksheet (PDF)',
                'description' => 'A guided worksheet to review life areas with more honesty and clarity.',
                'primary_topic' => 'Worksheet',
                'secondary_topic' => 'Personal Growth',
                'format' => 'PDF',
                'difficulty' => 'Intermediate',
                'published_on' => '2024-05-06',
                'meta_label' => 'PDF',
                'duration_seconds' => 0,
                'thumbnail_class' => 'desk-thumb',
                'label_class' => 'resource-label',
                'sort_order' => 50,
            ],
            [
                'type' => 'ARTICLE',
                'title' => 'Stoicism in Daily Life: Ancient Wisdom for Modern Problems',
                'description' => 'Timeless ideas for clearer decisions, calmer emotions, and stronger habits.',
                'primary_topic' => 'Philosophy',
                'secondary_topic' => 'Mindset',
                'format' => 'Article',
                'difficulty' => 'Advanced',
                'published_on' => '2024-05-05',
                'meta_label' => '10 min read',
                'duration_seconds' => 0,
                'thumbnail_class' => 'philosophy-thumb',
                'label_class' => 'article-label',
                'sort_order' => 60,
            ],
            [
                'type' => 'VIDEO',
                'title' => 'How Your Mind Builds Reality',
                'description' => 'A look at perception, mental models, and how the brain constructs experience.',
                'primary_topic' => 'Mental Models',
                'secondary_topic' => 'Neuroscience',
                'format' => 'In-depth lesson',
                'difficulty' => 'Beginner',
                'published_on' => '2024-05-04',
                'meta_label' => '19 min',
                'duration_seconds' => 1171,
                'thumbnail_class' => 'hero-thumb',
                'label_class' => '',
                'sort_order' => 70,
            ],
            [
                'type' => 'ARTICLE',
                'title' => 'The Missing Piece: Understanding Yourself Better',
                'description' => 'Self-awareness prompts for noticing patterns, triggers, and recurring choices.',
                'primary_topic' => 'Self Awareness',
                'secondary_topic' => 'Behavior',
                'format' => 'Article',
                'difficulty' => 'Intermediate',
                'published_on' => '2024-05-03',
                'meta_label' => '8 min read',
                'duration_seconds' => 0,
                'thumbnail_class' => 'case-thumb',
                'label_class' => 'article-label',
                'sort_order' => 80,
            ],
            [
                'type' => 'RESOURCE',
                'title' => 'Decision Making Framework Cheat Sheet',
                'description' => 'A compact framework for comparing options and reducing decision noise.',
                'primary_topic' => 'Framework',
                'secondary_topic' => 'Decision Making',
                'format' => 'PDF',
                'difficulty' => 'Advanced',
                'published_on' => '2024-05-02',
                'meta_label' => 'PDF',
                'duration_seconds' => 0,
                'thumbnail_class' => 'diagram-thumb',
                'label_class' => 'resource-label',
                'sort_order' => 90,
            ],
        ];

        foreach ($items as $item) {
            LibraryItem::updateOrCreate(
                ['title' => $item['title']],
                $item + ['is_published' => true]
            );
        }
    }
}
