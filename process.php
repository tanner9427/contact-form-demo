<?php

declare(strict_types = 1);

header('Content-Type: application/json');

// post requests only (into body not url)
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    http_response_code(405); // method is not allowed
    echo json_encode(['status' => 'error', 'message' => 'Please use POST']);
    exit;
}

// pull values from $_POST and use empty strings for missing keys.
$name = (string)($_POST['name'] ?? '');
$email = (string)($_POST['email'] ?? '');
$subject = (string)($_POST['email'] ?? '');
$message = (string)($_POST['message'] ?? '');

// trimming in case of extra spaces
$name = trim($name);
$email = trim($email);
$subject = trim($subject);
$message = trim($message);

// collect errors
$errors = [];

// length >= 2
if (mb_strlen($name) < 2) {
    $errors['name'] = 'Name must be at least 2 characters.';
}

// email check
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = 'Email invalid.';
}

// required subject
if ($subject === '') {
    $errors['subject'] = 'Subject is required.';
}

// message length >= 10
if (mb_strlen($message) < 10) {
    $errors['message'] = 'Message must be at least 10 characters.';
}

// If any errors, report and stop
if ($errors) {
    http_response_code(422);
    echo "Validation failed:\n";
    print_r($errors);
    exit;
}

echo "OK! Validation passed.\n";