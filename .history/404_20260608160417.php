<?php

$pageTitle = "404 | Page Not Found";

require_once 'includes/header.php';

?>

<section class="error-page">

    <div class="section-container">

        <div class="error-content">

            <span class="error-code">

                404

            </span>

            <h1>

                Lost in the Matrix?

            </h1>

            <p>

                The page you're looking for
                doesn't exist or may have
                been moved.

            </p>

            <div class="error-actions">

                <a
                    href="index.php"
                    class="primary-btn">

                    Return Home

                </a>

                <a
                    href="index.php#projects"
                    class="secondary-btn">

                    View Projects

                </a>

            </div>

        </div>

    </div>

</section>

<?php include 'includes/footer.php'; ?>