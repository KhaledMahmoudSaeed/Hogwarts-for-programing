<?php

// Only a headmaster (or professor) can promote:
if (strtolower($_SESSION['role'] ?? '') !== 'headmaster') {

    http_response_code(403);
    exit('Forbidden');
}

if (!isset($_POST['id']) || !is_numeric($_POST['id'])) {
    exit('Invalid user.');
}

$userId = (int) $_POST['id'];

// Promote to professor
$db->update("users", [
    'role' => "student"
], $userId);
header("Location: /dashboard/users");