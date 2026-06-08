/* =====================================================
   FUTURISTIC PARTICLE SYSTEM
===================================================== */

(() => {

    const canvas =
        document.getElementById(
            "particle-canvas"
        );

    if (!canvas) return;

    const ctx =
        canvas.getContext("2d");

    let width;
    let height;

    let particles = [];

    const mouse = {

        x: null,
        y: null,
        radius: 120

    };

    const PARTICLE_COUNT = 80;

    /* ============================================
       RESIZE
    ============================================ */

    function resizeCanvas() {

        width =
            canvas.width =
            window.innerWidth;

        height =
            canvas.height =
            window.innerHeight;
    }

    resizeCanvas();

    window.addEventListener(
        "resize",
        resizeCanvas
    );

    /* ============================================
       MOUSE TRACKING
    ============================================ */

    window.addEventListener(
        "mousemove",
        e => {

            mouse.x = e.clientX;
            mouse.y = e.clientY;

        }
    );

    window.addEventListener(
        "mouseleave",
        () => {

            mouse.x = null;
            mouse.y = null;

        }
    );

    /* ============================================
       PARTICLE CLASS
    ============================================ */

    class Particle {

        constructor() {

            this.reset();

            this.y =
                Math.random() * height;
        }

        reset() {

            this.x =
                Math.random() * width;

            this.y =
                height + Math.random() * 100;

            this.size =
                Math.random() * 3 + 1;

            this.speedY =
                -(Math.random() * 0.8 + 0.2);

            this.speedX =
                (Math.random() - 0.5) * 0.4;

            this.opacity =
                Math.random() * 0.7 + 0.1;
        }

        update() {

            this.y += this.speedY;
            this.x += this.speedX;

            if (this.y < -20) {

                this.reset();
            }

            if (
                mouse.x &&
                mouse.y
            ) {

                const dx =
                    this.x - mouse.x;

                const dy =
                    this.y - mouse.y;

                const distance =
                    Math.sqrt(
                        dx * dx +
                        dy * dy
                    );

                if (
                    distance <
                    mouse.radius
                ) {

                    this.x +=
                        dx * 0.015;

                    this.y +=
                        dy * 0.015;
                }
            }
        }

        draw() {

            ctx.beginPath();

            ctx.arc(

                this.x,
                this.y,
                this.size,
                0,
                Math.PI * 2

            );

            ctx.fillStyle =

                `rgba(
                    231,
                    76,
                    60,
                    ${this.opacity}
                )`;

            ctx.fill();

            /* Glow */

            ctx.beginPath();

            ctx.arc(

                this.x,
                this.y,
                this.size * 4,
                0,
                Math.PI * 2

            );

            ctx.fillStyle =

                `rgba(
                    231,
                    76,
                    60,
                    ${this.opacity * 0.08}
                )`;

            ctx.fill();
        }
    }

    /* ============================================
       INIT
    ============================================ */

    function createParticles() {

        particles = [];

        for (
            let i = 0;
            i < PARTICLE_COUNT;
            i++
        ) {

            particles.push(
                new Particle()
            );
        }
    }

    createParticles();

    /* ============================================
       CONNECTING LINES
    ============================================ */

    function connectParticles() {

        for (
            let a = 0;
            a < particles.length;
            a++
        ) {

            for (
                let b = a + 1;
                b < particles.length;
                b++
            ) {

                const dx =
                    particles[a].x -
                    particles[b].x;

                const dy =
                    particles[a].y -
                    particles[b].y;

                const distance =
                    Math.sqrt(
                        dx * dx +
                        dy * dy
                    );

                if (
                    distance < 120
                ) {

                    const opacity =

                        1 -
                        distance / 120;

                    ctx.beginPath();

                    ctx.strokeStyle =

                        `rgba(
                            231,
                            76,
                            60,
                            ${opacity * 0.08}
                        )`;

                    ctx.lineWidth = 1;

                    ctx.moveTo(

                        particles[a].x,
                        particles[a].y

                    );

                    ctx.lineTo(

                        particles[b].x,
                        particles[b].y

                    );

                    ctx.stroke();
                }
            }
        }
    }

    /* ============================================
       ANIMATION LOOP
    ============================================ */

    function animate() {

        ctx.clearRect(
            0,
            0,
            width,
            height
        );

        particles.forEach(
            particle => {

                particle.update();

                particle.draw();

            }
        );

        connectParticles();

        requestAnimationFrame(
            animate
        );
    }

    animate();

})();