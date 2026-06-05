<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $hero['name'] }} – Portfolio</title>
    <link rel="stylesheet" href="{{ asset('css/portfolio.css') }}" />
</head>
<body>
    <header class="topbar">
        <nav class="navbar">
            <div class="logo">{{ $hero['name'] }}</div>
            <div class="navbar-menu">
                @foreach ($navLinks as $link)
                    <a href="#{{ $link['id'] }}" onclick="scrollToSection('{{ $link['id'] }}'); return false;">{{ $link['label'] }}</a>
                @endforeach
            </div>
            <button class="preloader-button" onclick="toggleAccent()">Switch Accent</button>
        </nav>
    </header>

    <section id="hero" class="hero">
        <div class="hero-text">
            <p>{{ $hero['greeting'] }}</p>
            <h1>{{ $hero['name'] }}</h1>
            <h2>{{ $hero['tagline'] }}</h2>
            <p class="hero-description">{{ $hero['desc'] }}</p>
            <div class="buttons">
                <a href="#projects" onclick="scrollToSection('projects'); return false;">View Work</a>
                <a href="#contact" class="button-primary" onclick="scrollToSection('contact'); return false;">Hire Me</a>
            </div>
        </div>
        <div class="hero-stats">
            <div>
                <span>04+</span>
                <p>Years of experience</p>
            </div>
            <div>
                <span>25+</span>
                <p>Projects completed</p>
            </div>
            <div>
                <span>10+</span>
                <p>Happy clients</p>
            </div>
        </div>
    </section>

    <section id="about" class="section about-section">
        <div class="section-title">
            <h2>About Me</h2>
            <p>Bringing design, performance, and maintainability together.</p>
        </div>
        <div class="about-grid">
            <div class="about-text">
                <p>{{ $about['intro'] }}</p>
                <p>{{ $about['second'] }}</p>
            </div>
            <div class="about-cards">
                @foreach ($about['details'] as $detail)
                    <div class="detail-card">
                        <p class="detail-icon">{{ $detail['icon'] }}</p>
                        <p>{{ $detail['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="education" class="section education-section">
        <div class="section-title">
            <h2>Education</h2>
            <p>My academic journey from school to higher education.</p>
        </div>
        <div class="education-grid">
            @foreach ($education as $item)
                <article class="education-card">
                    @if($item['type'] ?? '')
                        <div class="education-type-badge">{{ $item['type'] }}</div>
                    @endif
                    <h3>{{ $item['school'] ?? '' }}</h3>
                    @if($item['location'] ?? '')
                        <p class="education-location">{{ $item['location'] }}</p>
                    @endif
                    <div class="education-footer">
                        @if($item['gpa'] ?? '')
                            <span class="education-gpa">{{ $item['gpa'] }} GPA</span>
                        @endif
                        @if($item['status'] ?? '')
                            <span class="education-status education-status-{{ strtolower($item['status']) }}">{{ $item['status'] }}</span>
                        @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section id="skills" class="section skills-section">
        <div class="section-title">
            <h2>Skills</h2>
            <p>Technical strengths that help deliver production-ready applications.</p>
        </div>
        <div class="skills-grid">
            @foreach ($skills as $skillGroup)
                <div class="skill-card">
                    <h3>{{ $skillGroup['group'] }}</h3>
                    <div class="skill-items">
                        @foreach ($skillGroup['items'] as $item)
                            <div class="skill-item">
                                <div class="skill-header">
                                    <span>{{ $item['name'] }}</span>
                                    <span>{{ $item['pct'] }}%</span>
                                </div>
                                <div class="skill-bar">
                                    <div class="skill-fill" style="width: {{ $item['pct'] }}%;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section id="projects" class="section projects-section">
        <div class="section-title">
            <h2>Projects</h2>
            <p>A selection of recent web projects built with modern Laravel stacks.</p>
        </div>
        <div class="project-filters">
            <button data-filter="all" class="active">All</button>
            @foreach ($projectCategories as $category)
                <button data-filter="{{ $category }}">{{ $category }}</button>
            @endforeach
        </div>
        <div class="projects-grid">
            @foreach ($projects as $project)
                <article class="project-card" data-category="{{ $project['category'] }}">
                    <span class="project-badge">{{ $project['badge'] }}</span>
                    <div class="project-thumb">{{ $project['thumb'] }}</div>
                    <h3>{{ $project['title'] }}</h3>
                    <p>{{ $project['desc'] }}</p>
                    <div class="project-tags">
                        @foreach ($project['tags'] as $tag)
                            <span>#{{ $tag }}</span>
                        @endforeach
                    </div>
                    <div class="project-actions">
                        <a href="{{ $project['live_url'] }}">View</a>
                        <a href="{{ $project['github_url'] }}">GitHub</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    <section id="services" class="section services-section">
        <div class="section-title">
            <h2>Services</h2>
            <p>What I bring to your team and product.</p>
        </div>
        <div class="services-grid">
            @foreach ($services as $service)
                <article class="service-card">
                    <div class="service-icon">{{ $service['icon'] }}</div>
                    <h3>{{ $service['title'] }}</h3>
                    <p>{{ $service['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>

    <section id="testimonials" class="section testimonials-section">
        <div class="section-title">
            <h2>Testimonials</h2>
            <p>Feedback from clients and collaborators.</p>
        </div>
        <div class="testimonial-display">
            <div class="testimonial-content"></div>
            <div class="testimonial-thumbs"></div>
        </div>
    </section>

    <section id="contact" class="section contact-section">
        <div class="section-title">
            <h2>Contact</h2>
            <p>Let&apos;s build something great together.</p>
        </div>
        <div class="contact-grid">
            <div class="contact-card">
                <h3>Get in touch</h3>
                <p>If you have a project idea or want to collaborate, send a message and I&apos;ll respond quickly.</p>
                <div class="contact-details">
                    <span>{{ $contact['location'] }}</span>
                    <span>{{ $contact['email'] }}</span>
                    <span>{{ $contact['phone'] }}</span>
                </div>
            </div>
            <form class="contact-form" onsubmit="showToast(); return false;">
                <label>
                    Name
                    <input type="text" name="name" placeholder="Your name" required />
                </label>
                <label>
                    Email
                    <input type="email" name="email" placeholder="Your email" required />
                </label>
                <label>
                    Message
                    <textarea name="message" placeholder="Tell me about your project" required></textarea>
                </label>
                <button type="submit">Send message</button>
            </form>
        </div>
    </section>

    <footer class="footer">
        <div>
            <p>&copy; {{ $footer['year'] }} {{ $footer['brand'] }}. {{ $footer['text'] }}</p>
        </div>
        <div class="footer-links">
            @foreach ($footer['links'] as $link)
                <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
            @endforeach
        </div>
    </footer>

    <div class="toast" id="toast">Message sent successfully!</div>

    <script>
        window.portfolioData = {
            testimonials: @json($testimonials)
        };
    </script>
    <script src="{{ asset('js/portfolio.js') }}" defer></script>
</body>
</html>
