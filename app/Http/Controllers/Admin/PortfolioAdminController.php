<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\SiteSetting;
use App\Models\Testimonial;
use App\Models\Message;
use Illuminate\Http\Request;

class PortfolioAdminController extends Controller
{
    public function index()
    {
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

        return view('admin.dashboard', [
            'hero' => $hero,
            'about' => $about,
            'education' => $education,
            'contact' => $contact,
            'footer' => $footer,
            'skills' => Skill::orderBy('position', 'asc')->get(),
            'projects' => Project::orderBy('position', 'asc')->get(),
            'services' => Service::orderBy('position', 'asc')->get(),
            'testimonials' => Testimonial::orderBy('position', 'asc')->get(),
            'messages' => Message::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function destroyMessage(Message $message)
    {
        Message::destroy($message->id);
        return redirect()->back()->with('success', 'Message deleted.');
    }

    public function updateSetting(Request $request, string $section)
    {
        $data = [];

        if ($section === 'hero') {
            $data = $request->validate([
                'greeting' => 'required|string|max:60',
                'name' => 'required|string|max:80',
                'tagline' => 'required|string|max:120',
                'desc' => 'required|string|max:500',
            ]);
        } elseif ($section === 'about') {
            $data = $request->validate([
                'intro' => 'required|string|max:500',
                'second' => 'required|string|max:500',
                'location' => 'nullable|string|max:120',
                'email' => 'nullable|email|max:120',
                'phone' => 'nullable|string|max:60',
            ]);

            $data['details'] = [
                ['icon' => '📍', 'text' => $data['location'] ?? ''],
                ['icon' => '✉️', 'text' => $data['email'] ?? ''],
                ['icon' => '📞', 'text' => $data['phone'] ?? ''],
            ];
            unset($data['location'], $data['email'], $data['phone']);
        } elseif ($section === 'education') {
            $validated = $request->validate([
                'education' => 'required|array|max:5',
                'education.*.type' => 'nullable|string|max:40',
                'education.*.school' => 'nullable|string|max:120',
                'education.*.location' => 'nullable|string|max:120',
                'education.*.gpa' => 'nullable|string|max:20',
                'education.*.status' => 'nullable|string|max:40',
            ]);

            $data = array_values(array_filter($validated['education'], function ($entry) {
                return filled($entry['school']) || filled($entry['type']) || filled($entry['location']);
            }));
        } elseif ($section === 'contact') {
            $data = $request->validate([
                'location' => 'nullable|string|max:120',
                'email' => 'nullable|email|max:120',
                'phone' => 'nullable|string|max:60',
            ]);
        } elseif ($section === 'footer') {
            $validated = $request->validate([
                'year' => 'required|numeric|min:2024|max:2100',
                'brand' => 'required|string|max:60',
                'text' => 'required|string|max:160',
                'link1_label' => 'nullable|string|max:40',
                'link1_url' => 'nullable|url|max:200',
                'link2_label' => 'nullable|string|max:40',
                'link2_url' => 'nullable|url|max:200',
                'link3_label' => 'nullable|string|max:40',
                'link3_url' => 'nullable|url|max:200',
            ]);

            $data = [
                'year' => (int) $validated['year'],
                'brand' => $validated['brand'],
                'text' => $validated['text'],
                'links' => array_filter([
                    ['label' => $validated['link1_label'] ?? '', 'url' => $validated['link1_url'] ?? ''],
                    ['label' => $validated['link2_label'] ?? '', 'url' => $validated['link2_url'] ?? ''],
                    ['label' => $validated['link3_label'] ?? '', 'url' => $validated['link3_url'] ?? ''],
                ], fn ($link) => filled($link['label']) && filled($link['url'])),
            ];
        } else {
            abort(404);
        }

        SiteSetting::setValue($section, $data);

        return redirect()->back()->with('success', ucfirst($section).' settings updated.');
    }

    public function storeSkill(Request $request)
    {
        $data = $request->validate([
            'group' => 'required|string|max:60',
            'name' => 'required|string|max:80',
            'percent' => 'required|integer|min:0|max:100',
        ]);

        $data['position'] = Skill::max('position') + 1;
        Skill::create($data);

        return redirect()->back()->with('success', 'Skill added.');
    }

    public function updateSkill(Request $request, Skill $skill)
    {
        $skill->update($request->validate([
            'group' => 'required|string|max:60',
            'name' => 'required|string|max:80',
            'percent' => 'required|integer|min:0|max:100',
        ]));

        return redirect()->back()->with('success', 'Skill updated.');
    }

    public function destroySkill(Skill $skill)
    {
        Skill::destroy($skill->id);

        return redirect()->back()->with('success', 'Skill removed.');
    }

    public function storeProject(Request $request)
    {
        $data = $request->validate([
            'category' => 'required|string|max:80',
            'thumb' => 'nullable|string|max:20',
            'badge' => 'nullable|string|max:40',
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:800',
            'tags' => 'nullable|string|max:200',
            'live_url' => 'nullable|url|max:200',
            'github_url' => 'nullable|url|max:200',
        ]);

        $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
        $data['position'] = Project::max('position') + 1;
        Project::create($data);

        return redirect()->back()->with('success', 'Project added.');
    }

    public function updateProject(Request $request, Project $project)
    {
        $data = $request->validate([
            'category' => 'required|string|max:80',
            'thumb' => 'nullable|string|max:20',
            'badge' => 'nullable|string|max:40',
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:800',
            'tags' => 'nullable|string|max:200',
            'live_url' => 'nullable|url|max:200',
            'github_url' => 'nullable|url|max:200',
        ]);

        $data['tags'] = array_filter(array_map('trim', explode(',', $data['tags'] ?? '')));
        $project->update($data);

        return redirect()->back()->with('success', 'Project updated.');
    }

    public function destroyProject(Project $project)
    {
        Project::destroy($project->id);

        return redirect()->back()->with('success', 'Project removed.');
    }

    public function storeService(Request $request)
    {
        $data = $request->validate([
            'icon' => 'nullable|string|max:20',
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:400',
        ]);

        $data['position'] = Service::max('position') + 1;
        Service::create($data);

        return redirect()->back()->with('success', 'Service added.');
    }

    public function updateService(Request $request, Service $service)
    {
        $service->update($request->validate([
            'icon' => 'nullable|string|max:20',
            'title' => 'required|string|max:120',
            'description' => 'required|string|max:400',
        ]));

        return redirect()->back()->with('success', 'Service updated.');
    }

    public function destroyService(Service $service)
    {
        Service::destroy($service->id);

        return redirect()->back()->with('success', 'Service removed.');
    }

    public function storeTestimonial(Request $request)
    {
        $data = $request->validate([
            'stars' => 'nullable|string|max:10',
            'text' => 'required|string|max:1000',
            'initials' => 'nullable|string|max:10',
            'name' => 'required|string|max:120',
            'role' => 'nullable|string|max:120',
        ]);

        $data['stars'] = $data['stars'] ?: '★★★★★';
        $data['position'] = Testimonial::max('position') + 1;
        Testimonial::create($data);

        return redirect()->back()->with('success', 'Testimonial added.');
    }

    public function updateTestimonial(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($request->validate([
            'stars' => 'nullable|string|max:10',
            'text' => 'required|string|max:1000',
            'initials' => 'nullable|string|max:10',
            'name' => 'required|string|max:120',
            'role' => 'nullable|string|max:120',
        ]));

        return redirect()->back()->with('success', 'Testimonial updated.');
    }

    public function destroyTestimonial(Testimonial $testimonial)
    {
        Testimonial::destroy($testimonial->id);

        return redirect()->back()->with('success', 'Testimonial removed.');
    }
}
