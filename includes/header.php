    <?php

    require_once __DIR__ . '/config.php';

    $data = getPortfolio();

    $pageTitle = $pageTitle ?? $data['personal']['name'];
    $pageDescription = $pageDescription ?? $data['personal']['tagline'];
    $pageImage = $pageImage ?? asset($data['personal']['profile_image']);

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">

        <title><?= htmlspecialchars($pageTitle) ?></title>

        <meta name="description"
            content="<?= htmlspecialchars($pageDescription) ?>">

        <meta name="author"
            content="<?= htmlspecialchars($data['personal']['name']) ?>">

        <meta name="keywords"
            content="Abhiuday Pratap Singh, AI Engineer, Product Manager, Full Stack Developer, Machine Learning Engineer, Portfolio, India">

        <!-- Theme Color -->

        <meta name="theme-color"
            content="#c0392b">

        <!-- Open Graph -->

        <meta property="og:type"
            content="website">

        <meta property="og:title"
            content="<?= htmlspecialchars($pageTitle) ?>">

        <meta property="og:description"
            content="<?= htmlspecialchars($pageDescription) ?>">

        <meta property="og:image"
            content="<?= htmlspecialchars($pageImage) ?>">

        <meta property="og:url"
            content="<?= htmlspecialchars($data['personal']['website']) ?>">

        <!-- Twitter -->

        <meta name="twitter:card"
            content="summary_large_image">

        <meta name="twitter:title"
            content="<?= htmlspecialchars($pageTitle) ?>">

        <meta name="twitter:description"
            content="<?= htmlspecialchars($pageDescription) ?>">

        <meta name="twitter:image"
            content="<?= htmlspecialchars($pageImage) ?>">

        <!-- Fonts -->

        <link rel="preconnect"
            href="https://fonts.googleapis.com">

        <link rel="preconnect"
            href="https://fonts.gstatic.com"
            crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap"
            rel="stylesheet">

        <!-- Font Awesome -->

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <!-- Main CSS -->

        <link rel="stylesheet"
            href="assets/css/style.css">

        <link rel="stylesheet"
            href="assets/css/animations.css">

        <link rel="stylesheet"
            href="assets/css/responsive.css">

        <!-- Favicon -->
        <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

        <!-- Theme Persistence Blocker -->
        <script>
            (function() {
                const storedTheme = localStorage.getItem('theme') || 'dark';
                if (storedTheme === 'light') {
                    document.documentElement.classList.add('light-theme');
                } else {
                    document.documentElement.classList.remove('light-theme');
                }
            })();
        </script>

        <!-- Google Analytics (GA4) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?= GA_MEASUREMENT_ID ?>"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '<?= GA_MEASUREMENT_ID ?>');
        </script>

        <!-- JSON-LD Person Schema -->
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "<?= htmlspecialchars($data['personal']['name']) ?>",
            "jobTitle": "<?= htmlspecialchars($data['personal']['headline']) ?>",
            "url": "<?= htmlspecialchars($data['personal']['website']) ?>",
            "image": "<?= htmlspecialchars($data['personal']['profile_image']) ?>",
            "sameAs": [
                "<?= htmlspecialchars($data['socials']['github']) ?>",
                "<?= htmlspecialchars($data['socials']['linkedin']) ?>",
                "<?= htmlspecialchars($data['socials']['leetcode']) ?>",
                "<?= htmlspecialchars($data['socials']['gfg']) ?>"
            ],
            "email": "<?= htmlspecialchars($data['personal']['email']) ?>",
            "telephone": "<?= htmlspecialchars($data['personal']['phone']) ?>",
            "address": {
                "@type": "PostalAddress",
                "addressCountry": "<?= htmlspecialchars($data['personal']['location']) ?>"
            },
            "alumniOf": [
                <?php foreach($data['education'] as $index => $edu): ?>
                    <?= $index > 0 ? ',' : '' ?>{
                        "@type": "EducationalOrganization",
                        "name": "<?= htmlspecialchars($edu['institution']) ?>",
                        "description": "<?= htmlspecialchars($edu['degree']) ?>"
                    }
                <?php endforeach; ?>
            ]
        }
        </script>

    </head>

    <body>
        <!-- Dynamic Loading Screen -->
        <div id="loader" class="loader">
            <div class="loader-content">
                <span class="loader-logo"><span class="loader-accent">A</span>PS</span>
                <div class="loader-bar">
                    <div class="loader-progress"></div>
                </div>
                <p class="loader-text">Initializing portfolio...</p>
            </div>
        </div>