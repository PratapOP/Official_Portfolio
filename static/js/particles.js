/* ══════════════════════════════════════════════════
   PARTICLES.JS — Red ember/smoke particle system
   ══════════════════════════════════════════════════ */
(function () {
    const canvas = document.getElementById('particle-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');

    let width, height, particles;
    const PARTICLE_COUNT = 80;

    function resize() {
        width = canvas.width = canvas.offsetWidth;
        height = canvas.height = canvas.offsetHeight;
    }

    class Particle {
        constructor() { this.reset(true); }

        reset(initial) {
            this.x = Math.random() * width;
            this.y = initial ? Math.random() * height : height + 20;
            this.size = Math.random() * 3 + 1;
            this.speedY = -(Math.random() * 0.6 + 0.15);
            this.speedX = (Math.random() - 0.5) * 0.4;
            this.opacity = Math.random() * 0.5 + 0.1;
            this.fadeSpeed = Math.random() * 0.003 + 0.001;
            // Red tones
            this.r = 180 + Math.floor(Math.random() * 60);
            this.g = 30 + Math.floor(Math.random() * 40);
            this.b = 20 + Math.floor(Math.random() * 30);
        }

        update() {
            this.y += this.speedY;
            this.x += this.speedX;
            this.opacity -= this.fadeSpeed;
            if (this.opacity <= 0 || this.y < -20) this.reset(false);
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${this.r},${this.g},${this.b},${this.opacity})`;
            ctx.fill();

            // Glow
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size * 3, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${this.r},${this.g},${this.b},${this.opacity * 0.15})`;
            ctx.fill();
        }
    }

    function init() {
        resize();
        particles = Array.from({ length: PARTICLE_COUNT }, () => new Particle());
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => { p.update(); p.draw(); });
        requestAnimationFrame(animate);
    }

    window.addEventListener('resize', resize);
    init();
    animate();
})();
