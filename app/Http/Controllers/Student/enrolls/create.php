<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];

$pdo = $db->getconnection();
$stmt = $pdo->prepare("
    SELECT id, name FROM courses 
    WHERE id NOT IN (SELECT course_id FROM enrollments WHERE user_id = :id)
");
$stmt->execute([":id" => $id]);
$courses = $stmt->fetchAll();
array_push($courses, $id);
$path->view("/student/enrolls/create.php", $courses);