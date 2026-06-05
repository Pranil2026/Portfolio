document.addEventListener('DOMContentLoaded', () => {
    const testimonials = [
        {
            stars: '★★★★★',
            text: '"Alex delivered an exceptional e-commerce platform that exceeded all expectations. His attention to detail and proactive communication made the project a joy to work on."',
            initials: 'SC',
            name: 'Sarah Chen',
            role: 'CTO, TechCorp Inc.',
        },
        {
            stars: '★★★★★',
            text: '"One of the best developers I\'ve worked with. He not only wrote clean, maintainable code but also contributed ideas that improved our product significantly."',
            initials: 'MR',
            name: 'Marcus Rivera',
            role: 'Founder, StartupXYZ',
        },
        {
            stars: '★★★★★',
            text: '"Alex\'s ability to understand business requirements and translate them into elegant technical solutions is remarkable. Highly recommended for any complex web project."',
            initials: 'EW',
            name: 'Emma Williams',
            role: 'Product Manager, DigitalAgency',
        },
    ];

    let tIdx = 0;
    let tTimer;

    const tCard = document.getElementById('t-card');
    const tStars = document.getElementById('t-stars');
    const tText = document.getElementById('t-text');
    const tInitials = document.getElementById('t-initials');
    const tName = document.getElementById('t-name');
    const tRole = document.getElementById('t-role');
    const dots = document.querySelectorAll('.dot');
    const skillBars = document.querySelectorAll('.skill-fill');

    const updateTestimonial = (index) => {
        const current = testimonials[index];
        if (!current || !tCard) {
            return;
        }
        tCard.style.opacity = '0';
        tCard.style.transform = 'translateY(6px)';

        setTimeout(() => {
            tStars.textContent = current.stars;
            tText.textContent = current.text;
            tInitials.textContent = current.initials;
            tName.textContent = current.name;
            tRole.textContent = current.role;
            tCard.style.opacity = '1';
            tCard.style.transform = 'translateY(0)';
        }, 200);

        dots.forEach((dot, idx) => {
            dot.classList.toggle('active', idx === index);
        });

        clearInterval(tTimer);
        tTimer = setInterval(() => updateTestimonial((tIdx + 1) % testimonials.length), 4000);
    };

    if (tCard) {
        tCard.style.transition = 'opacity 0.2s, transform 0.2s';
    }

    skillBars.forEach((bar) => {
        bar.style.width = '0';
    });

    setTimeout(() => {
        skillBars.forEach((bar) => {
            bar.style.width = bar.dataset.w + '%';
        });
    }, 300);

    window.goTestimonial = (index) => {
        tIdx = index;
        updateTestimonial(index);
    };

    window.filterProjects = (cat, btn) => {
        document.querySelectorAll('.filter-btn').forEach((b) => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.project-card').forEach((card) => {
            const show = cat === 'All' || card.dataset.cat === cat;
            card.style.display = show ? 'block' : 'none';
        });
    };

    window.scrollToSection = (id) => {
        const element = document.getElementById(id);
        if (!element) {
            return;
        }
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    const navIds = ['hero', 'about', 'skills', 'projects', 'experience', 'services', 'testimonials', 'contact'];
    const handleNavActive = () => {
        const scrollPosition = window.scrollY + 120;
        navIds.forEach((id) => {
            const el = document.getElementById(id);
            const link = document.getElementById(`nl-${id}`);
            if (!el || !link) {
                return;
            }
            const top = el.offsetTop;
            const bottom = top + el.offsetHeight;
            link.classList.toggle('active', scrollPosition >= top && scrollPosition < bottom);
        });
    };

    window.toggleAccent = () => {
        const accents = ['#6366f1', '#ec4899', '#14b8a6', '#f59e0b', '#10b981', '#ef4444', '#8b5cf6', '#0ea5e9'];
        const current = getComputedStyle(document.documentElement).getPropertyValue('--accent').trim() || '#6366f1';
        let idx = accents.indexOf(current);
        idx = idx < 0 ? 0 : (idx + 1) % accents.length;
        document.documentElement.style.setProperty('--accent', accents[idx]);
        const hex = accents[idx].replace('#', '');
        const r = parseInt(hex.slice(0, 2), 16);
        const g = parseInt(hex.slice(2, 4), 16);
        const b = parseInt(hex.slice(4, 6), 16);
        document.documentElement.style.setProperty('--accent-rgb', `${r},${g},${b}`);
    };

    window.showToast = () => {
        const toast = document.getElementById('toast');
        if (!toast) {
            return;
        }
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    };

    window.addEventListener('scroll', handleNavActive, { passive: true });
    handleNavActive();
    updateTestimonial(0);
});
