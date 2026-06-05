<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        SiteSetting::setValue('hero', [
            'greeting' => "Hi, I'm",
            'name' => 'Pranil Maharjan',
            'tagline' => 'Full-Stack Developer & UI Enthusiast',
            'desc' => 'I craft beautiful, performant web applications using modern PHP and JavaScript. Passionate about clean code, elegant architecture, and exceptional user experiences.',
        ]);

        SiteSetting::setValue('about', [
            'intro' => 'I am a passionate full-stack developer with 4+ years of experience building web applications. I specialize in Laravel and modern PHP stacks, turning complex problems into simple, beautiful solutions.',
            'second' => 'When not coding, I enjoy hiking, watching movies and series and also live to play indoor or outdoor games.',
            'details' => [
                ['icon' => '📍', 'text' => 'Kirtipur-3, Kathmandu, Nepal'],
                ['icon' => '✉️', 'text' => 'pranilmaharjan12@gmail.com'],
                ['icon' => '📞', 'text' => '+977 9763373854'],
            ],
        ]);

        SiteSetting::setValue('contact', [
            'location' => 'Kirtipur-3, Kathmandu, Nepal',
            'email' => 'pranilmaharjan12@gmail.com',
            'phone' => '+977 9763373854',
        ]);

        SiteSetting::setValue('footer', [
            'year' => now()->year,
            'brand' => 'Pranil Maharjan',
            'text' => 'Built with Laravel.',
            'links' => [
                ['label' => 'GitHub', 'url' => 'https://github.com/pranil'],
                ['label' => 'LinkedIn', 'url' => 'https://linkedin.com/in/pranilmaharjan'],
                ['label' => 'Instagram', 'url' => 'https://www.instagram.com/pranilmaharjan12'],
            ],
        ]);

        Skill::truncate();
        Service::truncate();
        Project::truncate();
        Testimonial::truncate();

        Skill::create(['group' => 'Backend', 'name' => 'Laravel', 'percent' => 95, 'position' => 1]);
        Skill::create(['group' => 'Backend', 'name' => 'PHP', 'percent' => 90, 'position' => 2]);
        Skill::create(['group' => 'Frontend', 'name' => 'Vue.js', 'percent' => 88, 'position' => 3]);
        Skill::create(['group' => 'Frontend', 'name' => 'Tailwind CSS', 'percent' => 92, 'position' => 4]);

        Service::create(['icon' => '💻', 'title' => 'Web Development', 'description' => 'Full-stack applications built with Laravel, Vue, and modern frontend tooling.', 'position' => 1]);
        Service::create(['icon' => '⚡', 'title' => 'Performance Audits', 'description' => 'Optimization and speed improvements for fast, responsive applications.', 'position' => 2]);
        Service::create(['icon' => '📊', 'title' => 'API Design', 'description' => 'RESTful and GraphQL APIs with clean documentation and stable versioning.', 'position' => 3]);

        Project::create(['category' => 'Web', 'thumb' => '🛒', 'badge' => 'Web', 'title' => 'E-Commerce Platform', 'description' => 'Full-featured online store with cart, checkout, and admin panel.', 'tags' => ['Laravel', 'Vue.js', 'Stripe'], 'live_url' => '#', 'github_url' => '#', 'position' => 1]);
        Project::create(['category' => 'Web', 'thumb' => '📋', 'badge' => 'Web', 'title' => 'Futsal Booking System', 'description' => 'Online booking system for futsal courts with real-time availability and separate admin panel for managing users, futsal courts.', 'tags' => ['PHP', 'CSS', 'JS'], 'live_url' => '#', 'github_url' => '   https://github.com/PRANIL96/project-I', 'position' => 2]);
       // Project::create(['category' => 'Frontend', 'thumb' => '🌤️', 'badge' => 'Frontend', 'title' => 'Weather Dashboard', 'description' => 'Real-time weather application with charts and forecasts.', 'tags' => ['Vue.js', 'API', 'Charts'], 'live_url' => '#', 'github_url' => '#', 'position' => 3]);

        Testimonial::create(['stars' => '★★★★★', 'text' => '"Alex delivered an exceptional e-commerce platform that exceeded all expectations."', 'initials' => 'SC', 'name' => 'Sarah Chen', 'role' => 'CTO, TechCorp Inc.', 'position' => 1]);
        Testimonial::create(['stars' => '★★★★★', 'text' => '"One of the best developers I\'ve worked with. He wrote clean, maintainable code and improved our product significantly."', 'initials' => 'MR', 'name' => 'Marcus Rivera', 'role' => 'Founder, StartupXYZ', 'position' => 2]);
    }
}
