<?php

namespace Database\Seeders;

use App\Models\AboutApproachItem;
use App\Models\AboutJourneyItem;
use App\Models\AboutMetric;
use App\Models\AboutMissionItem;
use App\Models\AboutPage;
use App\Models\AboutSocialLink;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutPage = AboutPage::firstOrCreate([], [
            'eyebrow' => 'About Life Decode',
            'title_line_one' => 'Decode life.',
            'title_line_two' => 'Live amplified.',
            'hero_description' => 'Life Decode is a space to understand the psychology behind your thoughts, decisions, and behavior so you can break free from autopilot and design a life with clarity, purpose, and impact.',
            'hero_image_path' => '/images/about-creator.png',
            'mission_title' => 'Our Mission',
            'mission_description' => 'To decode the hidden patterns of the mind and behavior, share practical wisdom, and empower you to make better decisions and live a more meaningful life.',
            'creator_title' => 'The Creator',
            'creator_intro' => "Hi, I'm the creator behind Life Decode.",
            'creator_body_one' => "I've always been fascinated by why humans think, feel, and act the way they do. That curiosity led me deep into the world of psychology, cognitive science, and philosophy.",
            'creator_body_two' => 'Life Decode is the result of that journey, turning complex ideas into simple lessons that you can use in real life.',
            'creator_signature' => 'Life Decode',
            'creator_role' => 'Creator & Educator',
            'creator_image_path' => '/images/about-desk.png',
            'credentials_title' => 'Credentials & Approach',
            'credentials_description' => "I'm not here to just motivate you. I'm here to help you understand why things happen so you can change them.",
            'social_title' => 'Find Life Decode Everywhere',
            'journey_title' => 'Our Journey So Far',
            'journey_description' => 'From a simple idea to a global community. Thank you for being a part of this journey.',
            'journey_button_text' => 'Join the Community',
            'journey_button_url' => '/community',
            'quote_text' => 'The more you understand, the more freedom you gain.',
            'quote_author' => 'Life Decode',
        ]);

        $metrics = [
            ['icon_text' => 'Y', 'value' => '500K+', 'label' => 'YouTube Family', 'sort_order' => 10],
            ['icon_text' => 'V', 'value' => '250+', 'label' => 'Videos Published', 'sort_order' => 20],
            ['icon_text' => 'G', 'value' => 'Global', 'label' => 'Impacting lives worldwide', 'sort_order' => 30],
            ['icon_text' => 'S', 'value' => 'Since 2021', 'label' => 'Sharing wisdom that lasts', 'sort_order' => 40],
        ];

        foreach ($metrics as $metric) {
            AboutMetric::updateOrCreate(
                ['about_page_id' => $aboutPage->id, 'value' => $metric['value']],
                $metric + ['is_published' => true]
            );
        }

        $missionItems = [
            ['icon_text' => 'B', 'title' => 'Clarity Over Noise', 'description' => 'We simplify complex ideas so you can think clearly.', 'sort_order' => 10],
            ['icon_text' => 'S', 'title' => 'Science-Backed', 'description' => 'Every insight is rooted in psychology and research.', 'sort_order' => 20],
            ['icon_text' => 'A', 'title' => 'Practical & Actionable', 'description' => 'Knowledge is useful only when you apply it.', 'is_gold' => true, 'sort_order' => 30],
            ['icon_text' => 'G', 'title' => 'Growth Together', 'description' => 'We grow as a community, not just as individuals.', 'is_gold' => true, 'sort_order' => 40],
        ];

        foreach ($missionItems as $item) {
            AboutMissionItem::updateOrCreate(
                ['about_page_id' => $aboutPage->id, 'title' => $item['title']],
                $item + ['is_gold' => false, 'is_published' => true]
            );
        }

        $approachItems = [
            ['type' => 'check', 'title' => 'Background in Psychology & Behavioral Science', 'sort_order' => 10],
            ['type' => 'check', 'title' => 'Years of research, reading & real-life application', 'sort_order' => 20],
            ['type' => 'check', 'title' => 'Passionate about teaching & lifelong learning', 'sort_order' => 30],
            ['type' => 'check', 'title' => 'Committed to authenticity & transparency', 'sort_order' => 40],
            ['type' => 'process', 'icon_text' => 'U', 'title' => 'Understand', 'description' => 'We decode the why behind human behavior, emotions, and decisions.', 'sort_order' => 50],
            ['type' => 'process', 'icon_text' => 'A', 'title' => 'Apply', 'description' => 'Turn insights into practical strategies you can use every day.', 'sort_order' => 60],
            ['type' => 'process', 'icon_text' => 'T', 'title' => 'Transform', 'description' => "Create real, lasting change and build a life you're proud of.", 'sort_order' => 70],
        ];

        foreach ($approachItems as $item) {
            AboutApproachItem::updateOrCreate(
                ['about_page_id' => $aboutPage->id, 'type' => $item['type'], 'title' => $item['title']],
                $item + ['is_published' => true]
            );
        }

        $socialLinks = [
            ['icon_text' => 'Y', 'platform' => 'YouTube', 'handle' => '@LifeDecode', 'url' => '#', 'is_gold' => true, 'sort_order' => 10],
            ['icon_text' => 'F', 'platform' => 'Facebook', 'handle' => '@LifeDecode', 'url' => '#', 'sort_order' => 20],
            ['icon_text' => 'I', 'platform' => 'Instagram', 'handle' => '@life.decode', 'url' => '#', 'is_gold' => true, 'sort_order' => 30],
            ['icon_text' => 'X', 'platform' => 'X (Twitter)', 'handle' => '@LifeDecode_', 'url' => '#', 'sort_order' => 40],
            ['icon_text' => 'in', 'platform' => 'LinkedIn', 'handle' => '@Life Decode', 'url' => '#', 'sort_order' => 50],
            ['icon_text' => 'M', 'platform' => 'Newsletter', 'handle' => 'Join the list', 'url' => '#', 'is_gold' => true, 'sort_order' => 60],
        ];

        foreach ($socialLinks as $link) {
            AboutSocialLink::updateOrCreate(
                ['about_page_id' => $aboutPage->id, 'platform' => $link['platform']],
                $link + ['is_gold' => false, 'is_published' => true]
            );
        }

        $journeyItems = [
            ['icon_text' => 'L', 'period' => '2021', 'description' => 'It all started with a passion to decode life.', 'is_gold' => true, 'sort_order' => 10],
            ['icon_text' => 'V', 'period' => '2022', 'headline' => '100+', 'description' => 'Videos and a growing community.', 'is_gold' => true, 'sort_order' => 20],
            ['icon_text' => 'C', 'period' => '2023', 'headline' => '250K+', 'description' => 'Amazing people joined the family.', 'sort_order' => 30],
            ['icon_text' => 'G', 'period' => '2024', 'headline' => 'Global', 'description' => 'Impact and expanding reach.', 'sort_order' => 40],
            ['icon_text' => 'S', 'period' => 'Today', 'headline' => 'The Best Is Yet To Come', 'description' => 'Together, we will keep growing.', 'is_gold' => true, 'sort_order' => 50],
        ];

        foreach ($journeyItems as $item) {
            AboutJourneyItem::updateOrCreate(
                ['about_page_id' => $aboutPage->id, 'period' => $item['period']],
                $item + ['is_gold' => false, 'is_published' => true]
            );
        }
    }
}
