<?php

/*
|--------------------------------------------------------------------------
| Portfolio Configuration Loader
|--------------------------------------------------------------------------
| Loads portfolio.json once and makes data available globally.
|--------------------------------------------------------------------------
*/

define('ROOT_PATH', dirname(__DIR__));

$jsonFile = ROOT_PATH . '/data/portfolio.json';

if (!file_exists($jsonFile)) {
    die("portfolio.json not found.");
}

$jsonContent = file_get_contents($jsonFile);

$portfolio = json_decode($jsonContent, true);

if (!$portfolio) {
    die("Invalid JSON format in portfolio.json");
}

/*
|--------------------------------------------------------------------------
| Helper Functions
|--------------------------------------------------------------------------
*/

function asset($path)
{
    // Make relative to the current directory for better local testing
    return ltrim($path, '/');
}

function getPortfolio()
{
    global $portfolio;
    return $portfolio;
}

/*
|--------------------------------------------------------------------------
| SMTP & Analytics Settings
|--------------------------------------------------------------------------
*/

define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 465);
define('SMTP_USER', getenv('SMTP_USER') ?: ''); // Recruiter/User can populate this
define('SMTP_PASS', getenv('SMTP_PASS') ?: ''); // Recruiter/User can populate this
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'ssl');

define('GA_MEASUREMENT_ID', getenv('GA_MEASUREMENT_ID') ?: 'G-XXXXXXXXXX');