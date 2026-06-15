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
            'name' => 'Pranil Maharjan',
            'tagline' => 'Full-Stack Developer & UI Enthusiast',
            'desc' => 'I craft beautiful, performant web applications using modern PHP and JavaScript. Passionate about clean code, elegant architecture, and exceptional user experiences.',
        ]);

        $about = SiteSetting::valueFor('about', [
            'intro' => 'I am a passionate full-stack developer with 5+ years of experience building web applications. I specialize in Laravel and modern PHP stacks, turning complex problems into simple, beautiful solutions.',
            'second' => 'When not coding, I enjoy hiking, watching movies and series and also live to play indoor or outdoor games.',
            'details' => [
                ['icon' => '📍', 'text' => 'Kirtipur-3, Kathmandu, Nepal'],
                ['icon' => '✉️', 'text' => 'pranilmaharjan12@gmail.com'],
                ['icon' => '📞', 'text' => '+977 9763373854'],
            ],
        ]);

        $contact = SiteSetting::valueFor('contact', [
            'location' => 'Kirtipur-3, Kathmandu, Nepal',
            'email' => 'pranilmaharjan12@gmail.com',
            'phone' => '+977 9763373854',
        ]);

        $footer = SiteSetting::valueFor('footer', [
            'year' => now()->year,
            'brand' => 'Pranil Maharjan',
            'text' => 'Built with Laravel.',
            'links' => [
                ['label' => 'GitHub', 'url' => 'https://github.com/pranil'],
                ['label' => 'LinkedIn', 'url' => 'https://linkedin.com/in/pranilmaharjan'],
                ['label' => 'Instagram', 'url' => 'https://www.instagram.com/pranilmaharjan12'],
            ],
        ]);

        $education = SiteSetting::valueFor('education', [
            [
                'type' => 'SCHOOL',
                'school' => 'Hill-Town Higher Secondary School',
                'location' => 'kirtipur, Kathmandu',
                'gpa' => '3.50',
                'status' => 'DONE',
            ],
            [
                'type' => '+2',
                'school' => 'DAV',
                'location' => 'Jawalakhel, Lalitpur',
                'gpa' => '3.20',
                'status' => 'DONE',
            ],
            [
                'type' => 'BACHELOR',
                'school' => 'Asian college of higher studies',
                'location' => 'Ekantakuna, Lalitpur',
                'gpa' => '',
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
