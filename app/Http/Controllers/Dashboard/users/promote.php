<?php

use App\Core\Database;
// Only a headmaster (or professor) can promote:
if (strtolower($_SESSION['role'] ?? '') !== 'headmaster') {
    http_response_code(403);
    exit('Forbidden');
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    exit('Invalid user.');
}

$userId = (int) $_POST['id'];

// Database connection (adjust to your setup)
$db = new Database();
$pdo = $db->getconnection();

// Promote to professor
$stmt = $pdo->prepare("UPDATE users SET role = 'professor' WHERE id = ?");
if ($stmt->execute([$userId])) {
    header("Location: /dashboard/user?id={$userId}");
    exit;
} else {
    exit('Failed to promote.');
}
