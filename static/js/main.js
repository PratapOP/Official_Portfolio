/* ══════════════════════════════════════════════════
   MAIN.JS — Navigation, typewriter, scroll reveal,
              custom cursor, contact form, preloader
   ══════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {

    /* ─── PRELOADER ─── */
    const preloader = document.getElementById('preloader');
    window.addEventListener('load', () => {
        setTimeout(() => preloader?.classList.add('hidden'), 600);
    });

    /* ─── CUSTOM CURSOR ─── */
    const cursor = document.getElementById('cursor');
    const follower = document.getElementById('cursor-follower');
    if (cursor && follower && window.innerWidth > 768) {
        let mx = 0, my = 0, fx = 0, fy = 0;
        document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
        (function moveCursor() {
            cursor.style.transform = `translate(${mx - 4}px, ${my - 4}px)`;
            fx += (mx - 17.5 - fx) * 0.15;
            fy += (my - 17.5 - fy) * 0.15;
            follower.style.transform = `translate(${fx}px, ${fy}px)`;
            requestAnimationFrame(moveCursor);
        })();

        // Scale up follower on hover over links / buttons
        document.querySelectorAll('a, button, .skill-tag').forEach(el => {
            el.addEventListener('mouseenter', () => {
                follower.style.width = '55px';
                follower.style.height = '55px';
                follower.style.borderColor = 'var(--accent-bright)';
            });
            el.addEventListener('mouseleave', () => {
                follower.style.width = '35px';
                follower.style.height = '35px';
                follower.style.borderColor = 'var(--accent)';
            });
        });
    }

    /* ─── NAVBAR: glass on scroll + active section tracking ─── */
    const navbar = document.getElementById('navbar');
    const navLinks = document.querySelectorAll('.nav__link');
    const sections = document.querySelectorAll('section[id]');

    window.addEventListener('scroll', () => {
        // Glass effect
        navbar?.classList.toggle('scrolled', window.scrollY > 60);

        // Active link
        let current = '';
        sections.forEach(s => {
            if (window.scrollY >= s.offsetTop - 200) current = s.id;
        });
        navLinks.forEach(l => {
            l.classList.toggle('active', l.getAttribute('data-section') === current);
        });
    });

    /* ─── MOBILE NAV TOGGLE ─── */
    const navToggle = document.getElementById('nav-toggle');
    const navMenu = document.getElementById('nav-menu');
    navToggle?.addEventListener('click', () => navMenu?.classList.toggle('open'));
    navLinks.forEach(l => l.addEventListener('click', () => navMenu?.classList.remove('open')));

    /* ─── TYPEWRITER ─── */
    const roles = JSON.parse(document.body.getAttribute('data-roles') || '[]');
    const typeEl = document.getElementById('typewriter');
    if (typeEl) {
        // Fallback roles if data-roles is empty
        const roleList = roles.length ? roles : [
            'Full-Stack Developer',
            'Data Analyst',
            'AI/ML Engineer',
            'Product Thinker'
        ];
        let roleIdx = 0, charIdx = 0, deleting = false;
        function type() {
            const current = roleList[roleIdx];
            if (deleting) {
                typeEl.textContent = current.substring(0, charIdx--);
                if (charIdx < 0) { deleting = false; roleIdx = (roleIdx + 1) % roleList.length; }
            } else {
                typeEl.textContent = current.substring(0, charIdx++);
                if (charIdx > current.length) { deleting = true; setTimeout(type, 1500); return; }
            }
            setTimeout(type, deleting ? 40 : 80);
        }
        setTimeout(type, 800);
    }

    /* ─── SCROLL REVEAL (Intersection Observer) ─── */
    const revealEls = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, idx) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), idx * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12 });
        revealEls.forEach(el => observer.observe(el));
    } else {
        revealEls.forEach(el => el.classList.add('visible'));
    }

    /* ─── COUNTER ANIMATION ─── */
    const counters = document.querySelectorAll('.stat__number[data-target]');
    if (counters.length) {
        const counterObserver = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const el = entry.target;
                    const target = +el.getAttribute('data-target');
                    let count = 0;
                    const speed = Math.max(1, Math.floor(2000 / target));
                    const step = () => {
                        count += Math.ceil(target / 40);
                        if (count >= target) { el.textContent = target; }
                        else { el.textContent = count; requestAnimationFrame(step); }
                    };
                    step();
                    counterObserver.unobserve(el);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(c => counterObserver.observe(c));
    }

    /* ─── CONTACT FORM ─── */
    const form = document.getElementById('contact-form');
    const formStatus = document.getElementById('form-status');
    form?.addEventListener('submit', async e => {
        e.preventDefault();
        const fd = new FormData(form);
        const body = Object.fromEntries(fd.entries());
        formStatus.textContent = 'Sending...';
        try {
            const res = await fetch('/api/contact', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(body),
            });
            if (res.ok) {
                formStatus.textContent = '✓ Message sent! I\'ll get back to you soon.';
                form.reset();
            } else {
                formStatus.textContent = '✗ Something went wrong. Please try again.';
            }
        } catch {
            formStatus.textContent = '✗ Network error. Please try again later.';
        }
    });

    /* ─── SMOOTH SCROLL for anchor links ─── */
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const target = document.querySelector(a.getAttribute('href'));
            target?.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
});
