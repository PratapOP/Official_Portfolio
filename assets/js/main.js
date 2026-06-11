/* =====================================================
   PORTFOLIO MAIN SCRIPT - VERSION 2.0
===================================================== */

document.addEventListener("DOMContentLoaded", () => {
    initLoader();
    initThemeToggle();
    initProjectModal();
    initTypewriter();
    initMobileMenu();
    initScrollProgress();
    initNavbarEffects();
    initSmoothScroll();
    initRecruiterViews();
    initRevealAnimations();
    initGalleryLightbox();
    initTestimonialsSlider();
    initGithubActivity();
    logLocalAnalytics('pageview');
});

/* =====================================================
   LOADING SCREEN
===================================================== */
function initLoader() {
    const loader = document.getElementById("loader");
    if (!loader) return;

    window.addEventListener("load", () => {
        loader.classList.add("loaded");
        setTimeout(() => {
            loader.style.display = "none";
        }, 600);
    });
}

/* =====================================================
   LIGHT/DARK THEME TOGGLE
===================================================== */
function initThemeToggle() {
    const toggleBtn = document.getElementById("theme-toggle");
    if (!toggleBtn) return;

    const icon = toggleBtn.querySelector("i");
    
    // Sync UI icon with the current theme choice (active blocker in header.php does class addition)
    const isLight = document.documentElement.classList.contains("light-theme");
    if (isLight) {
        icon.className = "fa-solid fa-sun";
    } else {
        icon.className = "fa-solid fa-moon";
    }

    toggleBtn.addEventListener("click", () => {
        const currentlyLight = document.documentElement.classList.toggle("light-theme");
        if (currentlyLight) {
            localStorage.setItem("theme", "light");
            icon.className = "fa-solid fa-sun";
        } else {
            localStorage.setItem("theme", "dark");
            icon.className = "fa-solid fa-moon";
        }
        logLocalAnalytics('theme_change', currentlyLight ? 'light' : 'dark');
    });
}

/* =====================================================
   TYPEWRITER
===================================================== */
function initTypewriter() {
    const element = document.getElementById("typewriter");
    if (!element) return;

    const roles = [
        "AI Engineer",
        "Machine Learning Engineer",
        "Full Stack Developer",
        "Product Strategist",
        "Finance Leader"
    ];

    let roleIndex = 0;
    let charIndex = 0;
    let deleting = false;

    function type() {
        const currentRole = roles[roleIndex];
        if (deleting) {
            element.textContent = currentRole.substring(0, charIndex--);
        } else {
            element.textContent = currentRole.substring(0, charIndex++);
        }

        let speed = deleting ? 40 : 90;

        if (!deleting && charIndex === currentRole.length + 1) {
            speed = 1800;
            deleting = true;
        }

        if (deleting && charIndex === 0) {
            deleting = false;
            roleIndex = (roleIndex + 1) % roles.length;
        }

        setTimeout(type, speed);
    }

    type();
}

/* =====================================================
   MOBILE MENU
===================================================== */
function initMobileMenu() {
    const toggle = document.getElementById("mobile-toggle");
    const menu = document.getElementById("mobile-menu");
    if (!toggle || !menu) return;

    toggle.addEventListener("click", () => {
        menu.classList.toggle("active");
        toggle.classList.toggle("active");
    });

    menu.querySelectorAll("a").forEach(link => {
        link.addEventListener("click", () => {
            menu.classList.remove("active");
            toggle.classList.remove("active");
        });
    });
}

/* =====================================================
   SCROLL PROGRESS
==================================================== */
function initScrollProgress() {
    const progressBar = document.getElementById("scroll-progress-bar");
    if (!progressBar) return;

    window.addEventListener("scroll", () => {
        const totalHeight = document.documentElement.scrollHeight - window.innerHeight;
        const progress = totalHeight > 0 ? (window.scrollY / totalHeight) * 100 : 0;
        progressBar.style.width = progress + "%";
    });
}

/* =====================================================
   NAVBAR EFFECT
===================================================== */
function initNavbarEffects() {
    const navbar = document.getElementById("navbar");
    if (!navbar) return;

    window.addEventListener("scroll", () => {
        if (window.scrollY > 60) {
            navbar.classList.add("scrolled");
        } else {
            navbar.classList.remove("scrolled");
        }
    });
}

/* =====================================================
   SMOOTH SCROLL
===================================================== */
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener("click", function (e) {
            const target = document.querySelector(this.getAttribute("href"));
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({
                behavior: "smooth",
                block: "start"
            });
        });
    });
}

/* =====================================================
   RECRUITER VIEWS SWITCHER
===================================================== */
function initRecruiterViews() {
    const buttons = document.querySelectorAll(".view-btn");
    const cards = document.querySelectorAll(".view-card");

    buttons.forEach(button => {
        button.addEventListener("click", () => {
            buttons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");
            
            const selected = button.dataset.view;
            updateRecruiterView(selected);
        });
    });

    cards.forEach(card => {
        card.addEventListener("click", () => {
            const selected = card.dataset.view;
            buttons.forEach(btn => {
                btn.classList.remove("active");
                if (btn.dataset.view === selected) {
                    btn.classList.add("active");
                }
            });
            updateRecruiterView(selected);
        });
    });
}

/* =====================================================
   RECRUITER FILTER
===================================================== */
function updateRecruiterView(view) {
    document.body.setAttribute("data-recruiter-view", view);
    logLocalAnalytics('recruiter_filter', view);

    // Dynamic alert/badge adjustments can go here if needed
    console.log("Recruiter View toggled to:", view);
}

/* =====================================================
   REVEAL ANIMATION
===================================================== */
function initRevealAnimations() {
    const elements = document.querySelectorAll(".view-card, .impact-card, .project-card, .achievement-card, .timeline-item");
    if (!elements.length) return;

    const observer = new IntersectionObserver(
        entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("revealed");
                }
            });
        },
        { threshold: 0.1 }
    );

    elements.forEach(el => observer.observe(el));
}

/* =====================================================
   CONTACT FORM
===================================================== */
const contactForm = document.getElementById("contact-form");
if (contactForm) {
    contactForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const response = document.getElementById("form-response");
        const submitBtn = this.querySelector('button[type="submit"]');
        const origBtnText = submitBtn.innerHTML;

        response.className = "";
        response.textContent = "Sending...";
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';

        try {
            const request = await fetch("api/contact.php", {
                method: "POST",
                body: formData
            });

            const result = await request.json();
            response.textContent = result.message;

            if (result.success) {
                response.className = "success-message";
                this.reset();
                logLocalAnalytics('contact_success');
            } else {
                response.className = "error-message";
                logLocalAnalytics('contact_fail', result.message);
            }
        } catch (error) {
            response.textContent = "Something went wrong. Please try emailing directly.";
            response.className = "error-message";
            logLocalAnalytics('contact_error', error.message);
        } finally {
            submitBtn.disabled = false;
            submitBtn.innerHTML = origBtnText;
        }
    });
}

/* =====================================================
   PROJECT MODAL
===================================================== */
function initProjectModal() {
    const modal = document.getElementById("project-modal");
    const modalBody = document.getElementById("modal-body");
    const closeButton = document.getElementById("modal-close");
    if (!modal) return;

    document.querySelectorAll(".project-trigger").forEach(card => {
        card.addEventListener("click", (e) => {
            // Avoid triggering modal if child button or link is clicked
            if (e.target.closest('a') || e.target.closest('button')) {
                return;
            }

            const title = card.dataset.title;
            const category = card.dataset.category;
            const description = card.dataset.description;
            const github = card.dataset.github;

            modalBody.innerHTML = `
                <h2 class="modal-project-title">${title}</h2>
                <p class="modal-category">${category}</p>
                <p class="modal-description">${description}</p>
                <a href="${github}" target="_blank" class="primary-btn">
                    <i class="fab fa-github"></i> View GitHub Repository
                </a>
            `;

            modal.classList.add("active");
            document.body.style.overflow = "hidden"; // Prevent background scrolling
            logLocalAnalytics('project_modal_open', title);
        });
    });

    if (closeButton) {
        closeButton.addEventListener("click", () => {
            modal.classList.remove("active");
            document.body.style.overflow = "";
        });
    }

    modal.addEventListener("click", e => {
        if (e.target === modal) {
            modal.classList.remove("active");
            document.body.style.overflow = "";
        }
    });
}

/* =====================================================
   GALLERY LIGHTBOX
===================================================== */
function initGalleryLightbox() {
    const cards = document.querySelectorAll(".gallery-card img, .screenshot-card img");
    const lightbox = document.getElementById("gallery-lightbox");
    const image = document.getElementById("lightbox-image");
    const close = document.getElementById("lightbox-close");
    if (!lightbox) return;

    cards.forEach(card => {
        card.addEventListener("click", () => {
            image.src = card.src;
            lightbox.classList.add("active");
            document.body.style.overflow = "hidden";
            logLocalAnalytics('gallery_lightbox_open', card.alt || 'image');
        });
    });

    if (close) {
        close.addEventListener("click", () => {
            lightbox.classList.remove("active");
            document.body.style.overflow = "";
        });
    }

    lightbox.addEventListener("click", e => {
        if (e.target === lightbox) {
            lightbox.classList.remove("active");
            document.body.style.overflow = "";
        }
    });
}

/* =====================================================
   TESTIMONIALS SLIDER
===================================================== */
function initTestimonialsSlider() {
    const slider = document.getElementById("testimonials-slider");
    if (!slider) return;

    const slides = slider.querySelectorAll(".testimonial-slide");
    const prevBtn = document.getElementById("slider-prev");
    const nextBtn = document.getElementById("slider-next");
    const dotsContainer = document.getElementById("slider-dots");

    if (slides.length <= 1) return;

    let currentIndex = 0;
    let autoPlayInterval;

    // Create dots
    slides.forEach((_, index) => {
        const dot = document.createElement("div");
        dot.classList.add("slider-dot");
        if (index === 0) dot.classList.add("active");
        dot.addEventListener("click", () => goToSlide(index));
        dotsContainer.appendChild(dot);
    });

    const dots = dotsContainer.querySelectorAll(".slider-dot");

    function goToSlide(index) {
        slides[currentIndex].classList.remove("active");
        dots[currentIndex].classList.remove("active");
        
        currentIndex = (index + slides.length) % slides.length;
        
        slides[currentIndex].classList.add("active");
        dots[currentIndex].classList.add("active");
        resetAutoPlay();
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    if (prevBtn) prevBtn.addEventListener("click", prevSlide);
    if (nextBtn) nextBtn.addEventListener("click", nextSlide);

    function startAutoPlay() {
        autoPlayInterval = setInterval(nextSlide, 6000);
    }

    function resetAutoPlay() {
        clearInterval(autoPlayInterval);
        startAutoPlay();
    }

    startAutoPlay();
}

/* =====================================================
   GITHUB API INTEGRATION
===================================================== */
async function initGithubActivity() {
    const grid = document.getElementById("github-repos-grid");
    if (!grid) return;

    try {
        const response = await fetch("https://api.github.com/users/abhiuday17/repos?sort=pushed&per_page=12");
        if (!response.ok) throw new Error("GitHub load failed");

        const repos = await response.json();
        
        // Filter out fork repositories and take first 6
        const filteredRepos = repos.filter(repo => !repo.fork).slice(0, 6);
        
        if (filteredRepos.length === 0) {
            grid.innerHTML = '<p class="repo-error">No public repositories found.</p>';
            return;
        }

        grid.innerHTML = ""; // Clear loader
        
        filteredRepos.forEach(repo => {
            const card = document.createElement("a");
            card.href = repo.html_url;
            card.target = "_blank";
            card.className = "github-repo-card";
            
            // Format programming language color
            const lang = repo.language || "Markdown";
            
            card.innerHTML = `
                <div class="repo-header">
                    <i class="fa-regular fa-folder-open folder-icon"></i>
                    <i class="fa-solid fa-arrow-up-right-from-square link-icon"></i>
                </div>
                <h4 class="repo-name">${repo.name}</h4>
                <p class="repo-desc">${repo.description || "No description provided."}</p>
                <div class="repo-meta">
                    <span class="repo-lang">
                        <span class="lang-color" data-lang="${lang}"></span>
                        ${lang}
                    </span>
                    <span class="repo-stars"><i class="fa-regular fa-star"></i> ${repo.stargazers_count}</span>
                    <span class="repo-forks"><i class="fa-solid fa-code-fork"></i> ${repo.forks_count}</span>
                </div>
            `;
            grid.appendChild(card);
        });

    } catch (err) {
        console.error(err);
        grid.innerHTML = `
            <div class="repo-error">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <p>Failed to load repositories dynamically. You can view them directly on <a href="https://github.com/abhiuday17" target="_blank">GitHub</a>.</p>
            </div>
        `;
    }
}

/* =====================================================
   LOCAL ANALYTICS LOGGER
===================================================== */
function logLocalAnalytics(event, detail = '') {
    const payload = {
        event: event,
        page: window.location.pathname + window.location.search,
        referrer: document.referrer || '',
        screen: `${window.innerWidth}x${window.innerHeight}`,
        detail: detail
    };

    fetch('api/analytics.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
    }).catch(err => console.log('Analytics logger offline:', err));
}