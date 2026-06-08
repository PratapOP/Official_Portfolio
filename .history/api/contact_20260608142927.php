<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    http_response_code(405);

    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| Collect Inputs
|--------------------------------------------------------------------------
*/

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

/*
|--------------------------------------------------------------------------
| Validation
|--------------------------------------------------------------------------
*/

if (
    empty($name) ||
    empty($email) ||
    empty($message)
) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'All fields are required.'
    ]);

    exit;
}

if (
    !filter_var(
        $email,
        FILTER_VALIDATE_EMAIL
    )
) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Invalid email address.'
    ]);

    exit;
}

/*
|--------------------------------------------------------------------------
| Save Message
|--------------------------------------------------------------------------
*/

$logFile =
    dirname(__DIR__) .
    '/logs/contacts.txt';

$entry =

"=================================================\n" .
"Date: " . date('Y-m-d H:i:s') . "\n" .
"Name: " . $name . "\n" .
"Email: " . $email . "\n" .
"Message:\n" .
$message . "\n" .
"=================================================\n\n";

file_put_contents(
    $logFile,
    $entry,
    FILE_APPEND | LOCK_EX
);

/*
|--------------------------------------------------------------------------
| Success Response
|--------------------------------------------------------------------------
*/

echo json_encode([
    'success' => true,
    'message' =>
        'Message received successfully.'
]);