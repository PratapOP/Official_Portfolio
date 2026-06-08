<?php

$data = getPortfolio();

?>

<footer class="footer">

    <div class="footer-container">

        <!-- Left -->

        <div class="footer-brand">

            <h3>

                <span class="footer-accent">A</span>PS

            </h3>

            <p>

                Building AI Products, Leading Teams,
                and Creating Impact.

            </p>

        </div>

        <!-- Center -->

        <div class="footer-links">

            <h4>Navigation</h4>

            <a href="#home">Home</a>

            <a href="#about">About</a>

            <a href="#projects">Projects</a>

            <a href="#leadership">Leadership</a>

            <a href="#contact">Contact</a>

        </div>

        <!-- Resume -->

        <div class="footer-links">

            <h4>Resume Hub</h4>

            <a href="assets/documents/Resume_AI.pdf" target="_blank">
                AI Resume
            </a>

            <a href="assets/documents/Resume_Product.pdf" target="_blank">
                Product Resume
            </a>

            <a href="assets/documents/Resume_General.pdf" target="_blank">
                General Resume
            </a>

        </div>

        <!-- Social -->

        <div class="footer-links">

            <h4>Connect</h4>

            <a
                href="<?= $data['socials']['github'] ?>"
                target="_blank">

                GitHub

            </a>

            <a
                href="<?= $data['socials']['linkedin'] ?>"
                target="_blank">

                LinkedIn

            </a>

            <a
                href="<?= $data['socials']['leetcode'] ?>"
                target="_blank">

                LeetCode

            </a>

        </div>

    </div>

    <!-- Bottom -->

    <div class="footer-bottom">

        <p>

            © <?= date('Y') ?>

            <?= htmlspecialchars($data['personal']['name']) ?>

            · All Rights Reserved

        </p>

        <p>

            Designed & Developed by APS

        </p>

    </div>

</footer>

</body>
</html>