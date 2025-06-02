<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Include PDO database connection
require_once 'db.php';

$userId = $_SESSION['user_id'];
$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

$errors = [];

// Validation
if (strlen($title) < 5 || strlen($title) > 100) {
    $errors[] = "Title must be between 5 and 100 characters.";
}

if (strlen($description) < 10 || strlen($description) > 600) {
    $errors[] = "Description must be between 10 and 600 characters.";
}

// Redirect with errors if validation fails
if ($errors) {
    $_SESSION['tip_errors'] = $errors;
    header('Location: cybersecurity-tips.php');
    exit;
}

// Try inserting the tip using PDO
try {
    $stmt = $pdo->prepare("INSERT INTO tips (user_id, title, description) VALUES (?, ?, ?)");
    $stmt->execute([$userId, $title, $description]);

    $_SESSION['tip_success'] = "Tip submitted successfully!";
} catch (PDOException $e) {
    $_SESSION['tip_errors'] = ["Failed to submit tip: " . $e->getMessage()];
}

header('Location: cybersecurity-tips.php');
exit;

