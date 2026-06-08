<?php

$pageTitle = "Abhiuday Pratap Singh | AI Engineer | Product Strategist";

require_once 'includes/header.php';

$data = getPortfolio();

?>

<?php include 'includes/navbar.php'; ?>

<!-- =====================================================
 HERO SECTION
===================================================== -->

<section
    class="hero-section"
    id="home">

    <!-- Background Effects -->

    <div class="hero-grid"></div>

    <canvas
        id="particle-canvas">
    </canvas>

    <!-- Floating Glow -->

    <div class="hero-glow hero-glow-1"></div>
    <div class="hero-glow hero-glow-2"></div>

    <div class="hero-container">

        <!-- Left Content -->

        <div class="hero-content">

            <span class="hero-badge">

                AVAILABLE FOR INTERNSHIPS & OPPORTUNITIES

            </span>

            <h1 class="hero-title">

                Hi, I'm

                <span class="hero-name">
                    <?= htmlspecialchars($data['personal']['name']) ?>
                </span>

            </h1>

            <h2 class="hero-role">

                <span id="typewriter"></span>

                <span class="cursor-blink">|</span>

            </h2>

            <p class="hero-description">

                <?= htmlspecialchars($data['about']['summary']) ?>

            </p>

            <!-- CTA Buttons -->

            <div class="hero-actions">

                <a
                    href="#projects"
                    class="primary-btn">

                    Explore Projects

                </a>

                <a
                    href="#resume-hub"
                    class="secondary-btn">

                    Download Resume

                </a>

            </div>

            <!-- Social Links -->

            <div class="hero-socials">

                <a
                    href="<?= $data['socials']['github'] ?>"
                    target="_blank">

                    <i class="fab fa-github"></i>

                </a>

                <a
                    href="<?= $data['socials']['linkedin'] ?>"
                    target="_blank">

                    <i class="fab fa-linkedin"></i>

                </a>

                <a
                    href="<?= $data['socials']['leetcode'] ?>"
                    target="_blank">

                    <i class="fas fa-code"></i>

                </a>

            </div>

        </div>

        <!-- Right Side -->

        <div class="hero-image-container">

            <div class="hero-image-card">

                <img
                    src="<?= $data['personal']['profile_image'] ?>"
                    alt="<?= htmlspecialchars($data['personal']['name']) ?>"
                    class="hero-image">

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
 RECRUITER VIEW SECTION
===================================================== -->

<section class="recruiter-view-section">

    <div class="section-container">

        <h2 class="section-heading">

            Choose Your View

        </h2>

        <p class="section-subheading">

            Different recruiters seek different strengths.
            Choose the perspective most relevant to you.

        </p>

        <div class="view-grid">

            <?php foreach ($data['recruiter_views'] as $key => $view): ?>

                <div
                    class="view-card"
                    data-view="<?= $key ?>">

                    <h3>

                        <?= htmlspecialchars($view['title']) ?>

                    </h3>

                    <p>

                        <?= htmlspecialchars($view['description']) ?>

                    </p>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- =====================================================
 IMPACT METRICS
===================================================== -->

<section
    class="impact-preview"
    id="impact">

    <div class="section-container">

        <div class="impact-grid">

            <?php foreach ($data['hero_stats'] as $stat): ?>

                <div class="impact-card">

                    <h3>

                        <?= htmlspecialchars($stat['value']) ?>

                    </h3>

                    <p>

                        <?= htmlspecialchars($stat['label']) ?>

                    </p>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- =====================================================
 ABOUT
===================================================== -->

<section id="about">

    <div class="section-container">

        <h2 class="section-heading">

            About Me

        </h2>

        <p class="section-subheading">

            A unique combination of Artificial Intelligence,
            Product Strategy, Leadership, Finance, and
            Full Stack Engineering.

        </p>

        <div class="about-grid">

            <div class="about-content">

                <p>

                    <?= htmlspecialchars(
                        $data['about']['summary']
                    ) ?>

                </p>

            </div>

            <div class="education-card">

                <h3>Education</h3>

                <?php foreach($data['education'] as $edu): ?>

                    <div class="education-item">

                        <h4>

                            <?= htmlspecialchars(
                                $edu['institution']
                            ) ?>

                        </h4>

                        <p>

                            <?= htmlspecialchars(
                                $edu['degree']
                            ) ?>

                        </p>

                        <span>

                            <?= htmlspecialchars(
                                $edu['duration']
                            ) ?>

                        </span>

                    </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</section>

<!-- =====================================================
 TECHNICAL SKILLS
===================================================== -->

<section id="technical-skills">

    <div class="section-container">

        <h2 class="section-heading">

            Technical Expertise

        </h2>

        <div class="skills-grid">

            <?php foreach($data['technical_skills'] as $category => $skills): ?>

                <div
                    class="skill-card recruiter-technical">

                    <h3>

                        <?= ucwords(
                            str_replace(
                                "_",
                                " ",
                                $category
                            )
                        ) ?>

                    </h3>

                    <div class="skill-tags">

                        <?php foreach($skills as $skill): ?>

                            <span>

                                <?= htmlspecialchars(
                                    $skill
                                ) ?>

                            </span>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</section>

<!-- =====================================================
 JS DATA FOR TYPEWRITER
===================================================== -->

<script>

const roles = [

    "AI Engineer",
    "Machine Learning Engineer",
    "Full Stack Developer",
    "Product Strategist",
    "Finance Leader"

];

</script>

<!-- Main JS -->

<script src="assets/js/main.js"></script>
<script src="assets/js/particles.js"></script>

<?php include 'includes/footer.php'; ?>