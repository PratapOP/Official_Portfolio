<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid data payload'
    ]);
    exit;
}

$event = trim($input['event'] ?? 'pageview');
$page = trim($input['page'] ?? $_SERVER['HTTP_REFERER'] ?? '/');
$referrer = trim($input['referrer'] ?? '');
$screen = trim($input['screen'] ?? '');
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$ipHash = hash('sha256', ($_SERVER['REMOTE_ADDR'] ?? '') . $userAgent);

$logData = [
    'timestamp' => date('Y-m-d H:i:s'),
    'event' => $event,
    'page' => $page,
    'referrer' => $referrer,
    'screen' => $screen,
    'user_hash' => substr($ipHash, 0, 16)
];

// Ensure logs directory exists
$logDir = dirname(__DIR__) . '/logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0755, true);
}

$logFile = $logDir . '/analytics.json';
$entries = [];

if (file_exists($logFile)) {
    $existing = file_get_contents($logFile);
    $entries = json_decode($existing, true) ?: [];
}

$entries[] = $logData;

// Limit log size to last 1000 items to prevent file bloat
if (count($entries) > 1000) {
    array_shift($entries);
}

@file_put_contents($logFile, json_encode($entries, JSON_PRETTY_PRINT));

echo json_encode([
    'success' => true,
    'message' => 'Analytics logged successfully'
]);
