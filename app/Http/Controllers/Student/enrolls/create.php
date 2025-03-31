<?php
use Helpers\Auth;
session_start();
$id = Auth::getAuthenticatedUser()['id'];

$pdo = $db->getconnection();
$stmt = $pdo->prepare("
    SELECT id, name FROM courses 
    WHERE id NOT IN (SELECT course_id FROM enrollments WHERE user_id = :id)
");
$stmt->execute([":id" => $id]);
$courses = $stmt->fetchAll();

$path->view("/student/enrolls/create.php", $courses);