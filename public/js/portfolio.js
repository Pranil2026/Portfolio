const testimonials = window.portfolioData?.testimonials ?? [];
const testimonialContent = document.querySelector('.testimonial-content');
const testimonialThumbs = document.querySelector('.testimonial-thumbs');
let activeTestimonial = 0;

function renderTestimonials() {
    if (!testimonialContent || !testimonialThumbs || testimonials.length === 0) {
        return;
    }

    testimonialContent.innerHTML = `
        <p class="testimonial-stars">${testimonials[activeTestimonial].stars}</p>
        <p class="testimonial-text">${testimonials[activeTestimonial].text}</p>
        <div class="testimonial-author">
            <div class="author-avatar">${testimonials[activeTestimonial].initials}</div>
            <div>
                <p class="author-name">${testimonials[activeTestimonial].name}</p>
                <p class="author-role">${testimonials[activeTestimonial].role}</p>
            </div>
        </div>
    `;

    testimonialThumbs.innerHTML = testimonials
        .map((testimonial, index) => `
            <button class="testimonial-thumb ${index === activeTestimonial ? 'active' : ''}" data-index="${index}">
                ${testimonial.initials}
            </button>
        `)
        .join('');

    testimonialThumbs.querySelectorAll('.testimonial-thumb').forEach((button) => {
        button.addEventListener('click', () => {
            activeTestimonial = Number(button.dataset.index);
            renderTestimonials();
        });
    });
}

function filterProjects(category) {
    const projects = document.querySelectorAll('.project-card');

    projects.forEach((project) => {
        const projectCategory = project.dataset.category;
        project.style.display = category === 'all' || projectCategory === category ? 'block' : 'none';
    });
}

function scrollToSection(name) {
    const section = document.getElementById(name);

    if (!section) {
        return;
    }

    // Account for the sticky header height so the section title isn't hidden
    const header = document.querySelector('.topbar');
    const headerHeight = header ? header.offsetHeight : 0;
    const top = section.getBoundingClientRect().top + window.pageYOffset - headerHeight - 12;
    window.scrollTo({ top, behavior: 'smooth' });
}

function toggleAccent() {
    document.body.classList.toggle('accent-two');
}

function showToast() {
    const toast = document.getElementById('toast');

    if (!toast) {
        return;
    }

    toast.classList.add('active');
    setTimeout(() => toast.classList.remove('active'), 2500);
}

window.addEventListener('DOMContentLoaded', () => {
    renderTestimonials();

    document.querySelectorAll('[data-filter]').forEach((button) => {
        button.addEventListener('click', () => {
            document.querySelectorAll('[data-filter]').forEach((button) => button.classList.remove('active'));
            button.classList.add('active');
            filterProjects(button.dataset.filter);
        });
    });
});
