<?php

require_once 'includes/config.php';

$data = getPortfolio();

$projectId = $_GET['id'] ?? '';

$selectedProject = null;

foreach (
    $data['featured_projects']
    as $project
) {

    if (
        $project['id'] === $projectId
    ) {

        $selectedProject = $project;

        break;
    }
}

if (!$selectedProject) {

    http_response_code(404);

    die("Project not found.");
}

$pageTitle =
    $selectedProject['title'] .
    " | Abhiuday Pratap Singh";

include 'includes/header.php';

?>

<?php include 'includes/navbar.php'; ?>

<section class="project-page">

    <div class="section-container">

        <div class="project-header">

            <span class="project-page-category">

                <?= htmlspecialchars(
                    $selectedProject['category']
                ) ?>

            </span>

            <h1>

                <?= htmlspecialchars(
                    $selectedProject['title']
                ) ?>

            </h1>

            <p>

                <?= htmlspecialchars(
                    $selectedProject['description']
                ) ?>

            </p>

        </div>

        <div class="project-banner">

            <img
                src="<?= $selectedProject['image'] ?>"
                alt="<?= htmlspecialchars(
                    $selectedProject['title']
                ) ?>">
        </div>

        <!-- Problem -->

        <div class="project-block">

            <h2>Problem</h2>

            <p>

                <?= htmlspecialchars(
                    $selectedProject['problem']
                ) ?>

            </p>

        </div>

        <!-- Solution -->

        <div class="project-block">

            <h2>Solution</h2>

            <p>

                <?= htmlspecialchars(
                    $selectedProject['solution']
                ) ?>

            </p>

        </div>

        <!-- System Architecture -->
        <?php if (!empty($selectedProject['architecture_desc'])): ?>
            <div class="project-block">
                <h2>System Architecture</h2>
                <div class="architecture-card">
                    <p><?= htmlspecialchars($selectedProject['architecture_desc']) ?></p>
                </div>
            </div>
        <?php endif; ?>

        <!-- Tech Stack -->

        <div class="project-block">

            <h2>Tech Stack</h2>

            <div class="project-tags">

                <?php foreach(
                    $selectedProject['tech_stack']
                    as $tech
                ): ?>

                    <span>

                        <?= htmlspecialchars(
                            $tech
                        ) ?>

                    </span>

                <?php endforeach; ?>

            </div>

        </div>

        <!-- Features -->

        <div class="project-block">

            <h2>Key Features</h2>

            <ul>

                <?php foreach(
                    $selectedProject['features']
                    as $feature
                ): ?>

                    <li>

                        <?= htmlspecialchars(
                            $feature
                        ) ?>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

        <!-- Challenges & Obstacles -->
        <?php if (!empty($selectedProject['challenges'])): ?>
            <div class="project-block">
                <h2>Key Challenges &amp; Solutions</h2>
                <ul class="challenges-list">
                    <?php foreach($selectedProject['challenges'] as $challenge): ?>
                        <li>
                            <span class="challenge-bullet"><i class="fa-solid fa-triangle-exclamation"></i></span>
                            <span class="challenge-text"><?= htmlspecialchars($challenge) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Lessons Learned -->
        <?php if (!empty($selectedProject['lessons_learned'])): ?>
            <div class="project-block">
                <h2>Lessons &amp; Insights</h2>
                <ul class="lessons-list">
                    <?php foreach($selectedProject['lessons_learned'] as $lesson): ?>
                        <li>
                            <span class="lesson-bullet"><i class="fa-solid fa-lightbulb"></i></span>
                            <span class="lesson-text"><?= htmlspecialchars($lesson) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Results -->

        <div class="project-block">

            <h2>Results &amp; Impact</h2>

            <ul>

                <?php foreach(
                    $selectedProject['results']
                    as $result
                ): ?>

                    <li>

                        <?= htmlspecialchars(
                            $result
                        ) ?>

                    </li>

                <?php endforeach; ?>

            </ul>

        </div>

        <!-- Screenshots -->
        <?php if (!empty($selectedProject['screenshots'])): ?>
            <div class="project-block">
                <h2>Visual Walkthrough</h2>
                <div class="screenshots-grid">
                    <?php foreach($selectedProject['screenshots'] as $screenshot): ?>
                        <div class="screenshot-card gallery-card">
                            <img src="<?= htmlspecialchars($screenshot) ?>" alt="Screenshot of <?= htmlspecialchars($selectedProject['title']) ?>" class="project-screenshot">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="project-actions">

            <a
                href="<?= $selectedProject['github'] ?>"
                target="_blank"
                class="primary-btn">

                View GitHub

            </a>

            <a
                href="index.php#projects"
                class="secondary-btn">

                Back to Portfolio

            </a>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>