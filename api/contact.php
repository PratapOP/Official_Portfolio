<?php

header('Content-Type: application/json');

require_once dirname(__DIR__) . '/includes/config.php';
require_once dirname(__DIR__) . '/includes/Mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ]);
    exit;
}

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required.'
    ]);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email address.'
    ]);
    exit;
}

// Log inquiry to file (always do this as a secondary backup)
$logFile = dirname(__DIR__) . '/logs/contacts.txt';
$entry = "=================================================\n" .
         "Date: " . date('Y-m-d H:i:s') . "\n" .
         "Name: " . $name . "\n" .
         "Email: " . $email . "\n" .
         "Message:\n" . $message . "\n" .
         "=================================================\n\n";

@file_put_contents($logFile, $entry, FILE_APPEND | LOCK_EX);

$smtpConfigured = !empty(SMTP_USER) && !empty(SMTP_PASS);
$emailSent = false;
$errorDetails = '';

if ($smtpConfigured) {
    try {
        $mailer = new Mailer(SMTP_HOST, SMTP_PORT, SMTP_USER, SMTP_PASS, SMTP_SECURE);

        // 1. Send confirmation email to recruiter/visitor
        $recruiterSubject = "Thank you for contacting me - Abhiuday Pratap Singh";
        $recruiterBody = "
        <div style='font-family: Arial, sans-serif; padding: 20px; line-height: 1.6; color: #333;'>
            <h2 style='color: #c0392b;'>Hi " . htmlspecialchars($name) . ",</h2>
            <p>Thank you for reaching out to me. I have received your message and will review it shortly.</p>
            <p>Here is what you sent me:</p>
            <blockquote style='background: #f9f9f9; border-left: 4px solid #c0392b; padding: 10px 15px; margin: 15px 0;'>
                " . nl2br(htmlspecialchars($message)) . "
            </blockquote>
            <p>In the meantime, feel free to view my projects on my <a href='https://github.com/abhiuday17' style='color: #c0392b;'>GitHub</a> or connect with me on <a href='https://linkedin.com/in/abhiuday-pratap-singh' style='color: #c0392b;'>LinkedIn</a>.</p>
            <hr style='border: none; border-top: 1px solid #eee; margin: 20px 0;'>
            <p>Best regards,<br><strong>Abhiuday Pratap Singh</strong><br>AI Engineer & Product Builder</p>
        </div>";

        $mailer->send($email, $recruiterSubject, $recruiterBody);

        // 2. Send notification email to Abhiuday
        $ownerSubject = "New Portfolio Inquiry from " . $name;
        $ownerBody = "
        <div style='font-family: Arial, sans-serif; padding: 20px; line-height: 1.6; color: #333;'>
            <h2 style='color: #c0392b; border-bottom: 2px solid #c0392b; padding-bottom: 5px;'>New Portfolio Inquiry</h2>
            <p><strong>Name:</strong> " . htmlspecialchars($name) . "</p>
            <p><strong>Email:</strong> <a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></p>
            <p><strong>Message:</strong></p>
            <div style='background: #f9f9f9; padding: 15px; border-radius: 5px; border: 1px solid #ddd;'>
                " . nl2br(htmlspecialchars($message)) . "
            </div>
            <p style='font-size: 0.8rem; color: #888; margin-top: 20px;'>Submitted via portfolio website at " . date('Y-m-d H:i:s') . "</p>
        </div>";

        $targetEmail = getPortfolio()['personal']['email'];
        $mailer->send($targetEmail, $ownerSubject, $ownerBody);
        $emailSent = true;
    } catch (Exception $e) {
        $errorDetails = $e->getMessage();
    }
}

if ($emailSent) {
    echo json_encode([
        'success' => true,
        'message' => 'Thank you for contacting me. Confirmation email sent!'
    ]);
} else {
    // If SMTP is not set up or fails, we fall back to file saving and return success
    $msg = 'Message received and logged successfully.';
    if ($smtpConfigured) {
        $msg .= ' (Email delivery failed: ' . $errorDetails . ')';
    } else {
        $msg .= ' (Email service offline - SMTP not configured)';
    }
    echo json_encode([
        'success' => true,
        'message' => $msg
    ]);
}