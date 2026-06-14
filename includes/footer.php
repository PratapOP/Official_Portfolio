<?php

$data = getPortfolio();

?>

<footer class="footer">

    <div class="footer-container">

        <!-- Brand Column -->
        <div class="footer-brand">

            <h3>
                <span class="footer-accent">A</span>PS
            </h3>

            <p>
                Building AI Products, Leading Teams,
                and Creating Impact — one commit at a time.
            </p>

            <div class="footer-socials">

                <a
                    href="<?= htmlspecialchars($data['socials']['github'] ?? '#') ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="GitHub">
                    <i class="fab fa-github"></i>
                </a>

                <a
                    href="<?= htmlspecialchars($data['socials']['linkedin'] ?? '#') ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>

                <a
                    href="<?= htmlspecialchars($data['socials']['leetcode'] ?? '#') ?>"
                    target="_blank"
                    rel="noopener noreferrer"
                    aria-label="LeetCode">
                    <i class="fas fa-code"></i>
                </a>

                <?php if (!empty($data['socials']['email'])): ?>
                <a
                    href="mailto:<?= htmlspecialchars($data['socials']['email']) ?>"
                    aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
                <?php endif; ?>

            </div>

        </div>

        <!-- Navigation Links -->
        <div class="footer-links">

            <h4>Navigation</h4>

            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#achievements">Achievements</a>
            <a href="#projects">Projects</a>
            <a href="#leadership">Leadership</a>
            <a href="#github-activity">GitHub</a>
            <a href="#contact">Contact</a>

        </div>

        <!-- Resume Hub Links -->
        <div class="footer-links">

            <h4>Resume Hub</h4>

            <a href="assets/documents/Resume_AI.pdf" target="_blank" rel="noopener noreferrer">
                <i class="fas fa-file-alt" style="margin-right:6px;font-size:.8rem;"></i>
                AI / ML Resume
            </a>

            <a href="assets/documents/Resume_Product.pdf" target="_blank" rel="noopener noreferrer">
                <i class="fas fa-file-alt" style="margin-right:6px;font-size:.8rem;"></i>
                Product Resume
            </a>

            <a href="assets/documents/Resume_General.pdf" target="_blank" rel="noopener noreferrer">
                <i class="fas fa-file-alt" style="margin-right:6px;font-size:.8rem;"></i>
                General Resume
            </a>

        </div>

        <!-- Connect / Quick Info -->
        <div class="footer-links">

            <h4>Connect</h4>

            <a
                href="<?= htmlspecialchars($data['socials']['github'] ?? '#') ?>"
                target="_blank"
                rel="noopener noreferrer">
                GitHub Profile
            </a>

            <a
                href="<?= htmlspecialchars($data['socials']['linkedin'] ?? '#') ?>"
                target="_blank"
                rel="noopener noreferrer">
                LinkedIn Profile
            </a>

            <a
                href="<?= htmlspecialchars($data['socials']['leetcode'] ?? '#') ?>"
                target="_blank"
                rel="noopener noreferrer">
                LeetCode Profile
            </a>

            <a href="#contact">Send a Message</a>

        </div>

    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom">

        <p>
            &copy; <?= date('Y') ?>
            <?= htmlspecialchars($data['personal']['name'] ?? 'APS') ?>.
            All Rights Reserved.
        </p>

        <p>Designed &amp; Developed with <span style="color:var(--accent)">&#9829;</span> by APS</p>

        <button
            class="back-to-top"
            id="back-to-top"
            aria-label="Back to top"
            onclick="window.scrollTo({top:0,behavior:'smooth'})">
            <i class="fas fa-arrow-up"></i>
        </button>

    </div>

</footer>

</body>
</html>