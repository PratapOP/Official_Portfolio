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

    <link rel="icon"
          href="assets/images/profile/profile-main.jpg">

</head>

<body>