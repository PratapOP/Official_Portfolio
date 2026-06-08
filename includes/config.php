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
    return '/' . ltrim($path, '/');
}

function getPortfolio()
{
    global $portfolio;
    return $portfolio;
}