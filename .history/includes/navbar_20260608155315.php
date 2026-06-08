<?php

require_once __DIR__ . '/config.php';

$data = getPortfolio();

?>

<nav class="navbar" id="navbar">

    <div class="navbar-container">

        <!-- Logo -->

        <a href="index.php" class="logo">
            <span class="logo-accent">A</span>PS
        </a>

        <!-- Desktop Navigation -->

        <ul class="nav-links">

            <li>
                <a href="#home">Home</a>
            </li>

            <li>
                <a href="#about">About</a>
            </li>

            <li>
    <a href="#achievements">
        Achievements
    </a>
</li>

            <li>
                <a href="#impact">Impact</a>
            </li>

            <li>
                <a href="#projects">Projects</a>
            </li>

            <li>
                <a href="#leadership">Leadership</a>
            </li>

            <li>
                <a href="#contact">Contact</a>
            </li>

        </ul>

        <!-- Recruiter View Switcher -->

        <div class="recruiter-switcher">

            <button
                class="view-btn active"
                data-view="complete">

                Complete

            </button>

            <button
                class="view-btn"
                data-view="technical">

                Technical

            </button>

            <button
                class="view-btn"
                data-view="product">

                Product

            </button>

        </div>

        <!-- Actions -->

        <div class="nav-actions">

            <a
                href="#resume-hub"
                class="resume-btn">

                <i class="fa-solid fa-file-arrow-down"></i>
                Resume Hub

            </a>

            <a
                href="#contact"
                class="contact-btn">

                Let's Talk

            </a>

        </div>

        <!-- Mobile Menu Toggle -->

        <button
            class="mobile-toggle"
            id="mobile-toggle">

            <span></span>
            <span></span>
            <span></span>

        </button>

    </div>

</nav>

<!-- Mobile Menu -->

<div class="mobile-menu" id="mobile-menu">

    <a href="#home">Home</a>

    <a href="#about">About</a>

    <a href="#impact">Impact</a>

    <a href="#projects">Projects</a>

    <a href="#leadership">Leadership</a>

    <a href="#contact">Contact</a>

    <a href="#resume-hub">Resume Hub</a>

</div>

<!-- Scroll Progress -->

<div class="scroll-progress">
    <div
        class="scroll-progress-bar"
        id="scroll-progress-bar">
    </div>
</div>