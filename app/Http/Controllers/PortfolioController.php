<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Routing\Controller;

class PortfolioController extends Controller
{
    public function index()
    {
        $navLinks = [
            ['id' => 'hero', 'label' => 'Home'],
            ['id' => 'about', 'label' => 'About'],
            ['id' => 'education', 'label' => 'Education'],
            ['id' => 'skills', 'label' => 'Skills'],
            ['id' => 'projects', 'label' => 'Projects'],
            ['id' => 'services', 'label' => 'Services'],
            ['id' => 'testimonials', 'label' => 'Testimonials'],
            ['id' => 'contact', 'label' => 'Contact'],
        ];

        $hero = SiteSetting::valueFor('hero', [
            'greeting' => "Hi, I'm",
            'name' => 'Alex Johnson',
            'tagline' => 'Full-Stack Developer & UI Enthusiast',
            'desc' => 'I craft beautiful, performant web applications using modern PHP and JavaScript. Passionate about clean code, elegant architecture, and exceptional user experiences.',
        ]);

        $about = SiteSetting::valueFor('about', [
            'intro' => 'I am a passionate full-stack developer with 5+ years of experience building web applications. I specialize in Laravel and modern PHP stacks, turning complex problems into simple, beautiful solutions.',
            'second' => 'When not coding, I enjoy hiking, reading sci-fi novels, and experimenting with new recipes.',
            'details' => [
                ['icon' => '📍', 'text' => 'San Francisco, CA'],
                ['icon' => '✉️', 'text' => 'alex@example.com'],
                ['icon' => '📞', 'text' => '+1 (555) 123-4567'],
            ],
        ]);

        $contact = SiteSetting::valueFor('contact', [
            'location' => 'San Francisco, CA',
            'email' => 'alex@example.com',
            'phone' => '+1 (555) 123-4567',
        ]);

        $footer = SiteSetting::valueFor('footer', [
            'year' => now()->year,
            'brand' => 'AlexDev',
            'text' => 'Built with Laravel.',
            'links' => [
                ['label' => 'GitHub', 'url' => '#'],
                ['label' => 'LinkedIn', 'url' => '#'],
                ['label' => 'Twitter', 'url' => '#'],
            ],
        ]);

        $education = SiteSetting::valueFor('education', [
            [
                'type' => 'SCHOOL',
                'school' => 'Springfield High School',
                'location' => 'Namkha-4, Humla',
                'gpa' => '3.70',
                'status' => 'DONE',
            ],
            [
                'type' => '+2',
                'school' => 'Central Higher Secondary',
                'location' => 'Basundhara, Kathmandu',
                'gpa' => '3.42',
                'status' => 'DONE',
            ],
            [
                'type' => 'BACHELOR',
                'school' => 'State University',
                'location' => 'Ekantakuna, Lalitpur',
                'gpa' => '3.65',
                'status' => 'ONGOING',
            ],
        ]);

        $education = array_values(array_filter($education, function ($item) {
            return is_array($item) && (
                filled($item['school'] ?? '') ||
                filled($item['degree'] ?? '') ||
                filled($item['date'] ?? '') ||
                filled($item['description'] ?? '')
            );
        }));

        $skills = Skill::orderBy('position', 'asc')
            ->get()
            ->groupBy('group')
            ->map(function ($groupItems, $groupName) {
                return [
                    'group' => $groupName,
                    'items' => $groupItems->map(function ($item) {
                        return [
                            'name' => $item->name,
                            'pct' => $item->percent,
                        ];
                    })->toArray(),
                ];
            })->values();

        $projects = Project::orderBy('position', 'asc')->get();
        $projectCategories = $projects->pluck('category')->unique()->values();
        $services = Service::orderBy('position', 'asc')->get();
        $testimonials = Testimonial::orderBy('position', 'asc')->get();

        return view('welcome', compact(
            'navLinks',
            'hero',
            'about',
            'education',
            'contact',
            'skills',
            'projects',
            'projectCategories',
            'services',
            'testimonials',
            'footer'
        ));
    }
}
