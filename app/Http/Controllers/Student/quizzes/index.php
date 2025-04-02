<?php
use Helpers\Auth;
$id = Auth::getAuthenticatedUser()['id'];
$course_id = $_GET['course_id'];
$quizzes = $db->where("quizzes", "course_id=$course_id", [
    "id" => "",
    "question" => "",
    "points" => ""
]);
array_push($quizzes, ['user_id' => $id]);


$path->view("student/quizzes/index.php", $quizzes);