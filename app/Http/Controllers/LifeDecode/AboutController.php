<?php

namespace App\Http\Controllers\LifeDecode;

use App\Http\Controllers\Controller;
use App\Models\AboutPage;
use Illuminate\View\View;

class AboutController extends Controller
{
    public function index(): View
    {
        $aboutPage = AboutPage::firstOrCreate([], [
            'hero_description' => 'Life Decode is a space to understand the psychology behind your thoughts, decisions, and behavior so you can break free from autopilot and design a life with clarity, purpose, and impact.',
            'mission_description' => 'To decode the hidden patterns of the mind and behavior, share practical wisdom, and empower you to make better decisions and live a more meaningful life.',
            'creator_intro' => "Hi, I'm the creator behind Life Decode.",
            'creator_body_one' => "I've always been fascinated by why humans think, feel, and act the way they do. That curiosity led me deep into the world of psychology, cognitive science, and philosophy.",
            'creator_body_two' => 'Life Decode is the result of that journey, turning complex ideas into simple lessons that you can use in real life.',
            'credentials_description' => "I'm not here to just motivate you. I'm here to help you understand why things happen so you can change them.",
            'journey_description' => 'From a simple idea to a global community. Thank you for being a part of this journey.',
        ]);

        $aboutPage->load([
            'metrics' => fn ($query) => $query->published(),
            'missionItems' => fn ($query) => $query->published(),
            'approachItems' => fn ($query) => $query->published(),
            'socialLinks' => fn ($query) => $query->published(),
            'journeyItems' => fn ($query) => $query->published(),
        ]);

        return view('life-decode.about', compact('aboutPage'));
    }
}
