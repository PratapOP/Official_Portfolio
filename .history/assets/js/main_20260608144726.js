/* =====================================================
   PORTFOLIO MAIN SCRIPT
===================================================== */

document.addEventListener("DOMContentLoaded", () => {

    initTypewriter();
    initMobileMenu();
    initScrollProgress();
    initNavbarEffects();
    initSmoothScroll();
    initRecruiterViews();
    initRevealAnimations();

});

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

            element.textContent =
                currentRole.substring(0, charIndex--);

        } else {

            element.textContent =
                currentRole.substring(0, charIndex++);

        }

        let speed = deleting ? 40 : 90;

        if (!deleting &&
            charIndex === currentRole.length + 1) {

            speed = 1800;

            deleting = true;
        }

        if (deleting &&
            charIndex === 0) {

            deleting = false;

            roleIndex =
                (roleIndex + 1) % roles.length;
        }

        setTimeout(type, speed);
    }

    type();
}

/* =====================================================
   MOBILE MENU
===================================================== */

function initMobileMenu() {

    const toggle =
        document.getElementById("mobile-toggle");

    const menu =
        document.getElementById("mobile-menu");

    if (!toggle || !menu) return;

    toggle.addEventListener("click", () => {

        menu.classList.toggle("active");

    });

    menu.querySelectorAll("a").forEach(link => {

        link.addEventListener("click", () => {

            menu.classList.remove("active");

        });

    });
}

/* =====================================================
   SCROLL PROGRESS
===================================================== */

function initScrollProgress() {

    const progressBar =
        document.getElementById(
            "scroll-progress-bar"
        );

    if (!progressBar) return;

    window.addEventListener("scroll", () => {

        const totalHeight =
            document.documentElement.scrollHeight -
            window.innerHeight;

        const progress =
            (window.scrollY / totalHeight) * 100;

        progressBar.style.width =
            progress + "%";

    });
}

/* =====================================================
   NAVBAR EFFECT
===================================================== */

function initNavbarEffects() {

    const navbar =
        document.getElementById("navbar");

    if (!navbar) return;

    window.addEventListener("scroll", () => {

        if (window.scrollY > 60) {

            navbar.style.background =
                "rgba(5,5,5,0.95)";

            navbar.style.borderBottom =
                "1px solid rgba(255,255,255,0.08)";

        } else {

            navbar.style.background =
                "rgba(5,5,5,0.75)";

        }

    });
}

/* =====================================================
   SMOOTH SCROLL
===================================================== */

function initSmoothScroll() {

    document
        .querySelectorAll('a[href^="#"]')
        .forEach(anchor => {

            anchor.addEventListener(
                "click",
                function (e) {

                    const target =
                        document.querySelector(
                            this.getAttribute("href")
                        );

                    if (!target) return;

                    e.preventDefault();

                    target.scrollIntoView({

                        behavior: "smooth",
                        block: "start"

                    });

                }
            );
        });
}

/* =====================================================
   RECRUITER VIEWS
===================================================== */

function initRecruiterViews() {

    const buttons =
        document.querySelectorAll(".view-btn");

    const cards =
        document.querySelectorAll(".view-card");

    buttons.forEach(button => {

        button.addEventListener("click", () => {

            buttons.forEach(btn =>
                btn.classList.remove("active")
            );

            button.classList.add("active");

            const selected =
                button.dataset.view;

            updateRecruiterView(selected);

        });

    });

    cards.forEach(card => {

        card.addEventListener("click", () => {

            const selected =
                card.dataset.view;

            buttons.forEach(btn => {

                btn.classList.remove("active");

                if (
                    btn.dataset.view === selected
                ) {
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

    document.body.setAttribute(
        "data-recruiter-view",
        view
    );

    console.log(
        "Recruiter View:",
        view
    );

    /*
    Future Implementation:

    Technical:
        show technical skills
        show GitHub
        show AI projects

    Product:
        show leadership
        show finance
        show product work

    Complete:
        show everything
    */
}

/* =====================================================
   REVEAL ANIMATION
===================================================== */

function initRevealAnimations() {

    const elements =
        document.querySelectorAll(

            ".view-card, .impact-card"

        );

    if (!elements.length) return;

    const observer =
        new IntersectionObserver(

            entries => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {

                        entry.target.classList.add(
                            "revealed"
                        );

                    }

                });

            },

            {
                threshold: 0.15
            }

        );

    elements.forEach(el =>
        observer.observe(el)
    );
}

/* =====================================================
   CONTACT FORM
===================================================== */

const contactForm =
    document.getElementById(
        "contact-form"
    );

if(contactForm){

    contactForm.addEventListener(
        "submit",
        async function(e){

            e.preventDefault();

            const formData =
                new FormData(this);

            const response =
                document.getElementById(
                    "form-response"
                );

            response.textContent =
                "Sending...";

            try{

                const request =
                    await fetch(
                        "api/contact.php",
                        {
                            method:"POST",
                            body:formData
                        }
                    );

                const result =
                    await request.json();

                response.textContent =
                    result.message;

                if(result.success){

                    this.reset();
                }

            }catch(error){

                response.textContent =
                    "Something went wrong.";
            }

        }
    );
}

/* =====================================================
   PROJECT MODAL
===================================================== */

initProjectModal();

function initProjectModal(){

    const modal =
        document.getElementById(
            "project-modal"
        );

    const modalBody =
        document.getElementById(
            "modal-body"
        );

    const closeButton =
        document.getElementById(
            "modal-close"
        );

    if(!modal) return;

    document
        .querySelectorAll(
            ".project-trigger"
        )
        .forEach(card => {

            card.addEventListener(
                "click",
                () => {

                    const title =
                        card.dataset.title;

                    const category =
                        card.dataset.category;

                    const description =
                        card.dataset.description;

                    const github =
                        card.dataset.github;

                    modalBody.innerHTML = `

                        <h2 class="modal-project-title">

                            ${title}

                        </h2>

                        <p class="modal-category">

                            ${category}

                        </p>

                        <p class="modal-description">

                            ${description}

                        </p>

                        <a
                            href="${github}"
                            target="_blank"
                            class="primary-btn">

                            View GitHub

                        </a>

                    `;

                    modal.classList.add(
                        "active"
                    );

                }
            );

        });

    closeButton.addEventListener(
        "click",
        () => {

            modal.classList.remove(
                "active"
            );

        }
    );

    modal.addEventListener(
        "click",
        e => {

            if(
                e.target === modal
            ){

                modal.classList.remove(
                    "active"
                );

            }

        }
    );
}