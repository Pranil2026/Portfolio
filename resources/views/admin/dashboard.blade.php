<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
    <style>
        body {
            background: #f8fafc;
        }
        .admin-header {
            padding: 1.5rem;
            background: #fff;
            border-bottom: 1px solid rgba(15,23,42,0.08);
            margin-bottom: 1rem;
        }
        .admin-header h1 {
            margin: 0;
            font-size: 1.75rem;
            color: #111827;
        }
        .admin-section {
            margin-bottom: 2rem;
            background: #fff;
            border: 1px solid rgba(15,23,42,0.08);
            border-radius: 24px;
            padding: 1.5rem;
        }
        .admin-section h2 {
            margin-top: 0;
            font-size: 1.15rem;
            color: #111827;
        }
        .admin-grid {
            display: grid;
            gap: 1.5rem;
        }
        .admin-form label {
            display: block;
            font-size: 0.95rem;
            color: #374151;
            margin-bottom: 0.35rem;
        }
        .admin-form input,
        .admin-form textarea,
        .admin-form select {
            width: 100%;
            padding: 0.85rem 1rem;
            border-radius: 14px;
            border: 1px solid rgba(15,23,42,0.12);
            margin-bottom: 1rem;
            font-size: 0.95rem;
            color: #111827;
            background: #f8fafc;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .admin-table th,
        .admin-table td {
            padding: 0.75rem 0.9rem;
            border-bottom: 1px solid rgba(15,23,42,0.08);
            font-size: 0.93rem;
            color: #374151;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .admin-table th {
            text-align: left;
            background: #f8fafc;
        }
        .admin-table td:nth-child(3) {
            white-space: normal;
        }
        .admin-table td:nth-child(5) {
            white-space: nowrap;
        }
        .admin-actions {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }
        .admin-actions button {
            border-radius: 999px;
            border: none;
            padding: 0.55rem 0.95rem;
            cursor: pointer;
            font-weight: 600;
        }
        .admin-actions .button-delete {
            background: #ef4444;
            color: #fff;
        }
        .admin-actions .button-update {
            background: #4f46e5;
            color: #fff;
        }
        .admin-note {
            padding: 0.95rem 1rem;
            border-radius: 16px;
            background: #f1f5f9;
            color: #334155;
            margin-bottom: 1rem;
        }
        .admin-success {
            background: #dcfce7;
            color: #14532d;
        }
        .admin-error {
            background: #fee2e2;
            color: #991b1b;
        }
        .message-preview {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 2rem;
            border: 1px solid rgba(15,23,42,0.08);
            border-radius: 24px;
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 18px 50px rgba(15,23,42,0.12);
        }
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        .modal-header h2 {
            margin: 0;
            font-size: 1.35rem;
            color: #111827;
        }
        .close-modal {
            font-size: 1.5rem;
            cursor: pointer;
            color: #6b7280;
            border: none;
            background: none;
        }
        .close-modal:hover {
            color: #111827;
        }
        .modal-field {
            margin-bottom: 1.5rem;
        }
        .modal-field label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            display: block;
        }
        .modal-field p {
            margin: 0;
            color: #111827;
            line-height: 1.6;
            word-wrap: break-word;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <div class="navbar">
            <div class="logo">Portfolio Admin</div>
            <div class="navbar-menu">
                <a href="{{ url('/') }}">View public site</a>
                <form action="{{ route('admin.logout') }}" method="post" style="display:inline;">
                    @csrf
                    <button type="submit" class="button-primary" style="margin-left:12px;">Logout</button>
                </form>
            </div>
        </div>
    </div>

    <main class="port admin-layout">
        <aside class="admin-sidebar">
            <div class="admin-sidebar-inner">
                <div class="admin-sidebar-logo">Portfolio Admin</div>
                <nav>
                    <ul>
                        <li><a href="#hero" class="admin-nav-link">Hero</a></li>
                        <li><a href="#about" class="admin-nav-link">About</a></li>
                        <li><a href="#education" class="admin-nav-link">Education</a></li>
                        <li><a href="#skills" class="admin-nav-link">Skills</a></li>
                        <li><a href="#projects" class="admin-nav-link">Projects</a></li>
                        <li><a href="#services" class="admin-nav-link">Services</a></li>
                        <li><a href="#testimonials" class="admin-nav-link">Testimonials</a></li>
                        <li><a href="#contact" class="admin-nav-link">Contact</a></li>
                        <li><a href="#messages" class="admin-nav-link">Contact Messages</a></li>
                        <li><a href="#footer" class="admin-nav-link">Footer</a></li>
                    </ul>
                </nav>
            </div>
        </aside>
        
        <div class="admin-content">
        <section id="hero" class="admin-header admin-section">
            <p class="admin-note">Manage hero text, about details, contact information, footer links, skills, projects, services, and testimonials from one admin screen.</p>
            <p class="admin-note">You can manage all your portfolio content from this dashboard.</p>
            @if(session('success'))
                <div class="admin-note admin-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="admin-note admin-error">
                    <strong>Fix the following:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </section>

                <table class="admin-table">
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                </td>
                            </tr>

        <section class="admin-section">
            <h2>Hero Section</h2>
            <form class="admin-form" action="{{ route('admin.settings.update', 'hero') }}" method="post">
                @csrf
                <label>Greeting</label>
                <input type="text" name="greeting" value="{{ old('greeting', $hero['greeting']) }}" required />

                <label>Name</label>
                <input type="text" name="name" value="{{ old('name', $hero['name']) }}" required />

                <label>Tagline</label>
                <input type="text" name="tagline" value="{{ old('tagline', $hero['tagline']) }}" required />

                <label>Description</label>
                <textarea name="desc" rows="4" required>{{ old('desc', $hero['desc']) }}</textarea>

                <button type="submit" class="button-primary">Save Hero</button>
            </form>
        </section>

        <section id="about" class="admin-section">
            <h2>About Section</h2>
            <form class="admin-form" action="{{ route('admin.settings.update', 'about') }}" method="post">
                @csrf
                <label>Intro</label>
                <textarea name="intro" rows="3" required>{{ old('intro', $about['intro']) }}</textarea>

                <label>Second paragraph</label>
                <textarea name="second" rows="3" required>{{ old('second', $about['second']) }}</textarea>

                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $about['details'][0]['text'] ?? '') }}" />

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $about['details'][1]['text'] ?? '') }}" />

                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $about['details'][2]['text'] ?? '') }}" />

                <button type="submit" class="button-primary">Save About</button>
            </form>
        </section>

        <section id="education" class="admin-section">
            <h2>Education Section</h2>
            <form class="admin-form" action="{{ route('admin.settings.update', 'education') }}" method="post">
                @csrf
                @foreach(range(0, 2) as $index)
                    <div style="margin-bottom: 1.5rem; padding: 1rem; border: 1px solid rgba(15,23,42,0.08); border-radius: 14px; background: #fbfbff;">
                        <h3 style="margin-top: 0;">Education item {{ $index + 1 }}</h3>
                        <label>Type (SCHOOL / +2 / BACHELOR)</label>
                        <input type="text" name="education[{{ $index }}][type]" value="{{ old('education.' . $index . '.type', $education[$index]['type'] ?? '') }}" />

                        <label>School / Institution Name</label>
                        <input type="text" name="education[{{ $index }}][school]" value="{{ old('education.' . $index . '.school', $education[$index]['school'] ?? '') }}" />

                        <label>Location</label>
                        <input type="text" name="education[{{ $index }}][location]" value="{{ old('education.' . $index . '.location', $education[$index]['location'] ?? '') }}" />

                        <label>GPA</label>
                        <input type="text" name="education[{{ $index }}][gpa]" placeholder="3.70" value="{{ old('education.' . $index . '.gpa', $education[$index]['gpa'] ?? '') }}" />

                        <label>Status (DONE / ONGOING)</label>
                        <input type="text" name="education[{{ $index }}][status]" value="{{ old('education.' . $index . '.status', $education[$index]['status'] ?? '') }}" />
                    </div>
                @endforeach
                <button type="submit" class="button-primary">Save Education</button>
            </form>
        </section>

        <section id="skills" class="admin-section">
                <h2>Skills Section</h2>
                <form class="admin-form" action="{{ route('admin.skills.store') }}" method="post">
                    @csrf
                    <label>Group</label>
                    <input type="text" name="group" placeholder="Backend or Frontend" required />
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Laravel" required />
                    <label>Percent</label>
                    <input type="number" name="percent" min="0" max="100" placeholder="90" required />
                    <button type="submit" class="button-primary">Add Skill</button>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr><th>Group</th><th>Name</th><th>Percent</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($skills as $skill)
                            <tr>
                                <td>{{ $skill->group }}</td>
                                <td>{{ $skill->name }}</td>
                                <td>{{ $skill->percent }}%</td>
                                <td class="admin-actions">
                                    <form action="{{ route('admin.skills.destroy', $skill) }}" method="post" style="display:inline-block;">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="projects">
                <h2>Projects</h2>
                <form class="admin-form" action="{{ route('admin.projects.store') }}" method="post">
                    @csrf
                    <label>Category</label>
                    <input type="text" name="category" required />
                    <label>Thumb</label>
                    <input type="text" name="thumb" placeholder="🛒" />
                    <label>Badge</label>
                    <input type="text" name="badge" placeholder="Web" />
                    <label>Title</label>
                    <input type="text" name="title" required />
                    <label>Description</label>
                    <textarea name="description" rows="3" required></textarea>
                    <label>Tags (comma separated)</label>
                    <input type="text" name="tags" placeholder="Laravel, Vue.js" />
                    <label>Live URL</label>
                    <input type="url" name="live_url" placeholder="https://" />
                    <label>GitHub URL</label>
                    <input type="url" name="github_url" placeholder="https://" />
                    <button type="submit" class="button-primary">Add Project</button>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr><th>Title</th><th>Category</th><th>Badge</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->category }}</td>
                                <td>{{ $project->badge }}</td>
                                <td class="admin-actions">
                                    <form action="{{ route('admin.projects.destroy', $project) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="admin-section admin-grid">
            <div id="services">
                <h2>Services</h2>
                <form class="admin-form" action="{{ route('admin.services.store') }}" method="post">
                    @csrf
                    <label>Icon</label>
                    <input type="text" name="icon" placeholder="💻" />
                    <label>Title</label>
                    <input type="text" name="title" required />
                    <label>Description</label>
                    <textarea name="description" rows="3" required></textarea>
                    <button type="submit" class="button-primary">Add Service</button>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr><th>Title</th><th>Icon</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->icon }}</td>
                                <td class="admin-actions">
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="testimonials">
                <h2>Testimonials</h2>
                <form class="admin-form" action="{{ route('admin.testimonials.store') }}" method="post">
                    @csrf
                    <label>Stars</label>
                    <input type="text" name="stars" placeholder="★★★★★" />
                    <label>Text</label>
                    <textarea name="text" rows="3" required></textarea>
                    <label>Initials</label>
                    <input type="text" name="initials" />
                    <label>Name</label>
                    <input type="text" name="name" required />
                    <label>Role</label>
                    <input type="text" name="role" />
                    <button type="submit" class="button-primary">Add Testimonial</button>
                </form>

                <table class="admin-table">
                    <thead>
                        <tr><th>Name</th><th>Role</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr>
                                <td>{{ $testimonial->name }}</td>
                                <td>{{ $testimonial->role }}</td>
                                <td class="admin-actions">
                                    <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </section>

        <section id="contact" class="admin-section">
            <h2>Contact Section</h2>
            <form class="admin-form" action="{{ route('admin.settings.update', 'contact') }}" method="post">
                @csrf
                <label>Location</label>
                <input type="text" name="location" value="{{ old('location', $contact['location']) }}" />

                <label>Email</label>
                <input type="email" name="email" value="{{ old('email', $contact['email']) }}" />

                <label>Phone</label>
                <input type="text" name="phone" value="{{ old('phone', $contact['phone']) }}" />

                <button type="submit" class="button-primary">Save Contact</button>
            </form>
        </section>

         <section id="messages" class="admin-section">
            <h2>Contact Messages</h2>
            @if($messages->isEmpty())
                <p class="admin-note">No messages yet.</p>
            @else
                <table class="admin-table">
                    <thead>
                        <tr><th>Name</th><th>Email</th><th>Message</th><th>Received</th><th>Actions</th></tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $msg)
                            <tr>
                                <td>{{ $msg->name }}</td>
                                <td>{{ $msg->email }}</td>
                                <td><div class="message-preview">{{ $msg->message }}</div></td>
                                <td>{{ $msg->created_at->diffForHumans() }}</td>
                                <td class="admin-actions">
                                    <button type="button" class="button-update" onclick="openMessageModal({{ json_encode(['name' => $msg->name, 'email' => $msg->email, 'message' => $msg->message, 'id' => $msg->id]) }})">View</button>
                                    <form action="{{ route('admin.messages.destroy', $msg) }}" method="post" onsubmit="return confirm('Delete this message?');">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="button-delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>

        <div id="messageModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Full Message</h2>
                    <button class="close-modal" onclick="closeMessageModal()">&times;</button>
                </div>
                <div class="modal-field">
                    <label>From:</label>
                    <p id="modalName"></p>
                </div>
                <div class="modal-field">
                    <label>Email:</label>
                    <p id="modalEmail"></p>
                </div>
                <div class="modal-field">
                    <label>Message:</label>
                    <p id="modalMessage"></p>
                </div>
            </div>
        </div>

        <script>
            function openMessageModal(data) {
                document.getElementById('modalName').textContent = data.name;
                document.getElementById('modalEmail').textContent = data.email;
                document.getElementById('modalMessage').textContent = data.message;
                document.getElementById('messageModal').style.display = 'block';
            }

            function closeMessageModal() {
                document.getElementById('messageModal').style.display = 'none';
            }

            window.onclick = function(event) {
                const modal = document.getElementById('messageModal');
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            }
        </script>

        <section id="footer" class="admin-section">
            <h2>Footer Settings</h2>
            <form class="admin-form" action="{{ route('admin.settings.update', 'footer') }}" method="post">
                @csrf
                <label>Brand</label>
                <input type="text" name="brand" value="{{ old('brand', $footer['brand']) }}" required />

                <label>Year</label>
                <input type="number" name="year" value="{{ old('year', $footer['year']) }}" required />

                <label>Footer Text</label>
                <textarea name="text" rows="2" required>{{ old('text', $footer['text']) }}</textarea>

                <label>Link 1 label</label>
                <input type="text" name="link1_label" value="{{ old('link1_label', $footer['links'][0]['label'] ?? '') }}" />
                <label>Link 1 URL</label>
                <input type="url" name="link1_url" value="{{ old('link1_url', $footer['links'][0]['url'] ?? '') }}" />

                <label>Link 2 label</label>
                <input type="text" name="link2_label" value="{{ old('link2_label', $footer['links'][1]['label'] ?? '') }}" />
                <label>Link 2 URL</label>
                <input type="url" name="link2_url" value="{{ old('link2_url', $footer['links'][1]['url'] ?? '') }}" />

                <label>Link 3 label</label>
                <input type="text" name="link3_label" value="{{ old('link3_label', $footer['links'][2]['label'] ?? '') }}" />
                <label>Link 3 URL</label>
                <input type="url" name="link3_url" value="{{ old('link3_url', $footer['links'][2]['url'] ?? '') }}" />

                <button type="submit" class="button-primary">Save Footer</button>
            </form>
        </section>
        </div><!-- .admin-content -->
    </main>

    <style>
        /* Admin layout - fixed left sidebar */
        .admin-layout { display: flex; gap: 24px; }
        .admin-sidebar { width: 220px; flex: 0 0 220px; position: fixed; top: 84px; left: 24px; height: calc(100vh - 96px); overflow: auto; }
        .admin-sidebar-inner { position: relative; background: transparent; padding-right: 6px; }
        .admin-sidebar-logo { font-weight:700; color:var(--accent); margin-bottom: 12px; padding-left: 6px; }
        .admin-sidebar nav ul { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px; padding-left: 6px; }
        .admin-sidebar nav a { display: block; padding: 8px 12px; border-radius: 10px; color: #475569; text-decoration: none; }
        .admin-sidebar nav a:hover { background: rgba(99,102,241,0.06); color: var(--accent); }
        .admin-sidebar nav a.active { background: var(--accent); color: #fff; }
        .admin-content { margin-left: 260px; padding-bottom: 80px; }
        @media (max-width: 900px) {
            .admin-layout { flex-direction: column; }
            .admin-sidebar { width: 100%; position: relative; left: auto; top: auto; height: auto; }
            .admin-content { margin-left: 0; }
            .admin-sidebar-inner { position: relative; }
        }
    </style>

    <script>
        // Smooth scroll for admin sidebar links and active highlighting
        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.admin-nav-link');
            const header = document.querySelector('.topbar');
            const headerHeight = header ? header.offsetHeight : 0;

            links.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.getAttribute('href').substring(1);
                    const el = document.getElementById(id);
                    if (!el) return;
                    const top = el.getBoundingClientRect().top + window.pageYOffset - headerHeight - 12;
                    window.scrollTo({ top, behavior: 'smooth' });
                });
            });

            // Highlight active section on scroll
            const sections = Array.from(document.querySelectorAll('.admin-section'));
            window.addEventListener('scroll', function () {
                const y = window.pageYOffset + headerHeight + 20;
                let currentId = null;
                sections.forEach(s => {
                    if (s.offsetTop <= y) currentId = s.id || currentId;
                });
                links.forEach(l => l.classList.toggle('active', l.getAttribute('href') === ('#' + currentId)));
            });
        });
    </script>
</body>
</html>
